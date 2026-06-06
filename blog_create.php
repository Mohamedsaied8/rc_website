<?php
/**
 * Create New Blog Post
 */

require_once 'admin_auth.php';
require_once __DIR__ . '/includes/gtm.php';
requireAdmin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php gtm_head(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post - Blog Admin</title>
    <link rel="stylesheet" href="css/blog-admin.css">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body>
    <?php gtm_body(); ?>
    <div class="admin-container">
        <header class="admin-header">
            <div class="header-content">
                <h1>Create New Post</h1>
                <div class="header-actions">
                    <a href="blog_admin.php" class="btn btn-secondary">← Back to Dashboard</a>
                </div>
            </div>
        </header>

        <main class="admin-main">
            <form id="postForm" class="post-form">
                <!-- Title -->
                <div class="form-group">
                    <label for="title">Title *</label>
                    <input type="text" id="title" name="title" required placeholder="Enter post title...">
                </div>

                <!-- Cover Image -->
                <div class="form-group">
                    <label for="coverImage">Cover Image</label>
                    <div class="image-upload-container">
                        <input type="file" id="coverImage" accept="image/*" style="display: none;">
                        <button type="button" class="btn btn-secondary"
                            onclick="document.getElementById('coverImage').click()">
                            📷 Choose Cover Image
                        </button>
                        <span id="coverImageName" class="file-name"></span>
                        <div id="coverPreview" class="image-preview"></div>
                    </div>
                    <input type="hidden" id="coverImageUrl" name="cover_image">
                </div>

                <!-- Excerpt -->
                <div class="form-group">
                    <label for="excerpt">Excerpt (Optional)</label>
                    <textarea id="excerpt" name="excerpt" rows="3"
                        placeholder="Brief summary of the post..."></textarea>
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
                    <button type="submit" class="btn btn-primary btn-lg">Create Post</button>
                    <a href="blog_admin.php" class="btn btn-secondary btn-lg">Cancel</a>
                </div>

                <div id="formMessage" class="form-message"></div>
            </form>
        </main>
    </div>

    <script src="js/blog-editor.js"></script>
    <script>
        initEditor('create');
    </script>
</body>

</html>