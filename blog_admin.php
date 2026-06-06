<?php
/**
 * Blog Admin Dashboard
 * Manage all blog posts
 */

require_once 'admin_auth.php';
require_once __DIR__ . '/includes/gtm.php';
requireAdmin();

$adminUsername = getAdminUsername();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php gtm_head(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Admin - Robotics Corner</title>
    <link rel="stylesheet" href="css/blog-admin.css">
</head>

<body>
    <?php gtm_body(); ?>
    <div class="admin-container">
        <!-- Header -->
        <header class="admin-header">
            <div class="header-content">
                <h1>🤖 Blog Admin</h1>
                <div class="header-actions">
                    <span class="admin-user">👤 <?php echo htmlspecialchars($adminUsername); ?></span>
                    <a href="blog.php" class="btn btn-secondary" target="_blank">View Blog</a>
                    <a href="?logout=1" class="btn btn-secondary">Logout</a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="admin-main">
            <div class="content-header">
                <h2>All Posts</h2>
                <a href="blog_create.php" class="btn btn-primary">+ New Post</a>
            </div>

            <!-- Filter Tabs -->
            <div class="filter-tabs">
                <button class="tab-btn active" data-status="all">All Posts</button>
                <button class="tab-btn" data-status="published">Published</button>
                <button class="tab-btn" data-status="draft">Drafts</button>
            </div>

            <!-- Posts List -->
            <div class="posts-list" id="postsList">
                <div class="loading">Loading posts...</div>
            </div>
        </main>
    </div>

    <script>
        // Handle logout
        if (window.location.search.includes('logout=1')) {
            fetch('admin_logout.php')
                .then(() => window.location.href = 'admin_login.php');
        }

        let currentFilter = 'all';

        // Load posts
        async function loadPosts(status = 'all') {
            currentFilter = status;
            const postsList = document.getElementById('postsList');
            postsList.innerHTML = '<div class="loading">Loading posts...</div>';

            try {
                const url = status === 'all'
                    ? 'database_post.php'
                    : `database_post.php?status=${status}`;

                const response = await fetch(url);
                const posts = await response.json();

                if (posts.length === 0) {
                    postsList.innerHTML = '<div class="empty-state">No posts found. Create your first post!</div>';
                    return;
                }

                postsList.innerHTML = posts.map(post => `
                    <div class="post-card">
                        ${post.cover_image ? `
                            <div class="post-cover">
                                <img src="${post.cover_image}" alt="${escapeHtml(post.title)}">
                            </div>
                        ` : ''}
                        <div class="post-content">
                            <div class="post-header">
                                <h3>${escapeHtml(post.title)}</h3>
                                <span class="post-status status-${post.status}">${post.status}</span>
                            </div>
                            <p class="post-excerpt">${escapeHtml(post.excerpt || truncate(stripHtml(post.content), 150))}</p>
                            <div class="post-meta">
                                <span>📅 ${formatDate(post.created_at)}</span>
                                <span>🔗 ${post.slug}</span>
                            </div>
                            <div class="post-actions">
                                <a href="blog_edit.php?id=${post.id}" class="btn btn-sm btn-primary">Edit</a>
                                <button onclick="deletePost(${post.id}, '${escapeHtml(post.title)}')" class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                `).join('');
            } catch (error) {
                postsList.innerHTML = '<div class="error-state">Error loading posts. Please try again.</div>';
                console.error('Error loading posts:', error);
            }
        }

        // Delete post
        async function deletePost(id, title) {
            if (!confirm(`Are you sure you want to delete "${title}"?`)) {
                return;
            }

            try {
                const response = await fetch(`database_post.php?id=${id}`, {
                    method: 'DELETE'
                });

                const result = await response.json();

                if (result.success) {
                    loadPosts(currentFilter);
                } else {
                    alert('Error deleting post: ' + result.error);
                }
            } catch (error) {
                alert('Error deleting post. Please try again.');
                console.error('Error:', error);
            }
        }

        // Filter tabs
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                loadPosts(btn.dataset.status);
            });
        });

        // Utility functions
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function stripHtml(html) {
            const div = document.createElement('div');
            div.innerHTML = html;
            return div.textContent || div.innerText || '';
        }

        function truncate(text, length) {
            return text.length > length ? text.substring(0, length) + '...' : text;
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
        }

        // Load posts on page load
        loadPosts();
    </script>
</body>

</html>