# InkRockit.com - Production Deployment Repository

🚨 **IMPORTANT: This is an ARTIFACT-ONLY repository** 🚨

This repository contains the **compiled/deployed static files** currently running on inkrockit.com production server, NOT the Nuxt.js source code.

---

## Repository Purpose

This repository serves as:
- ✅ **Version control** for the current production deployment
- ✅ **Deployment automation** via GitHub Actions to DigitalOcean
- ✅ **Documentation** of the current production architecture
- ✅ **Temporary bridge** until a full rebuild/redesign

This repository is NOT:
- ❌ A development environment for the Nuxt.js framework
- ❌ Source code with Vue components, pages, layouts
- ❌ A buildable project with `npm run dev`

---

## What's in This Repository

### Compiled Static Site
- `index.php` / `index.html` - Main entry point (server-side rendered Nuxt.js output)
- `_nuxt/` - Compiled JavaScript bundles and assets
- Images and static media files
- Legacy PHP files (osCommerce, custom scripts) - present but not actively used for main site

### Documentation
- [`DEPLOYMENT_MAP.md`](./DEPLOYMENT_MAP.md) - Complete architecture documentation
- [`nginx.conf.example`](./config/nginx.conf.example) - Nginx configuration reference
- [`db_connection.php.example`](./config/db_connection.php.example) - Database config template

### Infrastructure
- `.github/workflows/deploy.yml` - Automated deployment to DigitalOcean
- `deploy.sh` - Server-side deployment script
- `.gitignore` - Repository exclusions

---

## Technology Stack

**Production Server:**
- **Droplet:** kb-final (DigitalOcean)
- **OS:** Ubuntu with Nginx 1.18.0
- **PHP:** 8.3-FPM
- **MySQL:** Community Server (not used by main site)
- **SSL:** Let's Encrypt (auto-renewal configured)

**Current Site:**
- **Framework:** Nuxt.js (compiled/static)
- **Frontend:** Vue.js (compiled bundles)
- **Rendering:** SSR at build time (static HTML served)

---

## Quick Start

### Prerequisites
- Git installed locally
- SSH access to kb-final droplet configured
- GitHub account with repository access
- GitHub Actions secrets configured (see below)

### Clone the Repository
```bash
git clone git@github.com:dtraub1/inkrockit.com.git
cd inkrockit.com
```

### Making Changes

Since this is an artifact-only repo, you have two options for making changes:

#### Option A: Small Edits to Static Files
For minor HTML/CSS/JS tweaks:
1. Download the specific file from the server you need to edit
2. Make your changes locally
3. Commit and push to GitHub
4. Trigger the GitHub Actions deployment (manual workflow dispatch)

#### Option B: Full Redesign/Rebuild
For major changes, you should:
1. Create a NEW repository with proper Nuxt.js source code
2. Develop locally with `npm run dev`
3. Build the site with `npm run generate`
4. Deploy the `dist/` output to the server

---

## Deployment Workflow

### Automated Deployment (GitHub Actions)

This repository includes a GitHub Actions workflow that deploys changes to the production server.

**Workflow File:** `.github/workflows/deploy.yml`

**How it works:**
1. Triggered manually via GitHub Actions UI (workflow_dispatch)
2. Connects to kb-final droplet via SSH
3. Runs the server-side deployment script
4. Script pulls latest code from GitHub
5. Syncs files to `/var/www/inkrockit.com`
6. Restarts services if needed

**To deploy:**
1. Go to Actions tab in GitHub
2. Select "Deploy to DigitalOcean"
3. Click "Run workflow"
4. Select branch (usually `main`)
5. Click "Run workflow" button

### Required GitHub Secrets

Configure these in your GitHub repository settings (Settings → Secrets and variables → Actions):

```
DO_SSH_HOST=67.205.161.183
DO_SSH_USER=root
DO_SSH_KEY=<contents of ~/.ssh/kb_final_droplet>
DO_APP_PATH=/var/www/inkrockit.com
GITHUB_DEPLOY_TOKEN=<GitHub personal access token>
```

**How to get SSH key:**
```bash
cat ~/.ssh/kb_final_droplet
```

**How to create GitHub token:**
1. GitHub Settings → Developer settings → Personal access tokens
2. Generate new token (classic)
3. Select `repo` scope
4. Copy the token

---

## Manual Deployment (Alternative)

If you prefer to deploy manually without GitHub Actions:

### Using rsync
```bash
rsync -avz \
  --exclude='.git' \
  --exclude='node_modules' \
  --exclude='.DS_Store' \
  ./ kb-final:/var/www/inkrockit.com/
```

### Using the deployment script
```bash
ssh kb-final "/opt/deploy/inkrockit/deploy.sh"
```

---

## Downloading Files from Server

To download specific files from the production server for editing:

### Single file
```bash
scp kb-final:/var/www/inkrockit.com/index.php ./
```

### Entire directory
```bash
rsync -avz \
  --exclude='._*' \
  --exclude='.DS_Store' \
  kb-final:/var/www/inkrockit.com/ ./
```

### Using SFTP
```bash
sftp kb-final
cd /var/www/inkrockit.com
get filename.php
```

---

## Server Access

### SSH Connection
```bash
ssh kb-final
```

Or directly:
```bash
ssh root@67.205.161.183 -i ~/.ssh/kb_final_droplet
```

