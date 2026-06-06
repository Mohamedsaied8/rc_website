<?php
/**
 * Setup Script - Create Database Table and Insert SLAM Post
 * Run this once to set up the blog system
 */

require_once 'db_config.php';

try {
    $db = getDBConnection();

    echo "Creating blog_posts table...\n";

    // Create table
    $db->exec("
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
        )
    ");

    echo "Table created successfully!\n";

    // Check if SLAM post already exists
    $stmt = $db->prepare("SELECT id FROM blog_posts WHERE slug = ?");
    $stmt->execute(['slam-tutorial-simultaneous-localization-and-mapping']);

    if ($stmt->fetch()) {
        echo "SLAM tutorial post already exists!\n";
        exit(0);
    }

    echo "Inserting SLAM tutorial post...\n";

    // Insert SLAM post
    $stmt = $db->prepare("
        INSERT INTO blog_posts (title, slug, content, excerpt, cover_image, status, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, datetime('now'), datetime('now'))
    ");

    $title = 'SLAM Tutorial: Simultaneous Localization and Mapping for Robotics';
    $slug = 'slam-tutorial-simultaneous-localization-and-mapping';
    $excerpt = 'Learn about SLAM (Simultaneous Localization and Mapping) - what it is, why it\'s crucial for robotics, the most common algorithms, and how to implement it in ROS2 with practical examples.';
    $coverImage = 'uploads/blog/covers/slam-tutorial-cover.png';
    $status = 'published';

    $content = '<h2>What is SLAM?</h2>
<p>SLAM (Simultaneous Localization and Mapping) is a fundamental problem in robotics that involves building a map of an unknown environment while simultaneously keeping track of the robot\'s location within that map. Think of it as trying to create a floor plan of a building you\'ve never been in before, while also figuring out where you are in that building - all at the same time!</p>

<p>The challenge lies in the circular dependency: to localize yourself, you need a map, but to build a map, you need to know where you are. SLAM algorithms solve this chicken-and-egg problem through probabilistic methods and sensor fusion.</p>

<h2>Why is SLAM Useful?</h2>

<p>SLAM is crucial for autonomous systems and has numerous real-world applications:</p>

<ul>
    <li><strong>Autonomous Vehicles</strong> - Self-driving cars use SLAM to navigate streets, avoid obstacles, and understand their environment in real-time.</li>
    <li><strong>Warehouse Robots</strong> - Automated guided vehicles (AGVs) use SLAM to navigate warehouses efficiently without pre-installed infrastructure.</li>
    <li><strong>Drones and UAVs</strong> - Aerial robots use SLAM for indoor navigation where GPS is unavailable.</li>
    <li><strong>Augmented Reality</strong> - AR applications use SLAM to understand the 3D structure of the environment and place virtual objects accurately.</li>
    <li><strong>Vacuum Cleaners</strong> - Robot vacuums like Roomba use SLAM to efficiently clean your home without missing spots.</li>
    <li><strong>Search and Rescue</strong> - Robots can map disaster zones and locate survivors in environments too dangerous for humans.</li>
</ul>

<h2>Most Common SLAM Algorithms</h2>

<h3>1. EKF-SLAM (Extended Kalman Filter SLAM)</h3>
<p>One of the earliest SLAM solutions, EKF-SLAM uses the Extended Kalman Filter to estimate the robot\'s pose and landmark positions. While computationally efficient for small environments, it struggles with large-scale mapping due to quadratic complexity.</p>

<p><strong>Pros:</strong> Simple to implement, well-understood mathematically<br>
<strong>Cons:</strong> Doesn\'t scale well, assumes Gaussian noise</p>

<h3>2. FastSLAM</h3>
<p>FastSLAM uses particle filters to represent the robot\'s pose distribution and maintains separate EKFs for each landmark. This approach scales better than EKF-SLAM and can handle non-linear motion models.</p>

<p><strong>Pros:</strong> Better scalability, handles non-Gaussian distributions<br>
<strong>Cons:</strong> Particle depletion issues, computationally intensive</p>

<h3>3. Graph-SLAM</h3>
<p>Graph-SLAM formulates the SLAM problem as a graph optimization problem. Nodes represent robot poses and landmarks, while edges represent spatial constraints from sensor measurements. This approach is highly accurate and scalable.</p>

<p><strong>Pros:</strong> Excellent accuracy, handles loop closures well<br>
<strong>Cons:</strong> Requires batch processing, memory intensive</p>

<h3>4. ORB-SLAM</h3>
<p>ORB-SLAM is a visual SLAM system that uses ORB (Oriented FAST and Rotated BRIEF) features for tracking, mapping, and loop closing. It works with monocular, stereo, and RGB-D cameras and is one of the most accurate visual SLAM systems available.</p>

<p><strong>Pros:</strong> Real-time performance, highly accurate, open-source<br>
<strong>Cons:</strong> Requires good visual features, struggles in textureless environments</p>

<h3>5. Cartographer</h3>
<p>Developed by Google, Cartographer provides real-time SLAM in 2D and 3D using LiDAR, IMU, and odometry data. It uses loop closure detection and pose graph optimization for accurate mapping.</p>

<p><strong>Pros:</strong> Excellent for LiDAR-based systems, real-time performance<br>
<strong>Cons:</strong> Complex configuration, resource-intensive</p>

<h3>6. GMapping</h3>
<p>GMapping uses a Rao-Blackwellized particle filter for grid-based SLAM. It\'s particularly popular in the ROS community for 2D laser-based mapping.</p>

<p><strong>Pros:</strong> Fast, works well with 2D LiDAR<br>
<strong>Cons:</strong> Limited to 2D environments</p>

<h2>SLAM in ROS2</h2>

<p>ROS2 (Robot Operating System 2) provides excellent support for SLAM through various packages and tools. Here\'s how to implement SLAM in ROS2:</p>

<h3>Popular ROS2 SLAM Packages</h3>

<h4>1. SLAM Toolbox</h4>
<p>SLAM Toolbox is the recommended 2D SLAM solution for ROS2. It provides synchronous and asynchronous SLAM, localization mode, and lifelong mapping capabilities.</p>

<pre><code># Install SLAM Toolbox
sudo apt install ros-humble-slam-toolbox

# Launch SLAM Toolbox
ros2 launch slam_toolbox online_async_launch.py</code></pre>

<p><strong>Key Features:</strong></p>
<ul>
    <li>Asynchronous and synchronous SLAM modes</li>
    <li>Lifelong mapping and localization</li>
    <li>Loop closure detection</li>
    <li>Map serialization and deserialization</li>
</ul>

<h4>2. Cartographer (ROS2 Port)</h4>
<p>Google\'s Cartographer has been ported to ROS2 and provides both 2D and 3D SLAM capabilities.</p>

<pre><code># Install Cartographer
sudo apt install ros-humble-cartographer ros-humble-cartographer-ros

# Launch Cartographer
ros2 launch cartographer_ros cartographer.launch.py</code></pre>

<h4>3. ORB-SLAM3 (ROS2 Wrapper)</h4>
<p>For visual SLAM, ORB-SLAM3 can be integrated with ROS2 through community-maintained wrappers.</p>

<h3>Basic ROS2 SLAM Implementation</h3>

<p>Here\'s a simple example of setting up SLAM Toolbox with ROS2:</p>

<pre><code># 1. Create a ROS2 workspace
mkdir -p ~/ros2_ws/src
cd ~/ros2_ws/src

# 2. Install dependencies
sudo apt install ros-humble-slam-toolbox ros-humble-nav2-*

# 3. Create a launch file (slam_launch.py)
from launch import LaunchDescription
from launch_ros.actions import Node

def generate_launch_description():
    return LaunchDescription([
        Node(
            package=\'slam_toolbox\',
            executable=\'async_slam_toolbox_node\',
            name=\'slam_toolbox\',
            output=\'screen\',
            parameters=[
                {\'use_sim_time\': False},
                {\'odom_frame\': \'odom\'},
                {\'map_frame\': \'map\'},
                {\'base_frame\': \'base_link\'},
                {\'scan_topic\': \'/scan\'}
            ]
        )
    ])

# 4. Build and run
cd ~/ros2_ws
colcon build
source install/setup.bash
ros2 launch your_package slam_launch.py</code></pre>

<h3>Visualizing SLAM in RViz2</h3>

<pre><code># Launch RViz2 to visualize the map
ros2 run rviz2 rviz2

# Add displays:
# - Map (topic: /map)
# - LaserScan (topic: /scan)
# - TF
# - RobotModel</code></pre>

<h3>Saving and Loading Maps</h3>

<pre><code># Save the map
ros2 run nav2_map_server map_saver_cli -f my_map

# Load a saved map for localization
ros2 run nav2_map_server map_server --ros-args -p yaml_filename:=my_map.yaml</code></pre>

<h2>Best Practices for SLAM</h2>

<ol>
    <li><strong>Sensor Selection</strong> - Choose sensors appropriate for your environment (LiDAR for structured environments, cameras for feature-rich areas)</li>
    <li><strong>Calibration</strong> - Properly calibrate all sensors and ensure accurate TF transforms</li>
    <li><strong>Loop Closure</strong> - Enable loop closure detection to reduce drift in long-term mapping</li>
    <li><strong>Odometry</strong> - Use wheel odometry or visual odometry to improve pose estimation</li>
    <li><strong>Environment</strong> - SLAM works best in static environments with good features</li>
    <li><strong>Computational Resources</strong> - Ensure your hardware can handle real-time processing</li>
</ol>

<h2>Conclusion</h2>

<p>SLAM is a cornerstone technology in modern robotics, enabling autonomous navigation in unknown environments. With ROS2\'s robust ecosystem and packages like SLAM Toolbox and Cartographer, implementing SLAM has become more accessible than ever. Whether you\'re building an autonomous robot, developing AR applications, or exploring robotics research, understanding SLAM is essential.</p>

<p>Start experimenting with the ROS2 examples above, and you\'ll be building maps and navigating autonomously in no time!</p>';

    $stmt->execute([$title, $slug, $content, $excerpt, $coverImage, $status]);

    echo "✅ SLAM tutorial post created successfully!\n";
    echo "Post ID: " . $db->lastInsertId() . "\n";
    echo "Slug: " . $slug . "\n";
    echo "\nYou can view it at:\n";
    echo "https://roboticscorner.tech/blog_post.php?slug=" . $slug . "\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
