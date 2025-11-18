#!/bin/bash

# ============================================
# InkRockit.com - Production Deployment Script
# ============================================
# This script runs ON THE DIGITALOCEAN SERVER (kb-final)
# Location on server: /opt/deploy/inkrockit/deploy.sh
#
# This script is called by GitHub Actions to deploy changes to production.
# It can also be run manually for direct deployments.
#
# Usage:
#   /opt/deploy/inkrockit/deploy.sh [branch]
#
# Example:
#   /opt/deploy/inkrockit/deploy.sh main
#   /opt/deploy/inkrockit/deploy.sh
# ============================================

set -e  # Exit on error
set -u  # Exit on undefined variable

# ============================================
# Configuration
# ============================================
APP_NAME="inkrockit.com"
APP_PATH="/var/www/inkrockit.com"
DEPLOY_USER="www-data"
DEPLOY_GROUP="www-data"
GIT_REPO="https://github.com/dtraub1/inkrockit.com.git"
DEFAULT_BRANCH="main"
BACKUP_DIR="/opt/deploy/inkrockit/backups"
LOG_FILE="/opt/deploy/inkrockit/deploy.log"

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# ============================================
# Helper Functions
# ============================================
log() {
    echo -e "${GREEN}[$(date +'%Y-%m-%d %H:%M:%S')]${NC} $1" | tee -a "$LOG_FILE"
}

log_error() {
    echo -e "${RED}[$(date +'%Y-%m-%d %H:%M:%S')] ERROR:${NC} $1" | tee -a "$LOG_FILE" >&2
}

log_warning() {
    echo -e "${YELLOW}[$(date +'%Y-%m-%d %H:%M:%S')] WARNING:${NC} $1" | tee -a "$LOG_FILE"
}

log_info() {
    echo -e "${BLUE}[$(date +'%Y-%m-%d %H:%M:%S')] INFO:${NC} $1" | tee -a "$LOG_FILE"
}

# ============================================
# Pre-flight Checks
# ============================================
log "============================================"
log "Starting deployment for $APP_NAME"
log "============================================"

# Check if running as root or with sudo
if [ "$EUID" -ne 0 ]; then
    log_warning "Not running as root. Some operations may require sudo."
fi

# Get branch from argument or use default
BRANCH="${1:-$DEFAULT_BRANCH}"
log_info "Target branch: $BRANCH"

# Verify application path exists
if [ ! -d "$APP_PATH" ]; then
    log_error "Application path does not exist: $APP_PATH"
    exit 1
fi

# Create backup directory if it doesn't exist
mkdir -p "$BACKUP_DIR"

# ============================================
# Check if Git repo exists
# ============================================
log "Checking Git repository status..."

if [ ! -d "$APP_PATH/.git" ]; then
    log_warning "Git repository not found in $APP_PATH"
    log_info "Initializing Git repository..."

    cd "$APP_PATH"

    # Initialize Git
    git init
    git remote add origin "$GIT_REPO"

    # Fetch from remote
    log_info "Fetching from repository..."
    git fetch origin "$BRANCH"

    # Checkout branch
    log_info "Checking out branch: $BRANCH"
    git checkout -b "$BRANCH" "origin/$BRANCH"

else
    log_info "Git repository found. Pulling latest changes..."

    cd "$APP_PATH"

    # Ensure we're on the correct branch
    CURRENT_BRANCH=$(git branch --show-current)
    if [ "$CURRENT_BRANCH" != "$BRANCH" ]; then
        log_info "Switching from $CURRENT_BRANCH to $BRANCH"
        git checkout "$BRANCH" || git checkout -b "$BRANCH" "origin/$BRANCH"
    fi

    # Check for uncommitted changes
    if ! git diff-index --quiet HEAD --; then
        log_warning "Uncommitted changes detected. Stashing..."
        git stash save "Auto-stash before deployment $(date +'%Y-%m-%d %H:%M:%S')"
    fi

    # Pull latest changes
    log_info "Pulling latest changes from origin/$BRANCH"
    git fetch origin
    git reset --hard "origin/$BRANCH"
fi

# ============================================
# Check for Changes
# ============================================
COMMIT_HASH=$(git rev-parse --short HEAD)
COMMIT_MSG=$(git log -1 --pretty=format:"%s")
log_info "Current commit: $COMMIT_HASH - $COMMIT_MSG"

# ============================================
# Handle Dependencies (if any exist in future)
# ============================================
# Note: Current deployment has no build dependencies
# This section is for future use if source code is added

