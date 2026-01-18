<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testBootstrapWorks()
    {
        $this->assertTrue(function_exists('testBootstrap'));
        $this->assertTrue(testBootstrap());
    }

    public function testDatabaseConnection()
    {
        if (function_exists('getTestDB')) {
            try {
                $db = getTestDB();
                $this->assertInstanceOf('PDO', $db);
            } catch (Exception $e) {
                $this->markTestSkipped('Database connection not available: ' . $e->getMessage());
            }
        } else {
            $this->markTestSkipped('getTestDB function not available');
        }
    }

    public function testEnvironmentVariables()
    {
        $this->assertNotEmpty($_ENV['DB_HOST']);
        $this->assertNotEmpty($_ENV['DB_NAME']);
        $this->assertNotEmpty($_ENV['DB_USER']);
    }
}