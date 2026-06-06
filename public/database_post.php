<?php
/**
 * Blog Post Database Operations - SQLite3 Version
 * Handles CRUD operations for blog posts
 */

require_once 'db_config.php';
require_once 'admin_auth.php';

header('Content-Type: application/json');

// Only allow admin access
if (!isAdminLoggedIn()) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

try {
    switch ($method) {
        case 'GET':
            handleGet();
            break;
        case 'POST':
            handlePost();
            break;
        case 'PUT':
            handlePut();
            break;
        case 'DELETE':
            handleDelete();
            break;
        default:
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

/**
 * GET - Retrieve posts
 */
function handleGet()
{
    $id = $_GET['id'] ?? null;

    if ($id) {
        // Get single post
        $post = fetchOne("SELECT * FROM blog_posts WHERE id = ?", [1 => $id]);

        if ($post) {
            echo json_encode($post);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Post not found']);
        }
    } else {
        // Get all posts
        $status = $_GET['status'] ?? null;

        if ($status) {
            $posts = fetchAll("SELECT * FROM blog_posts WHERE status = ? ORDER BY created_at DESC", [1 => $status]);
        } else {
            $posts = fetchAll("SELECT * FROM blog_posts ORDER BY created_at DESC");
        }

        echo json_encode($posts);
    }
}

/**
 * POST - Create new post
 */
function handlePost()
{
    $data = json_decode(file_get_contents('php://input'), true);

    $title = $data['title'] ?? '';
    $content = $data['content'] ?? '';
    $excerpt = $data['excerpt'] ?? '';
    $coverImage = $data['cover_image'] ?? null;
    $status = $data['status'] ?? 'draft';

    // Validate required fields
    if (empty($title) || empty($content)) {
        http_response_code(400);
        echo json_encode(['error' => 'Title and content are required']);
        return;
    }

    // Generate slug from title
    $slug = generateSlug($title);

    // Sanitize HTML content
    $content = sanitizeHTML($content);

    $db = getDBConnection();
    $stmt = $db->prepare("
        INSERT INTO blog_posts (title, slug, content, excerpt, cover_image, status, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, datetime('now'), datetime('now'))
    ");

    $stmt->bindValue(1, $title, SQLITE3_TEXT);
    $stmt->bindValue(2, $slug, SQLITE3_TEXT);
    $stmt->bindValue(3, $content, SQLITE3_TEXT);
    $stmt->bindValue(4, $excerpt, SQLITE3_TEXT);
    $stmt->bindValue(5, $coverImage, SQLITE3_TEXT);
    $stmt->bindValue(6, $status, SQLITE3_TEXT);

    $stmt->execute();
    $postId = $db->lastInsertRowID();

    echo json_encode([
        'success' => true,
        'id' => $postId,
        'slug' => $slug
    ]);
}

/**
 * PUT - Update existing post
 */
function handlePut()
{
    $data = json_decode(file_get_contents('php://input'), true);

    $id = $data['id'] ?? null;

    if (!$id) {
        http_response_code(400);
        echo json_encode(['error' => 'Post ID is required']);
        return;
    }

    $title = $data['title'] ?? '';
    $content = $data['content'] ?? '';
    $excerpt = $data['excerpt'] ?? '';
    $coverImage = $data['cover_image'] ?? null;
    $status = $data['status'] ?? 'draft';

    // Validate required fields
    if (empty($title) || empty($content)) {
        http_response_code(400);
        echo json_encode(['error' => 'Title and content are required']);
        return;
    }

    // Sanitize HTML content
    $content = sanitizeHTML($content);

    // Update slug if title changed
    $currentPost = fetchOne("SELECT title, slug FROM blog_posts WHERE id = ?", [1 => $id]);

    $slug = $currentPost['slug'];
    if ($currentPost['title'] !== $title) {
        $slug = generateSlug($title, $id);
    }

    $db = getDBConnection();
    $stmt = $db->prepare("
        UPDATE blog_posts 
        SET title = ?, slug = ?, content = ?, excerpt = ?, cover_image = ?, status = ?, updated_at = datetime('now')
        WHERE id = ?
    ");

    $stmt->bindValue(1, $title, SQLITE3_TEXT);
    $stmt->bindValue(2, $slug, SQLITE3_TEXT);
    $stmt->bindValue(3, $content, SQLITE3_TEXT);
    $stmt->bindValue(4, $excerpt, SQLITE3_TEXT);
    $stmt->bindValue(5, $coverImage, SQLITE3_TEXT);
    $stmt->bindValue(6, $status, SQLITE3_TEXT);
    $stmt->bindValue(7, $id, SQLITE3_INTEGER);

    $stmt->execute();

    echo json_encode([
        'success' => true,
        'id' => $id,
        'slug' => $slug
    ]);
}

/**
 * DELETE - Delete post
 */
function handleDelete()
{
    $id = $_GET['id'] ?? null;

    if (!$id) {
        http_response_code(400);
        echo json_encode(['error' => 'Post ID is required']);
        return;
    }

    // Get cover image to delete file
    $post = fetchOne("SELECT cover_image FROM blog_posts WHERE id = ?", [1 => $id]);

    if ($post && $post['cover_image']) {
        $imagePath = __DIR__ . '/' . $post['cover_image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    $db = getDBConnection();
    $stmt = $db->prepare("DELETE FROM blog_posts WHERE id = ?");
    $stmt->bindValue(1, $id, SQLITE3_INTEGER);
    $stmt->execute();

    echo json_encode(['success' => true]);
}

/**
 * Generate unique slug from title
 */
function generateSlug($title, $excludeId = null)
{
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));

    // Check if slug exists
    $originalSlug = $slug;
    $counter = 1;

    while (true) {
        if ($excludeId) {
            $existing = fetchOne("SELECT id FROM blog_posts WHERE slug = ? AND id != ?", [1 => $slug, 2 => $excludeId]);
        } else {
            $existing = fetchOne("SELECT id FROM blog_posts WHERE slug = ?", [1 => $slug]);
        }

        if (!$existing) {
            break;
        }

        $slug = $originalSlug . '-' . $counter;
        $counter++;
    }

    return $slug;
}

/**
 * Sanitize HTML content (allow safe tags)
 */
function sanitizeHTML($html)
{
    // Allow common formatting tags
    $allowedTags = '<p><br><strong><b><em><i><u><h1><h2><h3><h4><h5><h6><ul><ol><li><a><img><blockquote><code><pre><table><thead><tbody><tr><th><td><span><div>';

    return strip_tags($html, $allowedTags);
}
