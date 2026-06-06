<?php
/**
 * Admin Authentication Helper
 * Simple session-based authentication for blog admin
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Admin credentials (CHANGE THESE!)
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'roboticscorner25'); // Use password_hash() in production

/**
 * Check if user is logged in as admin
 */
function isAdminLoggedIn()
{
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

/**
 * Require admin login - redirect if not logged in
 */
function requireAdmin()
{
    if (!isAdminLoggedIn()) {
        header('Location: admin_login.php');
        exit;
    }
}

/**
 * Authenticate admin user
 */
function authenticateAdmin($username, $password)
{
    // In production, use password_hash() and password_verify()
    if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        return true;
    }
    return false;
}

/**
 * Logout admin user
 */
function logoutAdmin()
{
    $_SESSION['admin_logged_in'] = false;
    unset($_SESSION['admin_username']);
    session_destroy();
}

/**
 * Get admin username
 */
function getAdminUsername()
{
    return $_SESSION['admin_username'] ?? 'Admin';
}
