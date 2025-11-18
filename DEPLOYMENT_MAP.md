# InkRockit.com - Deployment Architecture Map

**Generated:** 2025-11-17
**Target Domain:** https://inkrockit.com
**DigitalOcean Droplet:** kb-final (67.205.161.183)

---

## Executive Summary

InkRockit.com is a **static Nuxt.js/Vue.js website** deployed on a LEMP stack (Linux, Nginx, MySQL, PHP). The production site serves pre-compiled JavaScript bundles with legacy PHP files present but not actively used for the main site.

**⚠️ CRITICAL FINDING:** The Nuxt.js source code is NOT present on the server. Only the compiled/built static files exist in the webroot. The source code must be recovered from local development environments or other repositories.

---

## 1. Domain → Droplet Mapping

| Domain | Droplet | IP Address | Status |
|--------|---------|------------|--------|
| inkrockit.com | kb-final | 67.205.161.183 | Active |
| www.inkrockit.com | kb-final | 67.205.161.183 | Redirects to inkrockit.com |
| staging.inkrockit.com | kb-final | 67.205.161.183 | Active (separate deployment) |

**Note:** This extraction focuses ONLY on production `inkrockit.com`, not staging.

---

## 2. Web Server Configuration

### Nginx Configuration
- **Config File:** `/etc/nginx/sites-available/inkrockit.com`
- **Document Root:** `/var/www/inkrockit.com`
- **Index Files:** `index.php`, `index.html`
- **SSL/TLS:** Let's Encrypt (auto-managed by Certbot)
  - Certificate: `/etc/letsencrypt/live/inkrockit.com/fullchain.pem`
  - Private Key: `/etc/letsencrypt/live/inkrockit.com/privkey.pem`

### PHP-FPM
- **Primary Version:** PHP 8.3-FPM
- **Socket:** `unix:/run/php/php8.3-fpm.sock`
- **Secondary:** PHP 7.4-FPM (also running, possibly for other sites)

