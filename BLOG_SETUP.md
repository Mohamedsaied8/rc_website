# Blog System Setup Guide

## 📋 Quick Start

### 1. Database Configuration

Edit `db_config.php` and update with your database credentials:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'your_database_name');
define('DB_USER', 'your_database_user');
define('DB_PASS', 'your_database_password');
```

### 2. Run Database Schema

Execute the SQL in `database_schema.sql` on your database:

```bash
mysql -u your_user -p your_database < database_schema.sql
```

Or run it through phpMyAdmin or your database management tool.

### 3. Set Admin Credentials

Edit `admin_auth.php` and change the default admin credentials:

```php
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'your_secure_password_here');
```

**IMPORTANT**: For production, use password hashing:
```php
// Generate hash
$hash = password_hash('your_password', PASSWORD_DEFAULT);

// Then in authenticateAdmin function, use:
if ($username === ADMIN_USERNAME && password_verify($password, ADMIN_PASSWORD_HASH)) {
    // ...
}
```

### 4. Set Directory Permissions

Ensure upload directories are writable:

```bash
chmod 755 uploads/blog/covers
chmod 755 uploads/blog/content
```

### 5. Access the Blog

- **Public Blog**: `https://roboticscorner.tech/blog.php`
- **Admin Login**: `https://roboticscorner.tech/admin_login.php`
- **Admin Dashboard**: `https://roboticscorner.tech/blog_admin.php`

## 🎨 Features

### Rich Text Editor (TinyMCE)
- Full WYSIWYG editing
- Image upload within content
- Formatting tools (bold, italic, headings, lists, etc.)
- Code blocks
- Links and media embedding

### Cover Image Upload
- Automatic image optimization
- Resize to max 1200px width
- Support for JPG, PNG, WebP, GIF
- Max file size: 5MB

### Admin Features
- Create, edit, delete posts
- Draft and publish workflow
- Cover image management
- SEO-friendly slugs (auto-generated)
- Post filtering (all, published, drafts)

### Public Features
- Clean, modern blog listing
- Individual post pages
- Responsive design
- Cover image display
- SEO meta tags

## 🔐 Security Notes

1. **Change default admin credentials immediately**
2. **Use HTTPS in production**
3. **Consider adding CSRF protection**
4. **Implement rate limiting for login attempts**
5. **Use password hashing (see step 3 above)**
6. **Keep TinyMCE updated**

## 📁 File Structure

```
/
├── admin_auth.php          # Authentication helper
├── admin_login.php         # Admin login page
├── admin_logout.php        # Logout handler
├── blog_admin.php          # Admin dashboard
├── blog_create.php         # Create post page
├── blog_edit.php           # Edit post page
├── blog.php                # Public blog listing
├── blog_post.php           # Individual post view
├── database_post.php       # Post CRUD API
├── database_image.php      # Image upload API
├── db_config.php           # Database configuration
├── database_schema.sql     # Database schema
├── css/
│   └── blog-admin.css      # Admin styles
├── js/
│   └── blog-editor.js      # Editor JavaScript
└── uploads/
    └── blog/
        ├── covers/         # Cover images
        └── content/        # Content images
```

## 🚀 Usage

### Creating a Post

1. Login at `/admin_login.php`
2. Click "New Post" in dashboard
3. Enter title, upload cover image (optional)
4. Write content using the rich text editor
5. Add excerpt (optional)
6. Choose status (Draft or Published)
7. Click "Create Post"

### Editing a Post

1. Go to admin dashboard
2. Click "Edit" on any post
3. Make changes
4. Click "Update Post"

### Deleting a Post

1. Go to admin dashboard
2. Click "Delete" on any post
3. Confirm deletion

## 🔧 Customization

### Changing Colors

Edit `css/blog-admin.css` and modify the CSS variables:

```css
:root {
    --primary: #667eea;
    --primary-dark: #5568d3;
    /* ... */
}
```

### TinyMCE Configuration

Edit `js/blog-editor.js` to customize the editor:

```javascript
tinymce.init({
    // Add or remove plugins
    plugins: [...],
    // Customize toolbar
    toolbar: '...',
    // Other options
});
```

### Image Upload Limits

Edit `database_image.php`:

```php
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // Change size
define('MAX_WIDTH', 1200); // Change max width
```

## 📝 Notes

- All files are already uploaded to your server via SSHFS mount
- The system uses session-based authentication
- Images are stored in `/uploads/blog/` directory
- Slugs are auto-generated from post titles
- HTML content is sanitized for security
