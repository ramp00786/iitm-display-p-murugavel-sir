# IITM Display Portal

A comprehensive Laravel-based digital display system for the Indian Institute of Tropical Meteorology (IITM) featuring slideshows, videos, news management, and advanced meteorological data visualization.

## 🌟 Features

### 📺 Display Management
- **Slideshow System**: Image carousel with configurable timing and single-run mode
- **Video Player**: MP4/AVI/MOV video playback with queue management
- **News Ticker**: Scrolling news with category-based filtering
- **Loading Screen**: Smooth fade-in transitions between content

### 📊 Meteorological Data Visualization
- **Multiple Chart Types**: Bar, Line, Area, Pie, Doughnut, Radar, Polar Area, Scatter, and **Bubble Charts**
- **Interactive Charts**: Chart.js powered visualizations with real-time data
- **Tab Management**: Organized data display by stations (Delhi, Chennai, Pune, Solapur)
- **Chart Data Management**: Full CRUD operations with preview functionality

### 🔐 Admin Panel
- **User Authentication**: Secure login system with password protection
- **Content Management**: Upload and manage slideshows, videos, and news
- **Delete Protection**: Password-protected deletion for all content types
- **Modern Dashboard**: Real-time statistics, activity feeds, and system health monitoring
- **Responsive Design**: Mobile-friendly admin interface

### 🎨 User Interface
- **Modern Design**: Gradient cards, smooth animations, and professional styling
- **Real-time Updates**: Live data refresh without page reload
- **Drag & Drop**: File upload with progress tracking
- **Toast Notifications**: User-friendly success/error messages

## 🚀 Installation

### Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js & NPM
- MySQL/MariaDB
- Web server (Apache/Nginx)

### Step 1: Clone Repository
```bash
git clone https://github.com/ramp00786/iitm-display-p-murugavel-sir.git
cd iitm-display-p-murugavel-sir
```

### Step 2: Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### Step 3: Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 4: Database Configuration
Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=iitm_display_portal
DB_USERNAME=your_username
DB_PASSWORD=your_password
DB_PREFIX=iitmdp_
```

### Step 5: Database Migration
```bash
# Create database tables
php artisan migrate

# Seed default data
php artisan db:seed
```

### Step 6: Storage Setup
```bash
# Create storage symlink
php artisan storage:link

# Set permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Step 7: Build Assets
```bash
# Compile assets
npm run build
```

### Step 8: Start Development Server
```bash
# Start Laravel server
php artisan serve
```

Visit `http://localhost:8000` to access the application.

## 📁 Project Structure

```
iitm-display-portal/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/                  # Admin panel controllers
│   │   │   ├── MeteorologicalController.php
│   │   │   ├── NewsController.php
│   │   │   ├── SlideshowController.php
│   │   │   └── VideoController.php
│   │   └── Api/
│   │       └── DisplayDataController.php
│   └── Models/
│       ├── Category.php
│       ├── MeteorologicalTab.php
│       ├── MeteorologicalChart.php
│       ├── ChartData.php
│       ├── News.php
│       ├── Slideshow.php
│       ├── User.php
│       └── Video.php
├── resources/
│   ├── views/
│   │   ├── admin/                  # Admin panel views
│   │   ├── auth/                   # Authentication views
│   │   ├── layouts/                # Layout templates
│   │   └── home.blade.php          # Main display page
│   ├── css/
│   └── js/
├── public/
│   ├── js/
│   │   └── display-system.js       # Main frontend system
│   ├── css/
│   └── storage/                    # Uploaded files
├── database/
│   ├── migrations/
│   └── seeders/
└── storage/
    └── app/public/                 # File storage
```

## 🎯 Usage

### Admin Panel Access
1. Navigate to `/admin`
2. Login with admin credentials
3. Access dashboard for system overview

### Content Management

#### Slideshows
- Upload images (JPG, PNG, GIF)
- Set display order
- Configure timing
- Preview before publishing

#### Videos
- Upload videos (MP4, AVI, MOV)
- Auto-generated thumbnails
- Queue management
- File size validation (up to 100MB)

#### News Management
- Create categorized news items
- Rich text editor
- Publication status control
- Category-based filtering

#### Meteorological Charts
1. **Create Tab**: Organize charts by station/topic
2. **Add Charts**: Choose from 9 chart types including bubble charts
3. **Input Data**: 
   - **Regular charts**: Comma-separated values
   - **Bubble charts**: `x,y,radius` format separated by semicolons
   - **Example**: `20,30,15;40,10,10;60,20,8`
