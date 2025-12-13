# File Manager System

## Overview
A comprehensive file management system for the Robotics Corner Laravel application that allows administrators to upload, organize, and manage images for courses, programs, logos, and favicons.

## Features

### 🗂️ File Organization
- **Categorized Storage**: Files are organized into different categories:
  - `site-assets/` - Logo and favicon files
  - `courses/` - Course images
  - `programs/` - Program images  
  - `enrollments/` - Payment screenshots

### 📁 File Manager Interface
- **Visual File Browser**: Grid-based interface showing file previews
- **Search & Filter**: Search by filename and filter by category
- **Bulk Operations**: Upload multiple files at once
- **File Management**: View, select, and delete files
- **Responsive Design**: Works on desktop and mobile devices

### 🎯 File Picker Component
- **Reusable Component**: `<x-file-picker>` component for forms
- **Modal Interface**: Clean file selection modal
- **Preview Support**: See selected images before confirming
- **Multiple Selection**: Support for single or multiple file selection
- **Category Filtering**: Filter files by specific categories

## Usage

### For Administrators

#### Accessing File Manager
1. Log into the admin panel
2. Navigate to "📁 File Manager" in the sidebar
3. Use the interface to upload, browse, and manage files

#### Uploading Files
1. Click "Upload Files" button
2. Select category (Site Assets, Courses, Programs, Enrollments)
3. Choose files (supports multiple selection)
4. For site assets, specify type (Logo/Favicon)
5. Click "Upload Files"

#### Using File Picker in Forms
The file picker component is already integrated into:
- Course creation/edit forms
- Program creation/edit forms

### For Developers

#### Using the File Picker Component
```blade
<x-file-picker 
    name="image" 
    label="Image" 
    value="{{ old('image') }}" 
    category="courses"
    placeholder="Select an image"
    required="true"
    multiple="false"
/>
```

#### Component Parameters
- `name` - Form field name (required)
- `label` - Display label (required)
- `value` - Current value (optional)
- `category` - File category filter (optional, default: 'all')
- `placeholder` - Placeholder text (optional)
- `required` - Required field (optional, default: false)
- `multiple` - Multiple selection (optional, default: false)

#### API Endpoints
- `GET /admin/file-manager` - File manager interface
- `POST /admin/file-manager/upload` - Upload files
- `POST /admin/file-manager/delete` - Delete files
- `GET /admin/file-manager/files` - Get files (AJAX)

## File Structure

```
storage/app/public/
├── site-assets/          # Logo and favicon files
├── courses/              # Course images
├── programs/             # Program images
└── enrollment-screenshots/ # Payment screenshots

resources/views/
├── admin/file-manager/
│   └── index.blade.php   # Main file manager interface
└── components/
    └── file-picker.blade.php # Reusable file picker component
```

## Supported File Types
- **Images**: JPEG, PNG, JPG, GIF, SVG, ICO, WebP
- **Maximum Size**: 5MB per file
- **Storage**: Local filesystem (configurable for cloud storage)

## Security Features
- **File Type Validation**: Only image files allowed
- **Size Limits**: 5MB maximum per file
- **CSRF Protection**: All forms protected with CSRF tokens
- **Admin Authentication**: File manager requires admin login
- **Path Validation**: Prevents directory traversal attacks

## Integration Points

### Course Management
- Course images are automatically stored in `courses/` directory
- File picker integrated in create/edit forms
- Images display in course listings and details

### Program Management  
- Program images stored in `programs/` directory
- File picker integrated in create/edit forms
- Images display in program listings and details

### Site Settings
- Logo and favicon files stored in `site-assets/` directory
- Automatic site setting updates when logo/favicon uploaded
- Files accessible via `/storage/site-assets/` URL

### Enrollment System
- Payment screenshots stored in `enrollment-screenshots/` directory
- Files uploaded during enrollment process
- Images visible in admin enrollment details

## Technical Details

### Controller
- `FileManagerController` handles all file operations
- Methods: `index()`, `upload()`, `delete()`, `getFiles()`
- JSON responses for AJAX operations

### Storage Configuration
- Uses Laravel's `Storage` facade
- Public disk configured for web access
- Symbolic link created for public access

### Database
- No database tables required
- File metadata stored in filesystem
- Site settings updated for logo/favicon

## Future Enhancements
- Cloud storage integration (AWS S3, Google Cloud)
- Image optimization and resizing
- File versioning and history
- Bulk file operations
- File sharing and permissions
- Advanced search and filtering

