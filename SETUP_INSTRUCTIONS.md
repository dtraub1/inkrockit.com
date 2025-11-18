# Setup Instructions - Complete the Deployment Infrastructure

This guide walks you through the remaining manual steps to complete the inkrockit.com deployment repository setup.

**Status:** All infrastructure files have been created. You need to complete the Git operations and server configuration.

---

## Overview of What's Been Created

✅ **Repository Structure:**
- `README.md` - Main documentation
- `DEPLOYMENT_MAP.md` - Complete architecture documentation
- `HOW_TO_DOWNLOAD_FILES.md` - File download guide
- `.gitignore` - Repository exclusions
- `config/nginx.conf.example` - Nginx reference
- `config/db_connection.php.example` - Database config template
- `.github/workflows/deploy.yml` - GitHub Actions deployment workflow
- `scripts/server-deploy.sh` - Server-side deployment script
- `scripts/server-rollback.sh` - Server-side rollback script

✅ **What's Ready:**
- All documentation written
- Deployment workflows configured
- Server scripts prepared

❌ **What Needs to Be Done:**
- Git commit and push (manual)
- Server scripts installation (manual)
- GitHub secrets configuration (manual)
- Initial deployment test (manual)

---

## Step 1: Commit and Push to GitHub

### 1.1 Check Repository Status
```bash
cd /Users/jenieflortraub/Code/inkrockit.com
git status
```

You should see all the new files as untracked.

### 1.2 Stage All Files
```bash
git add -A
```

### 1.3 Create Initial Commit
```bash
git commit -m "Initial import: InkRockit.com artifact-only deployment repository

Repository setup for inkrockit.com production deployment.

This is an ARTIFACT-ONLY repository - compiled static files only, no Nuxt.js source code.

Includes:
- DEPLOYMENT_MAP.md: Complete architecture documentation
- README.md: Usage and deployment guide
- HOW_TO_DOWNLOAD_FILES.md: File download instructions
- .github/workflows/deploy.yml: GitHub Actions deployment workflow
- scripts/server-deploy.sh: Server-side deployment script
- scripts/server-rollback.sh: Server-side rollback script
- config/: Nginx and database templates

Server: kb-final (67.205.161.183)
Stack: Nginx + PHP 8.3-FPM + Compiled Nuxt.js static site

Infrastructure includes automated deployment workflow with manual triggers,
backup creation, and rollback capabilities.

Co-Authored-By: Claude <noreply@anthropic.com>"
```

### 1.4 Verify Commit
```bash
git log -1
```

### 1.5 Push to GitHub
```bash
git push -u origin main
```

### 1.6 Verify on GitHub
Visit https://github.com/dtraub1/inkrockit.com and verify all files are present.

---

## Step 2: Install Server-Side Scripts

### 2.1 SSH to Server
```bash
ssh kb-final
```

### 2.2 Create Deployment Directory
```bash
sudo mkdir -p /opt/deploy/inkrockit/backups
sudo mkdir -p /opt/deploy/inkrockit/logs
```

### 2.3 Create Deployment Script
```bash
sudo nano /opt/deploy/inkrockit/deploy.sh
```

Copy the contents from `scripts/server-deploy.sh` and paste into the editor.

**Keyboard shortcuts:**
- Paste: `Cmd+V` (or `Ctrl+Shift+V` in some terminals)
- Save: `Ctrl+O`, then `Enter`
- Exit: `Ctrl+X`

### 2.4 Create Rollback Script
```bash
sudo nano /opt/deploy/inkrockit/rollback.sh
```

Copy the contents from `scripts/server-rollback.sh` and paste into the editor.
Save and exit as above.

### 2.5 Make Scripts Executable
```bash
sudo chmod +x /opt/deploy/inkrockit/deploy.sh
sudo chmod +x /opt/deploy/inkrockit/rollback.sh
```

### 2.6 Create Log File
```bash
sudo touch /opt/deploy/inkrockit/deploy.log
sudo chown www-data:www-data /opt/deploy/inkrockit/deploy.log
```

### 2.7 Verify Installation
```bash
ls -lh /opt/deploy/inkrockit/
```

You should see:
- `deploy.sh` (executable)
- `rollback.sh` (executable)
- `deploy.log`
- `backups/` (directory)

### 2.8 Test Scripts (Dry Run)
```bash
# Test that scripts can be executed (won't actually deploy yet)
sudo bash -n /opt/deploy/inkrockit/deploy.sh
sudo bash -n /opt/deploy/inkrockit/rollback.sh
```

No output means syntax is valid.

### 2.9 Exit SSH
```bash
exit
```

---

## Step 3: Configure GitHub Secrets

### 3.1 Get SSH Private Key
```bash
cat ~/.ssh/kb_final_droplet
```

