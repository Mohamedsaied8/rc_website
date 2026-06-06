-- SQLite Blog Posts Table Schema
-- Run this on your SQLite database

CREATE TABLE IF NOT EXISTS blog_posts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    content TEXT NOT NULL,
    excerpt TEXT,
    cover_image VARCHAR(255) DEFAULT NULL,
    author_id INTEGER,
    status VARCHAR(20) DEFAULT 'draft' CHECK(status IN ('draft', 'published')),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX IF NOT EXISTS idx_slug ON blog_posts(slug);
CREATE INDEX IF NOT EXISTS idx_status ON blog_posts(status);
CREATE INDEX IF NOT EXISTS idx_created_at ON blog_posts(created_at);
