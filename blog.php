<?php
/**
 * Public Blog Listing Page
 */

require_once 'db_config.php';
require_once __DIR__ . '/includes/gtm.php';

$db = getDBConnection();

// Get only published posts
$stmt = $db->query("SELECT * FROM blog_posts WHERE status = 'published' ORDER BY created_at DESC");
$posts = $stmt->fetchAll();
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem 0;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
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

        .admin-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border: 2px solid #667eea;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .admin-link a:hover {
            background: #667eea;
            color: white;
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            color: #667eea;
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
        <div class="container">
            <h1>🤖 Robotics Corner Blog</h1>
            <p>Insights, tutorials, and news from the world of robotics</p>
        </div>
    </div>

    <div class="container">
        <div class="admin-link">
            <a href="blog_admin.php">🔐 Admin Dashboard</a>
        </div>

        <?php if (empty($posts)): ?>
            <div class="empty-state">
                <h2>No posts yet</h2>
                <p>Check back soon for exciting content!</p>
            </div>
        <?php else: ?>
            <div class="blog-grid">
                <?php foreach ($posts as $post): ?>
                    <a href="blog_post.php?slug=<?php echo urlencode($post['slug']); ?>" class="blog-card">
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