Copy the ENTIRE output, including:
- `-----BEGIN OPENSSH PRIVATE KEY-----`
- All the key content
- `-----END OPENSSH PRIVATE KEY-----`

### 3.2 Navigate to GitHub Settings
1. Go to https://github.com/dtraub1/inkrockit.com
2. Click **Settings** tab
3. In left sidebar, click **Secrets and variables** → **Actions**

### 3.3 Add Repository Secrets

Click **New repository secret** and add each of the following:

#### Secret 1: DO_SSH_HOST
- **Name:** `DO_SSH_HOST`
- **Value:** `67.205.161.183`

#### Secret 2: DO_SSH_USER
- **Name:** `DO_SSH_USER`
- **Value:** `root`

#### Secret 3: DO_SSH_KEY
- **Name:** `DO_SSH_KEY`
- **Value:** (Paste the entire SSH private key from step 3.1)

#### Secret 4: DO_APP_PATH
- **Name:** `DO_APP_PATH`
- **Value:** `/var/www/inkrockit.com`

### 3.4 Verify Secrets
You should see 4 secrets listed:
- `DO_SSH_HOST`
- `DO_SSH_USER`
- `DO_SSH_KEY`
- `DO_APP_PATH`

---

## Step 4: Initial Deployment Test

### 4.1 Go to GitHub Actions
1. Navigate to https://github.com/dtraub1/inkrockit.com
2. Click **Actions** tab
3. You should see the workflow: **Deploy to DigitalOcean**

### 4.2 Run Initial Deployment
1. Click on **Deploy to DigitalOcean** workflow
2. Click **Run workflow** button (right side)
3. Select:
   - **Branch:** `main`
   - **Skip backup:** Leave unchecked (create backup)
4. Click **Run workflow**

### 4.3 Monitor Deployment
The workflow will run through these steps:
1. ✅ Checkout repository
2. ✅ Verify deployment branch
3. ✅ Setup SSH
4. ✅ Test SSH connection
5. ✅ Create deployment backup
6. ✅ Run deployment script
7. ✅ Verify deployment
8. ✅ Deployment summary

**Expected duration:** 2-3 minutes

### 4.4 Check for Errors
If any step fails:
1. Click on the failed step to see error details
2. Common issues:
   - **SSH connection failed:** Verify DO_SSH_KEY secret is correct
   - **Deployment script not found:** Verify Step 2 was completed
   - **Permission denied:** Verify scripts are executable (Step 2.5)

### 4.5 Verify Site is Live
After successful deployment:
1. Visit https://inkrockit.com
2. Hard refresh: `Cmd+Shift+R` (Mac) or `Ctrl+Shift+R` (Windows)
3. Verify site loads correctly

---

## Step 5: Test Rollback (Optional but Recommended)

### 5.1 SSH to Server
```bash
ssh kb-final
```

### 5.2 List Available Backups
```bash
ls -lh /opt/deploy/inkrockit/backups/
```

You should see at least one backup from the deployment in Step 4.

### 5.3 Test Rollback Script
```bash
sudo /opt/deploy/inkrockit/rollback.sh
```

Follow the prompts. This will:
1. Show you which backup will be restored
2. Ask for confirmation
3. Backup current state to `/var/www/inkrockit.com.pre-rollback`
4. Restore from the most recent backup
5. Restart services
6. Verify site is accessible

### 5.4 Verify Rollback Worked
```bash
# Check site status
curl -I https://inkrockit.com

# Exit SSH
exit
```

### 5.5 Visit Site
Visit https://inkrockit.com to verify it's still working.

---

## Step 6: Create a Test Change and Deploy

Let's test the full workflow with a simple change.

### 6.1 Download a File to Edit
```bash
cd /Users/jenieflortraub/Code/inkrockit.com
scp kb-final:/var/www/inkrockit.com/index.php ./
```

If you encounter permission issues downloading, you can skip this step and move to Step 7.

### 6.2 Make a Small Edit
Open `index.php` and add a comment at the top:
```php
<?php
// Last updated: [today's date]
// Repository: github.com/dtraub1/inkrockit.com
```

### 6.3 Commit and Push
```bash
git add index.php
git commit -m "Test deployment: Add repository comment to index.php"
git push origin main
```

### 6.4 Deploy via GitHub Actions
1. Go to https://github.com/dtraub1/inkrockit.com/actions
2. Click **Deploy to DigitalOcean**
3. Click **Run workflow**
4. Select `main` branch
5. Click **Run workflow**

### 6.5 Verify Change on Server
After deployment completes:
```bash
ssh kb-final "head -5 /var/www/inkrockit.com/index.php"
```

You should see your comment.

### 6.6 Verify on Live Site
Visit https://inkrockit.com (your change may not be visible on the front-end, but the deployment worked).

---

## Step 7: Download Essential Files (If Needed)

Since this is an artifact-only repository, you may want to download key files from the server to have in the repo for future edits.

