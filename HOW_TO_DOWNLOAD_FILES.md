# How to Download Files from the Production Server

Since this is an artifact-only repository, you may need to download specific files from the production server to edit them locally before deploying changes.

---

## Quick Reference

### Single File
```bash
scp kb-final:/var/www/inkrockit.com/filename.php ./
```

### Multiple Files
```bash
scp kb-final:/var/www/inkrockit.com/{file1.php,file2.html,file3.css} ./
```

### Entire Directory
```bash
rsync -avz kb-final:/var/www/inkrockit.com/directory/ ./directory/
```

---

## Method 1: SCP (Secure Copy)

**Best for:** Individual files or small sets of files

### Download a single file
```bash
scp kb-final:/var/www/inkrockit.com/index.php ./
```

### Download to specific location
```bash
scp kb-final:/var/www/inkrockit.com/index.php ./local-directory/
```

### Download multiple files
```bash
scp kb-final:/var/www/inkrockit.com/{index.php,about.html,styles.css} ./
```

### Download entire directory
```bash
scp -r kb-final:/var/www/inkrockit.com/_nuxt/ ./_nuxt/
```

---

## Method 2: rsync (Recommended for Large Transfers)

**Best for:** Directories, large files, or syncing multiple files

### Download entire site
```bash
rsync -avz \
  --exclude='._*' \
  --exclude='.DS_Store' \
  --exclude='*~' \
  --exclude='*.bak' \
  --exclude='*.log' \
  kb-final:/var/www/inkrockit.com/ ./
```

### Download specific directory
```bash
rsync -avz kb-final:/var/www/inkrockit.com/_nuxt/ ./_nuxt/
```

### Download with progress indicator
```bash
rsync -avz --progress kb-final:/var/www/inkrockit.com/ ./
```

### Dry run (see what would be downloaded)
```bash
rsync -avzn kb-final:/var/www/inkrockit.com/ ./
```

