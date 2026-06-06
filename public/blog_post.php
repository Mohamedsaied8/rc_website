<?php
/**
 * Individual Blog Post Page - SQLite3 Version
 */

require_once 'db_config.php';
require_once __DIR__ . '/../includes/gtm.php';

$slug = $_GET['slug'] ?? '';

if (empty($slug)) {
    header('Location: blog.php');
    exit;
}

// Get post by slug (only published posts for public)
$post = fetchOne("SELECT * FROM blog_posts WHERE slug = ? AND status = 'published'", [1 => $slug]);

if (!$post) {
    header('Location: blog.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php gtm_head(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?> - Robotics Corner</title>
    <meta name="description"
        content="<?php echo htmlspecialchars($post['excerpt'] ?: substr(strip_tags($post['content']), 0, 160)); ?>">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #fff;
            color: #333;
            line-height: 1.8;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header-content {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .back-link {
            display: inline-block;
            color: #2dd4bf;
            text-decoration: none;
            margin-bottom: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .article {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .article-header {
            padding: 3rem 0 2rem;
            text-align: center;
        }

        .article-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: #1a1a1a;
            line-height: 1.2;
        }

        .article-meta {
            color: #666;
            font-size: 1rem;
        }

        .article-cover {
            width: 100%;
            max-height: 500px;
            overflow: hidden;
            border-radius: 12px;
            margin-bottom: 3rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        .article-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .article-content {
            font-size: 1.125rem;
            line-height: 1.8;
            color: #333;
            margin-bottom: 4rem;
        }

        .article-content h1,
        .article-content h2,
        .article-content h3,
        .article-content h4,
        .article-content h5,
        .article-content h6 {
            margin: 2rem 0 1rem;
            font-weight: 700;
            color: #1a1a1a;
            line-height: 1.3;
        }

        .article-content h2 {
            font-size: 2rem;
        }

        .article-content h3 {
            font-size: 1.5rem;
        }

        .article-content p {
            margin-bottom: 1.5rem;
        }

        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 2rem 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .article-content a {
            color: #2dd4bf;
            text-decoration: none;
            border-bottom: 2px solid #2dd4bf;
            transition: opacity 0.3s ease;
        }

        .article-content a:hover {
            opacity: 0.7;
        }

        .article-content ul,
        .article-content ol {
            margin: 1.5rem 0;
            padding-left: 2rem;
        }

        .article-content li {
            margin-bottom: 0.5rem;
        }

        .article-content blockquote {
            border-left: 4px solid #2dd4bf;
            padding-left: 1.5rem;
            margin: 2rem 0;
            font-style: italic;
            color: #666;
        }

        .article-content code {
            background: #f5f5f5;
            padding: 0.2rem 0.4rem;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            font-size: 0.9em;
        }

        .article-content pre {
            background: #1a1a1a;
            color: #f5f5f5;
            padding: 1.5rem;
            border-radius: 8px;
            overflow-x: auto;
            margin: 2rem 0;
        }

        .article-content pre code {
            background: none;
            padding: 0;
            color: inherit;
        }

        .article-footer {
            border-top: 2px solid #e0e0e0;
            padding: 2rem 0;
            text-align: center;
        }

        .back-to-blog {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, #2dd4bf 0%, #0891b2 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .back-to-blog:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(45, 212, 191, 0.3);
        }

        @media (max-width: 768px) {
            .article-title {
                font-size: 2rem;
            }

            .article-content {
                font-size: 1rem;
            }

            .article-content h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <?php gtm_body(); ?>
    <div class="header">
        <div class="header-content">
            <a href="blog" class="back-link">← Back to Blog</a>
        </div>
    </div>

    <article class="article">
        <header class="article-header">
            <h1 class="article-title"><?php echo htmlspecialchars($post['title']); ?></h1>
            <div class="article-meta">
                📅 <?php echo date('F d, Y', strtotime($post['created_at'])); ?>
            </div>
        </header>

        <?php if ($post['cover_image']): ?>
            <div class="article-cover">
                <img src="<?php echo htmlspecialchars($post['cover_image']); ?>"
                    alt="<?php echo htmlspecialchars($post['title']); ?>">
            </div>
        <?php endif; ?>

        <div class="article-content">
            <?php echo $post['content']; ?>
        </div>

        <footer class="article-footer">
            <a href="blog" class="back-to-blog">← Back to All Posts</a>
        </footer>
    </article>
</body>

</html>