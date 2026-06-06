# SLAM Tutorial Post - Manual Setup Instructions

## ✅ Cover Image Ready
The cover image has been uploaded to:
`uploads/blog/covers/slam-tutorial-cover.png`

## 📝 Create the Post

Since the database isn't set up yet, you have two options:

### Option 1: Use the Admin Interface (Recommended)

1. First, set up the database table by running this SQL:

```sql
CREATE TABLE IF NOT EXISTS blog_posts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    content TEXT NOT NULL,
    excerpt TEXT,
    cover_image VARCHAR(255) DEFAULT NULL,
    author_id INTEGER,
    status VARCHAR(20) DEFAULT 'draft',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

2. Visit: `https://roboticscorner.tech/admin_login.php`
   - Username: `admin`
   - Password: `roboticscorner25`

3. Click "New Post" and fill in:
   - **Title**: `SLAM Tutorial: Simultaneous Localization and Mapping for Robotics`
   - **Cover Image**: Upload `uploads/blog/covers/slam-tutorial-cover.png` (or it's already there!)
   - **Excerpt**: `Learn about SLAM (Simultaneous Localization and Mapping) - what it is, why it's crucial for robotics, the most common algorithms, and how to implement it in ROS2 with practical examples.`
   - **Content**: Copy from `slam_post_content.html` (created below)
   - **Status**: Published

### Option 2: Direct SQL Insert

Run the SQL file: `insert_slam_post.sql`

## 📄 Post Content

The full HTML content is ready in `slam_post_content.html`

## 🎯 What's Covered

The SLAM tutorial includes:
- ✅ What is SLAM and why it matters
- ✅ Real-world applications (autonomous vehicles, drones, AR, etc.)
- ✅ 6 major SLAM algorithms (EKF-SLAM, FastSLAM, Graph-SLAM, ORB-SLAM, Cartographer, GMapping)
- ✅ Complete ROS2 implementation guide
- ✅ SLAM Toolbox setup and usage
- ✅ Code examples and best practices
- ✅ Visualization with RViz2
- ✅ Map saving and loading

## 🖼️ Cover Image

The cover image shows a robot with SLAM visualization including:
- Kalman Filter
- Loop Closure
- LiDAR scanning
- Real-time mapping

Perfect for the tutorial!
