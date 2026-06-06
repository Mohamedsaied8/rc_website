<?php
/**
 * Admin Logout
 */
require_once 'admin_auth.php';
logoutAdmin();
header('Location: admin_login.php');
exit;