### URL Rewrite Rules
```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

---

## 3. Application Stack & Technology

### Primary Application (Production Site)
- **Framework:** Nuxt.js (Vue.js) - **Static Site Generation (SSG)**
- **Entry Point:** `/var/www/inkrockit.com/index.php` or `index.html`
- **Compiled Assets:** `/var/www/inkrockit.com/_nuxt/` (JavaScript bundles)
- **Build Tool:** Nuxt.js build system (source code not on server)
- **Rendering:** Server-Side Rendered (SSR) at build time, served as static HTML

### Legacy Components (Inactive for Main Site)
- **osCommerce:** `/var/www/inkrockit.com/oscatalog/`
- **Custom PHP Scripts:** Various `.php` files in webroot
- **phpCollab:** `/var/www/inkrockit.com/phpCollab/`
- **These components appear to be remnants from a previous implementation**

---

## 4. Database Configuration

### MySQL/MariaDB
- **Service:** MySQL Community Server
- **Host:** localhost
- **Status:** Running

### Database Credentials (Found in Code)
- **Database:** `db37838_imageteam_com_catalog`
- **Username:** `imageteam`
- **Password:** `mmtldm6` (hardcoded in `/var/www/inkrockit.com/includes/db_connection.php`)

### ⚠️ Database Status
**CRITICAL:** The database `db37838_imageteam_com_catalog` **DOES NOT EXIST** on the server.

**Available Databases:**
- `amigosanta_db` (unrelated)
- `preprod` (likely for pre-production environment)
- MySQL system databases

**Analysis:** The main production Nuxt.js site does NOT use a database—it's a fully static site. The database references are from legacy PHP components no longer in active use.

---

## 5. File System Structure

### Application Root
```
/var/www/inkrockit.com/
├── index.php / index.html          # Main entry point (Nuxt.js static output)
├── _nuxt/                           # Compiled JavaScript bundles
│   ├── *.js                        # Vue.js components, router, etc.
│   └── (various build artifacts)
├── images/                          # Static images
├── includes/                        # Legacy PHP includes
│   └── db_connection.php           # Database config (deprecated)
├── oscatalog/                       # osCommerce (legacy)
├── phpCollab/                       # phpCollab (legacy)
├── domains/                         # Additional domain assets
├── custom_folders/                  # Product category assets
├── custom_photo_frames/             # Product category assets
├── samples/                         # Sample images
├── upload/                          # User uploads
└── (hundreds of legacy .php files) # Old e-commerce system
```

**Total Size:** 3.0 GB (mostly images and media files)

---

## 6. Dependencies & Services

### Runtime Services (Active)
- **Nginx 1.18.0** - Web server
- **PHP 8.3-FPM** - PHP processor
- **MySQL Community Server** - Database server

### Build Dependencies (Not on Server)
The Nuxt.js source code and build environment are NOT present on the server. Expected dependencies (if source were available):
- Node.js (version unknown)
- npm or yarn (package manager)
- Nuxt.js framework
- Vue.js and related packages

### Scheduled Tasks
- **Cron Jobs:** None configured for this application
- **Systemd Services:** Standard web stack only

---

## 7. Deployment History & Insights

### Current Deployment Model
The site appears to be deployed using a **manual upload** method:
1. Nuxt.js site built locally (source code location unknown)
2. Static dist files uploaded to `/var/www/inkrockit.com` via FTP/SFTP
3. No Git repository present in production webroot
4. No automated build/deploy pipeline detected

### Evidence of Migration
- osCommerce references to old hosting paths: `/home/virtual/site339/fst/var/www/html/`
- Suggests the site was migrated from shared hosting to current DigitalOcean droplet
- Legacy database name pattern: `db37838_imageteam_com_catalog`

### Git Repositories on Server
Found Git repos for other projects, but NOT for inkrockit.com production:
- `/var/www/preprod.inkrockit.com/.git` (different PHP framework)
- `/var/www/amigosanta.com/.git`
- `/var/www/photoframepros.com/.git`
- `/var/www/voxmindai.com/knowledge-base/.git`

---

## 8. Security Considerations

### Credentials in Code (TO BE EXTERNALIZED)
- ✅ Database password hardcoded in `includes/db_connection.php`
- ✅ osCommerce config files contain old server paths
- ✅ Multiple PHP files use deprecated `mysql_connect()` functions

### SSL/TLS
- ✅ Valid Let's Encrypt certificate
- ✅ HTTPS enforced with 301 redirects

### File Permissions
- Owner: `www-data:www-data`
- Typical permissions: 644 for files, 755 for directories

---

## 9. Missing Components

### Source Code
**STATUS:** ❌ Not present on server

The Nuxt.js source code (Vue components, pages, layouts, nuxt.config.js, package.json, etc.) is NOT on the production server. To create a complete development-ready repository, we need:

1. **Nuxt.js source code** from:
   - Local development machine
   - Private GitHub repository
   - Backup archives
   - Developer workstations

2. **Build configuration:**
   - `nuxt.config.js` or `nuxt.config.ts`
   - `package.json` with dependencies
   - `.env` files with environment variables
   - Build scripts and configurations

### What We CAN Extract
- ✅ Compiled static site (HTML, CSS, JS bundles)
- ✅ Legacy PHP codebase (for reference)
- ✅ Static assets (images, media files)
- ✅ Nginx configuration
- ✅ Database schema (if we recreate the database)

---

## 10. Recommended Next Steps

### Immediate Actions
1. **Locate Nuxt.js source code** on local development machines
2. **Extract static site** from server as backup
3. **Document environment variables** and configuration
4. **Audit and remove unused legacy code** (osCommerce, old PHP files)

### Deployment Modernization
1. **Create GitHub repository** with source code
2. **Set up CI/CD pipeline** for automated builds
3. **Implement deployment script** to sync static files to server
4. **Configure environment-based builds** (staging vs production)
5. **Add server-side caching** for Nuxt.js dist files

---

## 11. Contact Information

### Server Access
- **SSH Host:** kb-final (67.205.161.183)
- **SSH User:** root
- **SSH Config:** `~/.ssh/config` (entry: kb-final)
- **SSH Key:** `~/.ssh/kb_final_droplet`

### Domain Management
- **SSL Certificate Management:** Certbot (auto-renewal configured)

---

## Appendix A: Key File Locations

| Purpose | Path |
|---------|------|
| Nginx Config | `/etc/nginx/sites-available/inkrockit.com` |
| Application Root | `/var/www/inkrockit.com` |
| Compiled Nuxt Assets | `/var/www/inkrockit.com/_nuxt/` |
| Legacy DB Config | `/var/www/inkrockit.com/includes/db_connection.php` |
| SSL Certificate | `/etc/letsencrypt/live/inkrockit.com/fullchain.pem` |
| PHP-FPM Socket | `/run/php/php8.3-fpm.sock` |
| Access Logs | `/var/log/nginx/inkrockit.com-access.log` |
| Error Logs | `/var/log/nginx/inkrockit.com-error.log` |

---

## Appendix B: Tech Stack Summary

```
┌─────────────────────────────────────┐
│     Client Browser (HTTPS)          │
└─────────────┬───────────────────────┘
              │
              ▼
┌─────────────────────────────────────┐
│  Nginx 1.18.0 (Port 443)            │
│  - SSL/TLS Termination              │
│  - Static File Serving              │
│  - Reverse Proxy to PHP-FPM         │
└─────────────┬───────────────────────┘
              │
              ├──► Static Files (.html, .css, .js, images)
              │    from /var/www/inkrockit.com
              │
              └──► PHP Files (.php) [LEGACY - RARELY USED]
                   │
                   ▼
         ┌─────────────────────────┐
         │   PHP 8.3-FPM           │
         └─────────┬───────────────┘
                   │
                   ▼
         ┌─────────────────────────┐
         │   MySQL (NOT USED)      │
         │   db: does not exist    │
         └─────────────────────────┘
```

---

**End of Deployment Map**
