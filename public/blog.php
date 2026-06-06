<?php
/**
 * Public Blog Listing Page - SQLite3 Version
 */

require_once 'db_config.php';
require_once __DIR__ . '/../includes/gtm.php';

// Get only published posts
$posts = fetchAll("SELECT * FROM blog_posts WHERE status = 'published' ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php gtm_head(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Robotics Corner</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .login-link {
            color: #2dd4bf;
            text-decoration: none;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border: 2px solid #2dd4bf;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .login-link:hover {
            background: #2dd4bf;
            color: white;
        }

        .blog-hero {
            background: linear-gradient(135deg, #f0fdfa 0%, #ccfbf1 100%);
            color: #1e293b;
            padding: 4rem 0 3rem;
            text-align: center;
        }

        .blog-hero h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            font-weight: 800;
        }

        .blog-hero p {
            font-size: 1.1rem;
            opacity: 0.8;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .admin-link {
            text-align: center;
            margin: 2rem 0;
        }



        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .blog-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .blog-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .blog-card-image {
            width: 100%;
            height: 220px;
            background: linear-gradient(135deg, #2dd4bf 0%, #0891b2 100%);
            overflow: hidden;
        }

        .blog-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .blog-card-content {
            padding: 1.5rem;
        }

        .blog-card-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            color: #333;
        }

        .blog-card-excerpt {
            color: #666;
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .blog-card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.875rem;
            color: #888;
        }

        .read-more {
            color: #2dd4bf;
            font-weight: 600;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #888;
        }

        .empty-state h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .blog-grid {
                grid-template-columns: 1fr;
            }

            .header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <?php gtm_body(); ?>
    <div class="header">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
            <a href="/" style="display: flex; align-items: center; text-decoration: none;">
                <img src="/images/logo.png" alt="Robotics Corner" style="height: 40px; margin-right: 10px;">
            </a>
            <a href="blog_admin" class="login-link">Login</a>
        </div>
    </div>

    <div class="blog-hero">
        <div class="container">
            <h1>🤖 Robotics Corner Blog</h1>
            <p>Insights, tutorials, and news from the world of robotics</p>
        </div>
    </div>

    <div class="container">
        <?php if (empty($posts)): ?>
            <div class="empty-state">
                <h2>No posts yet</h2>
                <p>Check back soon for exciting content!</p>
            </div>
        <?php else: ?>
            <div class="blog-grid">
                <?php foreach ($posts as $post): ?>
                    <a href="blog_post?slug=<?php echo urlencode($post['slug']); ?>" class="blog-card">
                        <div class="blog-card-image">
                            <?php if ($post['cover_image']): ?>
                                <img src="<?php echo htmlspecialchars($post['cover_image']); ?>"
                                    alt="<?php echo htmlspecialchars($post['title']); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="blog-card-content">
                            <h2 class="blog-card-title"><?php echo htmlspecialchars($post['title']); ?></h2>
                            <p class="blog-card-excerpt">
                                <?php
                                $excerpt = $post['excerpt'] ?: strip_tags($post['content']);
                                echo htmlspecialchars(substr($excerpt, 0, 150)) . (strlen($excerpt) > 150 ? '...' : '');
                                ?>
                            </p>
                            <div class="blog-card-meta">
                                <span><?php echo date('M d, Y', strtotime($post['created_at'])); ?></span>
                                <span class="read-more">Read more →</span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>