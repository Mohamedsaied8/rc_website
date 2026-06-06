<?php
/**
 * Edit Blog Post
 */

require_once 'admin_auth.php';
require_once __DIR__ . '/includes/gtm.php';
requireAdmin();

$postId = $_GET['id'] ?? null;

if (!$postId) {
    header('Location: blog_admin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php gtm_head(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post - Blog Admin</title>
    <link rel="stylesheet" href="css/blog-admin.css">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body>
    <?php gtm_body(); ?>
    <div class="admin-container">
        <header class="admin-header">
            <div class="header-content">
                <h1>Edit Post</h1>
                <div class="header-actions">
                    <a href="blog_admin.php" class="btn btn-secondary">← Back to Dashboard</a>
                </div>
            </div>
        </header>

        <main class="admin-main">
            <div id="loadingState" class="loading">Loading post...</div>

            <form id="postForm" class="post-form" style="display: none;">
                <input type="hidden" id="postId" value="<?php echo htmlspecialchars($postId); ?>">

                <!-- Title -->
                <div class="form-group">
                    <label for="title">Title *</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <!-- Cover Image -->
                <div class="form-group">
                    <label for="coverImage">Cover Image</label>
                    <div class="image-upload-container">
                        <input type="file" id="coverImage" accept="image/*" style="display: none;">
                        <button type="button" class="btn btn-secondary"
                            onclick="document.getElementById('coverImage').click()">
                            📷 Change Cover Image
                        </button>
                        <button type="button" id="removeCoverBtn" class="btn btn-danger" style="display: none;">
                            Remove Cover
                        </button>
                        <span id="coverImageName" class="file-name"></span>
                        <div id="coverPreview" class="image-preview"></div>
                    </div>
                    <input type="hidden" id="coverImageUrl" name="cover_image">
                </div>

                <!-- Excerpt -->
                <div class="form-group">
                    <label for="excerpt">Excerpt (Optional)</label>
                    <textarea id="excerpt" name="excerpt" rows="3"></textarea>
                </div>

                <!-- Content Editor -->
                <div class="form-group">
                    <label for="content">Content *</label>
                    <textarea id="content" name="content"></textarea>
                </div>

                <!-- Status -->
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>
                </div>

                <!-- Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-lg">Update Post</button>
                    <a href="blog_admin.php" class="btn btn-secondary btn-lg">Cancel</a>
                </div>

                <div id="formMessage" class="form-message"></div>
            </form>
        </main>
    </div>

    <script src="js/blog-editor.js"></script>
    <script>
        initEditor('edit', <?php echo $postId; ?>);
    </script>
</body>

</html>