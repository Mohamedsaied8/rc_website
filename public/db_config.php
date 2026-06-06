<?php
/**
 * Database Configuration - SQLite3 Version
 * Uses SQLite3 extension instead of PDO
 */

// Database path
define('DB_PATH', __DIR__ . '/../database/database.sqlite');

/**
 * Get database connection using SQLite3
 */
function getDBConnection()
{
    static $conn = null;

    if ($conn === null) {
        try {
            if (!file_exists(DB_PATH)) {
                throw new Exception("Database file not found: " . DB_PATH);
            }

            $conn = new SQLite3(DB_PATH);
            $conn->busyTimeout(5000);
            // Enable exceptions
            $conn->enableExceptions(true);
        } catch (Exception $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    return $conn;
}

/**
 * Escape string for SQLite
 */
function escapeString($str)
{
    $db = getDBConnection();
    return $db->escapeString($str);
}

/**
 * Fetch all results from query
 */
function fetchAll($query, $params = [])
{
    $db = getDBConnection();

    if (empty($params)) {
        $result = $db->query($query);
    } else {
        $stmt = $db->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $result = $stmt->execute();
    }

    $rows = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $rows[] = $row;
    }

    return $rows;
}

/**
 * Fetch single result from query
 */
function fetchOne($query, $params = [])
{
    $db = getDBConnection();

    if (empty($params)) {
        $result = $db->query($query);
    } else {
        $stmt = $db->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $result = $stmt->execute();
    }

    return $result->fetchArray(SQLITE3_ASSOC);
}