4. **Preview**: Real-time chart preview
5. **Publish**: Make charts available on display

### Display System
- Automatic slideshow rotation
- Video playback queue
- News ticker scrolling
- Chart data visualization
- Responsive layout adaptation

## 🔧 Configuration

### Environment Variables
```env
# Application
APP_NAME="IITM Display Portal"
APP_ENV=production
APP_URL=https://your-domain.com

# File Upload Limits
MAX_VIDEO_SIZE=104857600          # 100MB in bytes
MAX_IMAGE_SIZE=10485760           # 10MB in bytes
SUPPORTED_VIDEO_FORMATS=mp4,avi,mov
SUPPORTED_IMAGE_FORMATS=jpg,jpeg,png,gif

# Database
DB_PREFIX=iitmdp_                 # Table prefix for shared hosting
```

### Server Deployment
For subdirectory deployment (e.g., `https://domain.com/iitm-display/`):
1. Update `APP_URL` in `.env`
2. The system auto-detects subdirectory deployment
3. URLs are automatically configured via `AppServiceProvider`

## 🎨 Chart Types Supported

| Chart Type | Data Format | Example |
|------------|-------------|---------|
| Bar | Comma-separated | `10, 20, 30, 40` |
| Line | Comma-separated | `15, 25, 35, 45` |
| Area | Comma-separated | `5, 15, 25, 35` |
| Pie | Comma-separated | `30, 40, 20, 10` |
| Doughnut | Comma-separated | `25, 35, 25, 15` |
| Radar | Comma-separated | `80, 90, 70, 85` |
| Polar Area | Comma-separated | `20, 30, 40, 50` |
| Scatter | x,y pairs | `10,20;30,40;50,60` |
| **Bubble** | x,y,radius triplets | `20,30,15;40,10,10;60,20,8` |

## 🛠️ Development

### Code Style
- PSR-12 PHP coding standard
- Laravel best practices
- ES6+ JavaScript
- Modern CSS with Bootstrap

### Key Technologies
- **Backend**: Laravel 11, PHP 8.1+
- **Frontend**: Blade templates, Chart.js, Bootstrap 5
- **Database**: MySQL with Eloquent ORM
- **File Storage**: Laravel filesystem
- **Authentication**: Laravel built-in auth

### Recent Improvements
- ✅ Fixed bubble chart rendering issues
- ✅ Enhanced data input validation for all chart types
- ✅ Improved chart preview functionality
- ✅ Added comprehensive error handling
- ✅ Implemented password-protected deletion
- ✅ Modern dashboard with real-time statistics

## 🔍 Troubleshooting

### Common Issues

**1. Bubble Charts Not Displaying**
- Ensure data format: `x,y,radius;x,y,radius`
- Check Chart.js version compatibility
- Verify linear scales configuration

**2. File Upload Errors**
- Check `upload_max_filesize` in PHP.ini
- Verify storage permissions (775)
- Ensure storage symlink exists

**3. Charts Not Loading**
- Verify Chart.js CDN accessibility
- Check browser console for JavaScript errors
- Ensure proper data format in database

**4. Authentication Issues**
- Run `php artisan config:cache`
- Check session configuration
- Verify database connection

### Debug Mode
Enable debug mode in `.env`:
```env
APP_DEBUG=true
LOG_LEVEL=debug
```

## 📊 Database Schema

### Core Tables
- `users` - Admin user management
- `categories` - News categories
- `news` - News articles
- `slideshows` - Image slides
- `videos` - Video files
- `meteorological_tabs` - Chart organization
- `meteorological_charts` - Chart definitions
- `chart_data` - Chart datasets

## 🔒 Security Features

- Password-protected admin panel
- CSRF protection on all forms
- File type validation
- Secure file storage
- XSS protection
- SQL injection prevention
- Password-protected deletion operations

## 📱 Browser Compatibility

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+
- Mobile browsers (iOS Safari, Chrome Mobile)

## 🤝 Contributing

1. Fork the repository
2. Create feature branch (`git checkout -b feature/new-feature`)
3. Commit changes (`git commit -m 'Add new feature'`)
4. Push to branch (`git push origin feature/new-feature`)
5. Create Pull Request

## 📄 License

This project is developed for IITM (Indian Institute of Tropical Meteorology) internal use.

## 👥 Support

For technical support or feature requests, contact the development team.

---

**Last Updated**: September 2025  
**Version**: 2.0  
**Status**: Production Ready ✅
