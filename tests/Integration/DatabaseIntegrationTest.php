<?php

use PHPUnit\Framework\TestCase;

class DatabaseIntegrationTest extends TestCase
{
    public function testDatabaseConnection()
    {
        if (function_exists('getTestDB')) {
            try {
                $db = getTestDB();
                $this->assertInstanceOf('PDO', $db);
                
                // Test simple query
                $result = $db->query('SELECT 1 as test');
                $row = $result->fetch();
                $this->assertEquals(1, $row['test']);
            } catch (Exception $e) {
                $this->markTestSkipped('Database connection failed: ' . $e->getMessage());
            }
        } else {
            $this->markTestSkipped('getTestDB function not available');
        }
    }
}