### 7.1 Download Main Entry Point
```bash
scp kb-final:/var/www/inkrockit.com/index.php ./
```

Or:
```bash
scp kb-final:/var/www/inkrockit.com/index.html ./
```

### 7.2 Download Critical Assets (Optional)
```bash
# Only if you need to edit these
rsync -avz kb-final:/var/www/inkrockit.com/_nuxt/ ./_nuxt/
rsync -avz kb-final:/var/www/inkrockit.com/images/ ./images/
```

**Note:** These are large (3GB total). Only download what you need.

### 7.3 Commit Downloaded Files
```bash
git add index.php  # or index.html
git commit -m "Add main entry point from production server"
git push origin main
```

---

## Step 8: Set Up Regular Backups (Recommended)

### 8.1 SSH to Server
```bash
ssh kb-final
```

### 8.2 Create Backup Cron Job
```bash
sudo crontab -e
```

Add this line to create daily backups at 2 AM:
```cron
0 2 * * * cd /var/www && tar czf /opt/deploy/inkrockit/backups/backup-$(date +\%Y\%m\%d).tar.gz inkrockit.com/ 2>&1 | logger -t inkrockit-backup
```

Save and exit.

### 8.3 Verify Cron Job
```bash
sudo crontab -l
```

### 8.4 Test Backup Creation
```bash
cd /var/www && tar czf /opt/deploy/inkrockit/backups/backup-test-$(date +%Y%m%d).tar.gz inkrockit.com/
ls -lh /opt/deploy/inkrockit/backups/
```

### 8.5 Clean Up Test Backup
```bash
rm /opt/deploy/inkrockit/backups/backup-test-*.tar.gz
```

### 8.6 Exit SSH
```bash
exit
```

---

## Troubleshooting

### Issue: Git push fails with authentication error
**Solution:**
```bash
# Verify GitHub remote
git remote -v

# If using HTTPS, switch to SSH
git remote set-url origin git@github.com:dtraub1/inkrockit.com.git

# Try push again
git push -u origin main
```

### Issue: GitHub Actions workflow doesn't appear
**Solution:**
1. Verify `.github/workflows/deploy.yml` exists locally
2. Make sure you committed and pushed it
3. Check GitHub Actions tab - it may take a minute to appear

### Issue: SSH connection fails in GitHub Actions
**Solution:**
1. Verify DO_SSH_KEY secret contains the ENTIRE private key
2. Test SSH manually: `ssh -i ~/.ssh/kb_final_droplet root@67.205.161.183`
3. Check server firewall allows SSH from GitHub Actions IPs

### Issue: Deployment script not found on server
**Solution:**
```bash
ssh kb-final "ls -lh /opt/deploy/inkrockit/"
```

If missing, repeat Step 2.

### Issue: Permission denied during deployment
**Solution:**
```bash
ssh kb-final
sudo chmod +x /opt/deploy/inkrockit/deploy.sh
sudo chmod +x /opt/deploy/inkrockit/rollback.sh
```

### Issue: Site returns 500 error after deployment
**Solution:**
```bash
ssh kb-final

# Check Nginx error logs
sudo tail -50 /var/log/nginx/inkrockit.com-error.log

# Check PHP-FPM logs
sudo tail -50 /var/log/php8.3-fpm.log

# Restart services
sudo systemctl restart nginx php8.3-fpm

# If still broken, rollback
sudo /opt/deploy/inkrockit/rollback.sh
```

---

## What's Next?

### Short Term
✅ Repository structure complete
✅ Deployment automation working
✅ Backups configured
🔄 Download essential files as needed for editing
🔄 Test full edit → commit → deploy workflow

### Medium Term
Consider:
- Setting up staging environment
- Adding more monitoring/alerting
- Security audit of legacy PHP code
- Performance optimization

### Long Term
Plan for:
- Full site rebuild with proper Nuxt.js source code
- Modern CI/CD pipeline with automated testing
- Content management system
- Mobile-responsive redesign

---

## Support

### Documentation
- [README.md](./README.md) - Main documentation
- [DEPLOYMENT_MAP.md](./DEPLOYMENT_MAP.md) - Architecture details
- [HOW_TO_DOWNLOAD_FILES.md](./HOW_TO_DOWNLOAD_FILES.md) - File download guide

### Deployment
- GitHub Actions: https://github.com/dtraub1/inkrockit.com/actions
- Workflow file: `.github/workflows/deploy.yml`

### Server Access
```bash
ssh kb-final
```

### Emergency Rollback
```bash
ssh kb-final "sudo /opt/deploy/inkrockit/rollback.sh"
```

---

**Setup Status:** All infrastructure created. Complete Steps 1-6 to finish setup.

**Estimated Time:** 30-45 minutes for complete setup and testing.

**Next Step:** [Step 1: Commit and Push to GitHub](#step-1-commit-and-push-to-github)