### Important Paths
| Purpose | Path |
|---------|------|
| Application Root | `/var/www/inkrockit.com` |
| Nginx Config | `/etc/nginx/sites-available/inkrockit.com` |
| Nginx Logs | `/var/log/nginx/inkrockit.com-*.log` |
| PHP-FPM Config | `/etc/php/8.3/fpm/` |
| SSL Certificates | `/etc/letsencrypt/live/inkrockit.com/` |
| Deployment Script | `/opt/deploy/inkrockit/deploy.sh` |

### Common Commands
```bash
# Check Nginx status
sudo systemctl status nginx

# Reload Nginx (after config changes)
sudo systemctl reload nginx

# Check PHP-FPM status
sudo systemctl status php8.3-fpm

# View error logs
sudo tail -f /var/log/nginx/inkrockit.com-error.log

# Check disk space
df -h /var/www/inkrockit.com
```

---

## Configuration Management

### Environment Variables
There are NO environment variables for the static Nuxt.js site.

Legacy PHP files reference database credentials, which have been externalized:
- Template: `config/db_connection.php.example`
- Actual file: `includes/db_connection.php` (not in Git)

### Nginx Configuration
The Nginx configuration is documented in [`config/nginx.conf.example`](./config/nginx.conf.example).

To update Nginx config on server:
```bash
ssh kb-final
sudo nano /etc/nginx/sites-available/inkrockit.com
sudo nginx -t  # Test configuration
sudo systemctl reload nginx
```

---

## Backup & Recovery

### Current Production State
**Backed up in this repository via Git version control**

### Creating a Server Backup
```bash
# Create tarball of entire application
ssh kb-final "cd /var/www && tar czf /tmp/inkrockit-backup-$(date +%Y%m%d).tar.gz inkrockit.com/"

# Download backup
scp kb-final:/tmp/inkrockit-backup-*.tar.gz ./backups/
```

### Restoring from Backup
```bash
# Upload backup
scp ./backups/inkrockit-backup-YYYYMMDD.tar.gz kb-final:/tmp/

# Extract on server
ssh kb-final "cd /var/www && tar xzf /tmp/inkrockit-backup-YYYYMMDD.tar.gz"
```

---

## Troubleshooting

### Site is Down
1. Check Nginx status: `ssh kb-final "sudo systemctl status nginx"`
2. Check error logs: `ssh kb-final "sudo tail -50 /var/log/nginx/inkrockit.com-error.log"`
3. Restart services: `ssh kb-final "sudo systemctl restart nginx php8.3-fpm"`

### SSL Certificate Issues
```bash
# Renew certificate manually
ssh kb-final "sudo certbot renew --force-renewal"

# Check certificate expiry
ssh kb-final "sudo certbot certificates"
```

### Deployment Failed
1. Check GitHub Actions logs in the Actions tab
2. Verify SSH key is correct in GitHub secrets
3. Manually run deployment script: `ssh kb-final "/opt/deploy/inkrockit/deploy.sh"`
4. Check server logs: `ssh kb-final "tail -50 /var/log/nginx/inkrockit.com-error.log"`

### Files Not Updating
1. Check file permissions: `ssh kb-final "ls -la /var/www/inkrockit.com"`
2. Verify ownership: `ssh kb-final "sudo chown -R www-data:www-data /var/www/inkrockit.com"`
3. Clear any server-side caches
4. Hard refresh browser (Cmd+Shift+R on Mac, Ctrl+Shift+R on Windows)

---

## Future Recommendations

### Short Term
- ✅ Version control and automated deployment (this repository)
- 🔄 Regular backups automated via cron
- 🔄 Security audit of legacy PHP code
- 🔄 Remove unused osCommerce and legacy files

### Long Term
- 🔄 **Rebuild site with proper Nuxt.js source code**
- 🔄 Modern CI/CD pipeline (build on every commit)
- 🔄 Staging environment for testing changes
- 🔄 Content management system for easier updates
- 🔄 Performance optimization (CDN, caching)
- 🔄 Mobile responsive improvements
- 🔄 SEO optimization

---

## Security Notes

### Credentials
- ❌ **NEVER commit actual credentials to this repository**
- ✅ Use `.env.example` templates
- ✅ Keep actual credentials in server-side files only
- ✅ Use GitHub Secrets for deployment credentials

### Legacy PHP Code
⚠️ The legacy PHP files use deprecated `mysql_connect()` functions and may have security vulnerabilities. These files are not actively used by the main Nuxt.js site but remain on the server. Consider removing them after verification.

### SSL/TLS
- ✅ Let's Encrypt certificate auto-renews
- ✅ HTTPS enforced with redirects
- ✅ Modern TLS configuration

---

## Support & Contact

### Documentation
- Full architecture: [`DEPLOYMENT_MAP.md`](./DEPLOYMENT_MAP.md)
- Nginx reference: [`config/nginx.conf.example`](./config/nginx.conf.example)

### Repository
- GitHub: https://github.com/dtraub1/inkrockit.com

### Server Provider
- DigitalOcean Droplet: kb-final
- IP: 67.205.161.183

---

## License

Proprietary - All rights reserved.

---

**Last Updated:** 2025-11-17
**Maintained By:** Development Team
**Repository Type:** Artifact-Only Deployment Repository
