#!/bin/bash

# ============================================
# InkRockit.com - Rollback Script
# ============================================
# This script runs ON THE DIGITALOCEAN SERVER (kb-final)
# Location on server: /opt/deploy/inkrockit/rollback.sh
#
# This script restores the most recent backup in case of deployment failure.
#
# Usage:
#   /opt/deploy/inkrockit/rollback.sh [backup-file]
#
# Example:
#   /opt/deploy/inkrockit/rollback.sh
#   /opt/deploy/inkrockit/rollback.sh backup-20251117-143022.tar.gz
# ============================================

set -e  # Exit on error
set -u  # Exit on undefined variable

# ============================================
# Configuration
# ============================================
APP_NAME="inkrockit.com"
APP_PATH="/var/www/inkrockit.com"
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
log "Starting rollback for $APP_NAME"
log "============================================"

# Check if running as root or with sudo
if [ "$EUID" -ne 0 ]; then
    log_error "This script must be run as root or with sudo"
    exit 1
fi

# Verify backup directory exists
if [ ! -d "$BACKUP_DIR" ]; then
    log_error "Backup directory does not exist: $BACKUP_DIR"
    exit 1
fi

# ============================================
# Select Backup to Restore
# ============================================
if [ $# -eq 1 ]; then
    # Backup file specified as argument
    BACKUP_FILE="$BACKUP_DIR/$1"
    if [ ! -f "$BACKUP_FILE" ]; then
        log_error "Specified backup file not found: $BACKUP_FILE"
        exit 1
    fi
else
    # Find most recent backup
    BACKUP_FILE=$(ls -t "$BACKUP_DIR"/backup-*.tar.gz 2>/dev/null | head -1)

    if [ -z "$BACKUP_FILE" ]; then
        log_error "No backup files found in $BACKUP_DIR"
        log_info "Available backups:"
        ls -lh "$BACKUP_DIR"/ || echo "  (none)"
        exit 1
    fi
fi

BACKUP_NAME=$(basename "$BACKUP_FILE")
log_info "Selected backup: $BACKUP_NAME"
log_info "Backup size: $(du -h "$BACKUP_FILE" | cut -f1)"
log_info "Backup date: $(stat -c %y "$BACKUP_FILE" 2>/dev/null || stat -f %Sm "$BACKUP_FILE")"

# ============================================
# Confirmation
# ============================================
log_warning "============================================"
log_warning "This will REPLACE the current application with the backup!"
log_warning "Current files will be moved to: ${APP_PATH}.pre-rollback"
log_warning "============================================"

# Check if running interactively
if [ -t 0 ]; then
    read -p "Are you sure you want to proceed? (yes/no): " -r
    echo
    if [[ ! $REPLY =~ ^[Yy][Ee][Ss]$ ]]; then
        log "Rollback cancelled by user"
        exit 0
    fi
else
    log_info "Non-interactive mode - proceeding with rollback"
fi

# ============================================
# Backup Current State (Before Rollback)
# ============================================
log "Creating backup of current state before rollback..."

ROLLBACK_BACKUP="${APP_PATH}.pre-rollback"

if [ -d "$ROLLBACK_BACKUP" ]; then
    log_warning "Previous pre-rollback backup exists. Removing..."
    rm -rf "$ROLLBACK_BACKUP"
fi

# Move current application to backup location
mv "$APP_PATH" "$ROLLBACK_BACKUP"
log_info "Current application moved to: $ROLLBACK_BACKUP"

# ============================================
# Restore from Backup
# ============================================
log "Restoring from backup: $BACKUP_NAME"

# Create application directory
mkdir -p "$APP_PATH"

# Extract backup
cd /var/www
tar xzf "$BACKUP_FILE"

if [ ! -d "$APP_PATH" ]; then
    log_error "Backup extraction failed - application directory not found"
    log_error "Restoring previous state..."
    rm -rf "$APP_PATH"
    mv "$ROLLBACK_BACKUP" "$APP_PATH"
    exit 1
fi

log_info "✓ Backup extracted successfully"

# ============================================
# Set Permissions
# ============================================
log "Setting file permissions..."

chown -R www-data:www-data "$APP_PATH"
find "$APP_PATH" -type f -exec chmod 644 {} \;
find "$APP_PATH" -type d -exec chmod 755 {} \;

log_info "✓ Permissions set"

# ============================================
# Restart Services
# ============================================
log "Restarting services..."

# Test Nginx configuration
if nginx -t 2>/dev/null; then
    systemctl reload nginx
    log_info "✓ Nginx reloaded"
else
    log_error "Nginx configuration test failed"
    log_error "Restoring previous state..."
    rm -rf "$APP_PATH"
    mv "$ROLLBACK_BACKUP" "$APP_PATH"
    exit 1
fi

# Reload PHP-FPM
if systemctl is-active --quiet php8.3-fpm; then
    systemctl reload php8.3-fpm
    log_info "✓ PHP-FPM reloaded"
fi

# ============================================
# Verify Rollback
# ============================================
log "Verifying rollback..."

# Check if site is accessible
HTTP_STATUS=$(curl -s -o /dev/null -w "%{http_code}" https://inkrockit.com)

if [ "$HTTP_STATUS" -eq 200 ]; then
    log_info "✓ Site is responding (HTTP $HTTP_STATUS)"
else
    log_warning "Site returned HTTP $HTTP_STATUS - may need investigation"
fi

# ============================================
# Rollback Summary
# ============================================
log "============================================"
log "✓ ROLLBACK COMPLETED SUCCESSFULLY"
log "============================================"
log_info "Restored from: $BACKUP_NAME"
log_info "Pre-rollback backup saved at: $ROLLBACK_BACKUP"
log_info "Rolled back at: $(date +'%Y-%m-%d %H:%M:%S')"
log_info "Site URL: https://inkrockit.com"
log "============================================"

# ============================================
# Cleanup Instructions
# ============================================
log_info "To remove the pre-rollback backup after verification:"
log_info "  sudo rm -rf $ROLLBACK_BACKUP"
log ""
log_info "To restore the pre-rollback state (undo this rollback):"
log_info "  sudo rm -rf $APP_PATH"
log_info "  sudo mv $ROLLBACK_BACKUP $APP_PATH"
log_info "  sudo systemctl reload nginx"

exit 0

# ============================================
# Installation Instructions
# ============================================
# To set up this script on the server:
#
# 1. SSH to the server:
#    ssh kb-final
#
# 2. Create deployment directory (if not exists):
#    sudo mkdir -p /opt/deploy/inkrockit/backups
#
# 3. Create this script:
#    sudo nano /opt/deploy/inkrockit/rollback.sh
#    (paste this file's contents)
#
# 4. Make executable:
#    sudo chmod +x /opt/deploy/inkrockit/rollback.sh
#
# 5. Test (dry run):
#    sudo /opt/deploy/inkrockit/rollback.sh
#
# 6. In case of emergency, run:
#    sudo /opt/deploy/inkrockit/rollback.sh
# ============================================
