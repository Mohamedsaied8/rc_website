<?php
/**
 * Blog Post Database Operations
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
$db = getDBConnection();

try {
    switch ($method) {
        case 'GET':
            handleGet($db);
            break;
        case 'POST':
            handlePost($db);
            break;
        case 'PUT':
            handlePut($db);
            break;
        case 'DELETE':
            handleDelete($db);
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
function handleGet($db)
{
    $id = $_GET['id'] ?? null;

    if ($id) {
        // Get single post
        $stmt = $db->prepare("SELECT * FROM blog_posts WHERE id = ?");
        $stmt->execute([$id]);
        $post = $stmt->fetch();

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
            $stmt = $db->prepare("SELECT * FROM blog_posts WHERE status = ? ORDER BY created_at DESC");
            $stmt->execute([$status]);
        } else {
            $stmt = $db->query("SELECT * FROM blog_posts ORDER BY created_at DESC");
        }

        $posts = $stmt->fetchAll();
        echo json_encode($posts);
    }
}

/**
 * POST - Create new post
 */
function handlePost($db)
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
    $slug = generateSlug($title, $db);

    // Sanitize HTML content
    $content = sanitizeHTML($content);

    $stmt = $db->prepare("
        INSERT INTO blog_posts (title, slug, content, excerpt, cover_image, status)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([$title, $slug, $content, $excerpt, $coverImage, $status]);

    $postId = $db->lastInsertId();

    echo json_encode([
        'success' => true,
        'id' => $postId,
        'slug' => $slug
    ]);
}

/**
 * PUT - Update existing post
 */
function handlePut($db)
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
    $stmt = $db->prepare("SELECT title, slug FROM blog_posts WHERE id = ?");
    $stmt->execute([$id]);
    $currentPost = $stmt->fetch();

    $slug = $currentPost['slug'];
    if ($currentPost['title'] !== $title) {
        $slug = generateSlug($title, $db, $id);
    }

    $stmt = $db->prepare("
        UPDATE blog_posts 
        SET title = ?, slug = ?, content = ?, excerpt = ?, cover_image = ?, status = ?
        WHERE id = ?
    ");

    $stmt->execute([$title, $slug, $content, $excerpt, $coverImage, $status, $id]);

    echo json_encode([
        'success' => true,
        'id' => $id,
        'slug' => $slug
    ]);
}

/**
 * DELETE - Delete post
 */
function handleDelete($db)
{
    $id = $_GET['id'] ?? null;

    if (!$id) {
        http_response_code(400);
        echo json_encode(['error' => 'Post ID is required']);
        return;
    }

    // Get cover image to delete file
    $stmt = $db->prepare("SELECT cover_image FROM blog_posts WHERE id = ?");
    $stmt->execute([$id]);
    $post = $stmt->fetch();

    if ($post && $post['cover_image']) {
        $imagePath = __DIR__ . '/' . $post['cover_image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    $stmt = $db->prepare("DELETE FROM blog_posts WHERE id = ?");
    $stmt->execute([$id]);

    echo json_encode(['success' => true]);
}

/**
 * Generate unique slug from title
 */
function generateSlug($title, $db, $excludeId = null)
{
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));

    // Check if slug exists
    $originalSlug = $slug;
    $counter = 1;

    while (true) {
        if ($excludeId) {
            $stmt = $db->prepare("SELECT id FROM blog_posts WHERE slug = ? AND id != ?");
            $stmt->execute([$slug, $excludeId]);
        } else {
            $stmt = $db->prepare("SELECT id FROM blog_posts WHERE slug = ?");
            $stmt->execute([$slug]);
        }

        if (!$stmt->fetch()) {
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