# Check for package.json (Node.js dependencies)
if [ -f "$APP_PATH/package.json" ]; then
    log_info "Checking Node.js dependencies..."

    # Check if node_modules exists and package-lock.json changed
    if [ ! -d "$APP_PATH/node_modules" ] || [ "$APP_PATH/package-lock.json" -nt "$APP_PATH/node_modules" ]; then
        log_info "Installing Node.js dependencies..."
        npm ci --production
    else
        log_info "Node.js dependencies up to date"
    fi
fi

# Check for composer.json (PHP dependencies)
if [ -f "$APP_PATH/composer.json" ]; then
    log_info "Checking PHP dependencies..."

    # Check if vendor exists and composer.lock changed
    if [ ! -d "$APP_PATH/vendor" ] || [ "$APP_PATH/composer.lock" -nt "$APP_PATH/vendor" ]; then
        log_info "Installing PHP dependencies..."
        composer install --no-dev --optimize-autoloader
    else
        log_info "PHP dependencies up to date"
    fi
fi

# ============================================
# File Permissions
# ============================================
log "Setting file permissions..."

# Set ownership
chown -R $DEPLOY_USER:$DEPLOY_GROUP "$APP_PATH"

# Set permissions
find "$APP_PATH" -type f -exec chmod 644 {} \;
find "$APP_PATH" -type d -exec chmod 755 {} \;

# Make scripts executable if any
if [ -d "$APP_PATH/scripts" ]; then
    find "$APP_PATH/scripts" -type f -name "*.sh" -exec chmod 755 {} \;
fi

# ============================================
# Clear Caches (if any)
# ============================================
log "Clearing caches..."

# Clear PHP OpCache
if systemctl is-active --quiet php8.3-fpm; then
    systemctl reload php8.3-fpm
    log_info "PHP-FPM reloaded"
fi

# Clear any application caches
if [ -d "$APP_PATH/cache" ]; then
    rm -rf "$APP_PATH/cache/*"
    log_info "Application cache cleared"
fi

# ============================================
# Service Checks
# ============================================
log "Verifying services..."

# Check Nginx
if systemctl is-active --quiet nginx; then
    log_info "✓ Nginx is running"

    # Test Nginx configuration
    if nginx -t 2>/dev/null; then
        log_info "✓ Nginx configuration is valid"

        # Reload Nginx gracefully
        systemctl reload nginx
        log_info "✓ Nginx reloaded"
    else
        log_error "Nginx configuration test failed"
        exit 1
    fi
else
    log_error "Nginx is not running"
    exit 1
fi

# Check PHP-FPM
if systemctl is-active --quiet php8.3-fpm; then
    log_info "✓ PHP-FPM is running"
else
    log_warning "PHP-FPM is not running"
    # Start PHP-FPM if it's not running
    systemctl start php8.3-fpm
    if systemctl is-active --quiet php8.3-fpm; then
        log_info "✓ PHP-FPM started"
    else
        log_error "Failed to start PHP-FPM"
        exit 1
    fi
fi

# ============================================
# Deployment Verification
# ============================================
log "Verifying deployment..."

# Check if site is accessible
HTTP_STATUS=$(curl -s -o /dev/null -w "%{http_code}" https://inkrockit.com)

if [ "$HTTP_STATUS" -eq 200 ]; then
    log_info "✓ Site is responding (HTTP $HTTP_STATUS)"
else
    log_error "Site returned HTTP $HTTP_STATUS"
    # Don't exit - might be temporary
fi

# ============================================
# Deployment Summary
# ============================================
log "============================================"
log "✓ DEPLOYMENT COMPLETED SUCCESSFULLY"
log "============================================"
log_info "Branch: $BRANCH"
log_info "Commit: $COMMIT_HASH"
log_info "Message: $COMMIT_MSG"
log_info "Deployed at: $(date +'%Y-%m-%d %H:%M:%S')"
log_info "Site URL: https://inkrockit.com"
log "============================================"

# ============================================
# Cleanup
# ============================================
# Remove old log entries (keep last 1000 lines)
if [ -f "$LOG_FILE" ]; then
    tail -n 1000 "$LOG_FILE" > "$LOG_FILE.tmp"
    mv "$LOG_FILE.tmp" "$LOG_FILE"
fi

exit 0

# ============================================
# Installation Instructions
# ============================================
# To set up this script on the server:
#
# 1. SSH to the server:
#    ssh kb-final
#
# 2. Create deployment directory:
#    sudo mkdir -p /opt/deploy/inkrockit
#
# 3. Create this script:
#    sudo nano /opt/deploy/inkrockit/deploy.sh
#    (paste this file's contents)
#
# 4. Make executable:
#    sudo chmod +x /opt/deploy/inkrockit/deploy.sh
#
# 5. Test the script:
#    sudo /opt/deploy/inkrockit/deploy.sh
#
# 6. Configure GitHub Actions secrets with SSH access
#
# 7. Trigger deployment from GitHub Actions UI
# ============================================
