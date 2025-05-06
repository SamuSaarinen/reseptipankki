<?php
// Database connection with enhanced error handling and security

// Check if required constants are defined
if (!defined('DB_HOST') || !defined('DB_NAME') || !defined('DB_USER')) {
    die("Database configuration constants are not properly defined");
}

// Set database connection options
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
];

try {
    // Create PDO connection
    $pdo = new PDO(
        'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        $options
    );
} catch (PDOException $e) {
    // Log detailed error for admin
    error_log("Database connection failed: " . $e->getMessage());
    // Show user-friendly message
    die("Could not connect to the database. Please try again later.");
}

/**
 * Execute a database query with parameters
 * 
 * @param string $sql The SQL query
 * @param array $params Parameters for prepared statement
 * @return PDOStatement|false Returns the statement object or false on failure
 */
function query($sql, $params = []) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare($sql);
        
        // Bind parameters if they exist
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $stmt->bindValue(
                    is_int($key) ? $key + 1 : $key,
                    $value,
                    is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR
                );
            }
        }
        
        $stmt->execute();
        return $stmt;
    } catch (PDOException $e) {
        // Log the error with context
        error_log("Query failed: " . $e->getMessage() . " [SQL: $sql]");
        return false;
    }
}