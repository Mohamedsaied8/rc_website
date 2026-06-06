<?php
/**
 * Image Upload Handler
 * Handles cover image and content image uploads
 */

require_once 'admin_auth.php';

header('Content-Type: application/json');

// Only allow admin access
if (!isAdminLoggedIn()) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// Configuration
define('UPLOAD_DIR', __DIR__ . '/uploads/blog/');
define('COVER_DIR', UPLOAD_DIR . 'covers/');
define('CONTENT_DIR', UPLOAD_DIR . 'content/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_TYPES', ['image/jpeg', 'image/png', 'image/webp', 'image/gif']);
define('MAX_WIDTH', 1200);

// Create upload directories if they don't exist
if (!file_exists(COVER_DIR)) {
    mkdir(COVER_DIR, 0755, true);
}
if (!file_exists(CONTENT_DIR)) {
    mkdir(CONTENT_DIR, 0755, true);
}

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        handleUpload();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        handleDelete();
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

/**
 * Handle image upload
 */
function handleUpload()
{
    if (!isset($_FILES['image'])) {
        http_response_code(400);
        echo json_encode(['error' => 'No image file provided']);
        return;
    }

    $file = $_FILES['image'];
    $type = $_POST['type'] ?? 'cover'; // 'cover' or 'content'

    // Validate file
    $validation = validateImage($file);
    if ($validation !== true) {
        http_response_code(400);
        echo json_encode(['error' => $validation]);
        return;
    }

    // Determine upload directory
    $uploadDir = ($type === 'cover') ? COVER_DIR : CONTENT_DIR;

    // Generate unique filename
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $filename = uniqid('img_' . time() . '_') . '.' . $extension;
    $filepath = $uploadDir . $filename;

    // Move uploaded file
    if (!move_uploaded_file($file['tmp_name'], $filepath)) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to save image']);
        return;
    }

    // Optimize and resize image
    optimizeImage($filepath, $extension);

    // Return relative path
    $relativePath = 'uploads/blog/' . ($type === 'cover' ? 'covers/' : 'content/') . $filename;

    echo json_encode([
        'success' => true,
        'url' => $relativePath,
        'filename' => $filename
    ]);
}

/**
 * Handle image deletion
 */
function handleDelete()
{
    $data = json_decode(file_get_contents('php://input'), true);
    $imagePath = $data['path'] ?? '';

    if (empty($imagePath)) {
        http_response_code(400);
        echo json_encode(['error' => 'Image path is required']);
        return;
    }

    $fullPath = __DIR__ . '/' . $imagePath;

    // Security check - ensure path is within upload directory
    $realPath = realpath($fullPath);
    $uploadPath = realpath(UPLOAD_DIR);

    if ($realPath === false || strpos($realPath, $uploadPath) !== 0) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid image path']);
        return;
    }

    if (file_exists($fullPath)) {
        unlink($fullPath);
        echo json_encode(['success' => true]);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Image not found']);
    }
}

/**
 * Validate uploaded image
 */
function validateImage($file)
{
    // Check for upload errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return 'Upload error occurred';
    }

    // Check file size
    if ($file['size'] > MAX_FILE_SIZE) {
        return 'File size exceeds 5MB limit';
    }

    // Check file type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mimeType, ALLOWED_TYPES)) {
        return 'Invalid file type. Only JPG, PNG, WebP, and GIF are allowed';
    }

    // Check if it's actually an image
    $imageInfo = getimagesize($file['tmp_name']);
    if ($imageInfo === false) {
        return 'File is not a valid image';
    }

    return true;
}

/**
 * Optimize and resize image
 */
function optimizeImage($filepath, $extension)
{
    $imageInfo = getimagesize($filepath);
    $width = $imageInfo[0];
    $height = $imageInfo[1];

    // Only resize if width exceeds max
    if ($width <= MAX_WIDTH) {
        return;
    }

    $newWidth = MAX_WIDTH;
    $newHeight = (int) ($height * ($newWidth / $width));

    // Create image resource based on type
    switch ($extension) {
        case 'jpg':
        case 'jpeg':
            $source = imagecreatefromjpeg($filepath);
            break;
        case 'png':
            $source = imagecreatefrompng($filepath);
            break;
        case 'webp':
            $source = imagecreatefromwebp($filepath);
            break;
        case 'gif':
            $source = imagecreatefromgif($filepath);
            break;
        default:
            return;
    }

    if (!$source) {
        return;
    }

    // Create resized image
    $resized = imagecreatetruecolor($newWidth, $newHeight);

    // Preserve transparency for PNG and GIF
    if ($extension === 'png' || $extension === 'gif') {
        imagealphablending($resized, false);
        imagesavealpha($resized, true);
        $transparent = imagecolorallocatealpha($resized, 255, 255, 255, 127);
        imagefilledrectangle($resized, 0, 0, $newWidth, $newHeight, $transparent);
    }

    imagecopyresampled($resized, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    // Save optimized image
    switch ($extension) {
        case 'jpg':
        case 'jpeg':
            imagejpeg($resized, $filepath, 85);
            break;
        case 'png':
            imagepng($resized, $filepath, 8);
            break;
        case 'webp':
            imagewebp($resized, $filepath, 85);
            break;
        case 'gif':
            imagegif($resized, $filepath);
            break;
    }

    imagedestroy($source);
    imagedestroy($resized);
}
