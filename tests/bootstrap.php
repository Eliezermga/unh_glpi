<?php
/**
 * PHPUnit bootstrap file for GLPI tests
 */

// Define test environment
define('GLPI_ROOT', dirname(__DIR__));
define('TU_USER', '_test_user');
define('TU_PASS', 'glpi');

// Include GLPI configuration
if (file_exists(GLPI_ROOT . '/inc/includes.php')) {
    include_once GLPI_ROOT . '/inc/includes.php';
}

// Set up test database connection
$_ENV['DB_HOST'] = $_ENV['DB_HOST'] ?? '127.0.0.1';
$_ENV['DB_PORT'] = $_ENV['DB_PORT'] ?? '3306';
$_ENV['DB_NAME'] = $_ENV['DB_NAME'] ?? 'glpi_test';
$_ENV['DB_USER'] = $_ENV['DB_USER'] ?? 'glpi_user';
$_ENV['DB_PASS'] = $_ENV['DB_PASS'] ?? 'glpi_pass';

// Initialize test session
if (class_exists('Session')) {
    Session::setActiveEntity(0, true);
}

// Helper functions for tests
function getTestDB() {
    return new PDO(
        "mysql:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_NAME']}",
        $_ENV['DB_USER'],
        $_ENV['DB_PASS'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
}

// Clean up function
register_shutdown_function(function() {
    // Clean up test data if needed
});