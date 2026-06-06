-- Blog Posts Table Schema
-- Run this SQL on your database to create/update the blog_posts table

CREATE TABLE IF NOT EXISTS blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    content LONGTEXT NOT NULL,
    excerpt TEXT,
    cover_image VARCHAR(255) DEFAULT NULL,
    author_id INT,
    status ENUM('draft', 'published') DEFAULT 'draft',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (slug),
    INDEX idx_status (status),
    INDEX idx_created_at (created_at)
);

-- If table already exists, add cover_image column:
-- ALTER TABLE blog_posts ADD COLUMN cover_image VARCHAR(255) DEFAULT NULL AFTER content;
-- ALTER TABLE blog_posts ADD COLUMN excerpt TEXT AFTER content;