### rsync flags explained
- `-a` = archive mode (preserves permissions, timestamps, etc.)
- `-v` = verbose output
- `-z` = compress during transfer
- `-n` = dry run (don't actually download)
- `--progress` = show progress bar
- `--exclude` = skip matching files/directories

---

## Method 3: SFTP (Interactive)

**Best for:** Browsing and selective downloads

### Start SFTP session
```bash
sftp kb-final
```

### Navigate and download
```
sftp> cd /var/www/inkrockit.com
sftp> ls
sftp> get index.php
sftp> get -r _nuxt/
sftp> quit
```

### Common SFTP commands
- `ls` = list remote files
- `cd` = change remote directory
- `pwd` = show remote directory
- `get filename` = download file
- `get -r directory` = download directory recursively
- `mget *.php` = download multiple files matching pattern
- `lcd /local/path` = change local directory
- `quit` = exit SFTP

---

## Method 4: Direct via SSH (For Text Files)

**Best for:** Quick view or small text files

### View and copy file content
```bash
ssh kb-final "cat /var/www/inkrockit.com/index.php"
```

### Save to local file
```bash
ssh kb-final "cat /var/www/inkrockit.com/index.php" > index.php
```

### View first 50 lines
```bash
ssh kb-final "head -50 /var/www/inkrockit.com/index.php"
```

---

## Download Specific Components

### Main Nuxt.js Files
```bash
# Main entry point
scp kb-final:/var/www/inkrockit.com/index.php ./

# Or HTML version
scp kb-final:/var/www/inkrockit.com/index.html ./

# Compiled JavaScript bundles
rsync -avz kb-final:/var/www/inkrockit.com/_nuxt/ ./_nuxt/
```

### Images and Media
```bash
# All images
rsync -avz kb-final:/var/www/inkrockit.com/images/ ./images/

# Specific product images
rsync -avz kb-final:/var/www/inkrockit.com/custom_folders/ ./custom_folders/
rsync -avz kb-final:/var/www/inkrockit.com/custom_photo_frames/ ./custom_photo_frames/
```

### Legacy PHP Files
```bash
# Database connection config (if needed)
scp kb-final:/var/www/inkrockit.com/includes/db_connection.php ./config/

# Specific PHP pages
scp kb-final:/var/www/inkrockit.com/about.html ./
```

### Configuration Files
```bash
# Nginx config
ssh kb-final "cat /etc/nginx/sites-available/inkrockit.com" > config/nginx.conf

# PHP-FPM config
ssh kb-final "cat /etc/php/8.3/fpm/pool.d/www.conf" > config/php-fpm.conf
```

---

## Excluding Unwanted Files

When using rsync, always exclude these:

```bash
rsync -avz \
  --exclude='._*' \
  --exclude='.DS_Store' \
  --exclude='.DS_Store?' \
  --exclude='*~' \
  --exclude='*.bak' \
  --exclude='*.backup' \
  --exclude='*.log' \
  --exclude='*.tmp' \
  --exclude='cache/' \
  --exclude='tmp/' \
  kb-final:/var/www/inkrockit.com/ ./
```

---

## Creating a Complete Backup

### Full site backup
```bash
# Create timestamped backup directory
mkdir -p backups/$(date +%Y%m%d)

# Download everything
rsync -avz \
  --exclude='._*' \
  --exclude='.DS_Store' \
  kb-final:/var/www/inkrockit.com/ \
  backups/$(date +%Y%m%d)/

# Create compressed archive
tar czf inkrockit-backup-$(date +%Y%m%d).tar.gz backups/$(date +%Y%m%d)/
```

### Server-side backup (recommended for large sites)
```bash
# Create backup on server
ssh kb-final "cd /var/www && tar czf /tmp/inkrockit-backup-$(date +%Y%m%d).tar.gz inkrockit.com/"

# Download the archive
scp kb-final:/tmp/inkrockit-backup-*.tar.gz ./backups/

# Clean up server
ssh kb-final "rm /tmp/inkrockit-backup-*.tar.gz"
```

---

## Troubleshooting

### Permission Denied
```bash
# Check your SSH key
ssh kb-final "whoami"

# Verify file permissions on server
ssh kb-final "ls -la /var/www/inkrockit.com/filename.php"
```

### File Not Found
```bash
# Verify the file exists
ssh kb-final "ls -la /var/www/inkrockit.com/"

# Search for the file
ssh kb-final "find /var/www/inkrockit.com -name 'filename.php'"
```

### Connection Timeout
```bash
# Test SSH connection
ssh kb-final "echo 'Connected successfully'"

# Check SSH config
cat ~/.ssh/config | grep -A 5 "kb-final"
```

### Slow Transfer
```bash
# Use compression
rsync -avz --compress-level=9 kb-final:/var/www/inkrockit.com/ ./

# Or disable compression for pre-compressed files
rsync -av --no-compress kb-final:/var/www/inkrockit.com/ ./
```

---

## Best Practices

### 1. Download Only What You Need
- Don't download the entire 3GB site unless necessary
- Target specific files or directories
- Exclude large media files if not needed

### 2. Use rsync for Large Transfers
- More efficient than scp for multiple files
- Supports resume if interrupted
- Can do incremental updates

### 3. Verify After Download
```bash
# Check file size matches
ls -lh filename.php
ssh kb-final "ls -lh /var/www/inkrockit.com/filename.php"

# Compare checksums
md5 filename.php
ssh kb-final "md5sum /var/www/inkrockit.com/filename.php"
```

### 4. Keep Local Copy Organized
```bash
# Match server structure
mkdir -p includes images _nuxt config

# Document what you downloaded
echo "$(date): Downloaded index.php from production" >> DOWNLOAD_LOG.txt
```

---

## After Editing Files

Once you've edited files locally:

1. **Test locally if possible** (though full testing may not be possible without source code)
2. **Commit changes to Git**
   ```bash
   git add .
   git commit -m "Update: description of changes"
   git push origin main
   ```
3. **Deploy via GitHub Actions**
   - Go to Actions tab in GitHub
   - Run "Deploy to DigitalOcean" workflow
4. **Verify on production site**
   - Visit https://inkrockit.com
   - Hard refresh (Cmd+Shift+R or Ctrl+Shift+R)
   - Check browser console for errors

---

## Quick Reference Card

```bash
# Download single file
scp kb-final:/var/www/inkrockit.com/file.php ./

# Download directory
rsync -avz kb-final:/var/www/inkrockit.com/directory/ ./directory/

# Download entire site (selective)
rsync -avz --exclude='._*' --exclude='.DS_Store' \
  kb-final:/var/www/inkrockit.com/ ./

# Create server backup
ssh kb-final "cd /var/www && tar czf /tmp/backup.tar.gz inkrockit.com/"
scp kb-final:/tmp/backup.tar.gz ./

# Browse interactively
sftp kb-final
```

---

**Need help?** Check the [README.md](./README.md) or [DEPLOYMENT_MAP.md](./DEPLOYMENT_MAP.md) for more information.
