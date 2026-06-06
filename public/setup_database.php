<?php
/**
 * Web-accessible Database Setup
 * Visit this page in your browser to set up the blog database
 */

// Prevent running multiple times
$lockFile = __DIR__ . '/setup.lock';
if (file_exists($lockFile)) {
    die('Setup already completed! Delete setup.lock file to run again.');
}

echo "<h1>Blog Database Setup</h1>";
echo "<pre>";

try {
    // Use Laravel's database connection
    $dbPath = __DIR__ . '/../database/database.sqlite';

    // Check if database file exists
    if (!file_exists($dbPath)) {
        // Create database file
        touch($dbPath);
        chmod($dbPath, 0664);
        echo "✓ Created database file: $dbPath\n";
    }

    // Connect using SQLite3 (doesn't require PDO)
    $db = new SQLite3($dbPath);

    echo "✓ Connected to database\n\n";

    // Create table
    echo "Creating blog_posts table...\n";
    $db->exec("
        CREATE TABLE IF NOT EXISTS blog_posts (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT NOT NULL,
            slug TEXT UNIQUE NOT NULL,
            content TEXT NOT NULL,
            excerpt TEXT,
            cover_image TEXT DEFAULT NULL,
            author_id INTEGER,
            status TEXT DEFAULT 'draft',
            created_at TEXT DEFAULT CURRENT_TIMESTAMP,
            updated_at TEXT DEFAULT CURRENT_TIMESTAMP
        )
    ");
    echo "✓ Table created successfully\n\n";

    // Check if SLAM post exists
    $result = $db->query("SELECT id FROM blog_posts WHERE slug = 'slam-tutorial-simultaneous-localization-and-mapping'");
    if ($result->fetchArray()) {
        echo "⚠ SLAM tutorial post already exists\n";
    } else {
        echo "Inserting SLAM tutorial post...\n";

        $title = 'SLAM Tutorial: Simultaneous Localization and Mapping for Robotics';
        $slug = 'slam-tutorial-simultaneous-localization-and-mapping';
        $excerpt = 'Learn about SLAM (Simultaneous Localization and Mapping) - what it\'s crucial for robotics, the most common algorithms, and how to implement it in ROS2 with practical examples.';
        $coverImage = 'uploads/blog/covers/slam-tutorial-cover.png';
        $status = 'published';

        $content = file_get_contents(__DIR__ . '/slam_content.txt');

        $stmt = $db->prepare("
            INSERT INTO blog_posts (title, slug, content, excerpt, cover_image, status, created_at, updated_at)
            VALUES (:title, :slug, :content, :excerpt, :cover_image, :status, datetime('now'), datetime('now'))
        ");

        $stmt->bindValue(':title', $title, SQLITE3_TEXT);
        $stmt->bindValue(':slug', $slug, SQLITE3_TEXT);
        $stmt->bindValue(':content', $content, SQLITE3_TEXT);
        $stmt->bindValue(':excerpt', $excerpt, SQLITE3_TEXT);
        $stmt->bindValue(':cover_image', $coverImage, SQLITE3_TEXT);
        $stmt->bindValue(':status', $status, SQLITE3_TEXT);

        $stmt->execute();

        echo "✓ SLAM tutorial post created successfully!\n";
        echo "  Post ID: " . $db->lastInsertRowID() . "\n";
        echo "  Slug: $slug\n\n";
    }

    $db->close();

    // Create lock file
    file_put_contents($lockFile, date('Y-m-d H:i:s'));

    echo "\n✅ Setup completed successfully!\n\n";
    echo "View your blog at: <a href='blog.php'>blog.php</a>\n";
    echo "View SLAM post at: <a href='blog_post.php?slug=slam-tutorial-simultaneous-localization-and-mapping'>SLAM Tutorial</a>\n";
    echo "Admin dashboard: <a href='blog_admin.php'>blog_admin.php</a>\n";

} catch (Exception $e) {
    echo "\n❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString();
}

echo "</pre>";
?>