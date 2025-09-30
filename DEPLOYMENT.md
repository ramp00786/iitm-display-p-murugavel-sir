# IITM Display Portal - Server Deployment Guide

## Environment Configuration

### For Server Environment (https://arka.tropmet.res.in/iitm-display/public/)

1. **Update .env file:**
   ```
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://arka.tropmet.res.in/iitm-display/public
   LOG_LEVEL=error
   ```

### For Local Development

1. **Update .env file:**
   ```
   APP_ENV=local
   APP_DEBUG=true
   APP_URL=http://localhost:8000
   LOG_LEVEL=debug
   ```

## Deployment Steps

1. **Copy files to server directory:**
   - Upload all files to `/path/to/iitm-display/` directory on server

2. **Set proper permissions:**
   ```bash
   chmod -R 755 storage bootstrap/cache
   chmod -R 777 storage/app storage/framework storage/logs
   ```

3. **Install dependencies:**
   ```bash
   composer install --optimize-autoloader --no-dev
   ```

4. **Configure environment:**
   ```bash
   cp .env.example .env
   # Edit .env with production settings
   php artisan key:generate
   ```

5. **Setup database:**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Create symbolic link for storage:**
   ```bash
   php artisan storage:link
   ```

7. **Clear and cache configs:**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

## Troubleshooting

### If assets (images/videos) are not loading:
1. Check that `storage` symlink exists in `public/` directory
2. Verify file permissions on `storage/app/public/`
3. Check `.env` APP_URL matches your server URL

### If API calls are failing:
1. Verify the base URL detection in JavaScript
2. Check browser developer console for 404 errors
3. Ensure `.htaccess` file exists in public directory

### If delete operations show 404:
1. Check route caching: `php artisan route:clear`
2. Verify URL generation in admin templates
3. Check server rewrite rules

## URL Structure

- **Local:** `http://localhost:8000/`
- **Server:** `https://arka.tropmet.res.in/iitm-display/public/`

The system automatically detects the environment and adjusts URLs accordingly.