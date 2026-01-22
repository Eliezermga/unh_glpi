<?php
/**
 * PHPUnit bootstrap file for GLPI tests
 */

// Define test environment
define('GLPI_ROOT', dirname(__DIR__));
define('TU_USER', '_test_user');
define('TU_PASS', 'glpi');
define('GLPI_CONFIG_DIR', GLPI_ROOT . '/tests/config');

// Set up test database connection
$_ENV['DB_HOST'] = $_ENV['DB_HOST'] ?? '127.0.0.1';
$_ENV['DB_PORT'] = $_ENV['DB_PORT'] ?? '3306';
$_ENV['DB_NAME'] = $_ENV['DB_NAME'] ?? 'glpi_test';
$_ENV['DB_USER'] = $_ENV['DB_USER'] ?? 'glpi_user';
$_ENV['DB_PASS'] = $_ENV['DB_PASS'] ?? 'glpi_pass';

// Prevent session and language loading issues
$_SESSION = [];
$_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'en-US,en;q=0.9';
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['REQUEST_URI'] = '/test';
$_SERVER['HTTP_HOST'] = 'localhost';

// Mock configuration to prevent GLPI initialization issues
if (!defined('GLPI_INSTALL_MODE')) {
    define('GLPI_INSTALL_MODE', 'SILENT');
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

// Simple test to verify bootstrap works
function testBootstrap() {
    return true;
}

// Clean up function
register_shutdown_function(function() {
    // Clean up test data if needed
});