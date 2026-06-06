# Quick Deployment Guide

## ✅ Files Deployed

All blog system files are now on your server at `roboticscorner.tech`:

- ✅ `admin_auth.php` - Authentication (password: roboticscorner25)
- ✅ `admin_login.php` - Login page
- ✅ `admin_logout.php` - Logout handler
- ✅ `blog_admin.php` - Admin dashboard
- ✅ `blog_create.php` - Create posts
- ✅ `blog_edit.php` - Edit posts
- ✅ `blog.php` - Public blog listing
- ✅ `blog_post.php` - Individual post view
- ✅ `database_post.php` - Post API
- ✅ `database_image.php` - Image upload API
- ✅ `db_config.php` - Database config (reads from .env)
- ✅ `css/blog-admin.css` - Styles
- ✅ `js/blog-editor.js` - Editor JavaScript
- ✅ `uploads/blog/covers/` - Cover images directory
- ✅ `uploads/blog/content/` - Content images directory

## 🚀 Next Steps

### 1. Create Database Table

Since your Laravel project uses SQLite, run this command on your server:

```bash
cd /path/to/roboticscorner
php artisan tinker
```

Then paste this code:

```php
DB::statement("
CREATE TABLE IF NOT EXISTS blog_posts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    content TEXT NOT NULL,
    excerpt TEXT,
    cover_image VARCHAR(255) DEFAULT NULL,
    author_id INTEGER,
    status VARCHAR(20) DEFAULT 'draft',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");
```

Type `exit` to leave tinker.

### 2. Test the System

Visit these URLs:

- **Admin Login**: `https://roboticscorner.tech/admin_login.php`
  - Username: `admin`
  - Password: `roboticscorner25`
  
- **Admin Dashboard**: `https://roboticscorner.tech/blog_admin.php`

- **Public Blog**: `https://roboticscorner.tech/blog.php`

### 3. Create Your First Post

1. Login at `/admin_login.php`
2. Click "New Post"
3. Add title, content, and cover image
4. Click "Create Post"

## 🔧 Troubleshooting

### If you get "Database connection failed":

The system now reads from your Laravel `.env` file. Make sure your `.env` has:
```
DB_CONNECTION=sqlite
DB_DATABASE=/full/path/to/database.sqlite
```

### If you get "Permission denied" for uploads:

Run on your server:
```bash
chmod 755 uploads/blog/covers
chmod 755 uploads/blog/content
```

### If pages show 404:

Make sure the PHP files are in your web root directory (usually `public_html` or `public`).

## 📝 Admin Credentials

- **Username**: `admin`
- **Password**: `roboticscorner25`

**IMPORTANT**: Change the password in `admin_auth.php` line 14 for production use!

## 🎨 Features Ready to Use

- ✅ Rich text editor (TinyMCE)
- ✅ Cover image upload
- ✅ Image optimization (auto-resize to 1200px)
- ✅ Draft/Published workflow
- ✅ SEO-friendly slugs
- ✅ Responsive design
- ✅ Admin-only access

All files are deployed and ready. Just create the database table and start blogging!
