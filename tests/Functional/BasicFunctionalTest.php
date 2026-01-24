<?php

use PHPUnit\Framework\TestCase;

class BasicFunctionalTest extends TestCase
{
    public function testEnvironmentSetup()
    {
        $this->assertTrue(defined('GLPI_ROOT'));
        $this->assertTrue(defined('TU_USER'));
        $this->assertNotEmpty($_ENV['DB_HOST']);
    }

    public function testFileStructure()
    {
        $this->assertDirectoryExists(GLPI_ROOT . '/src');
        $this->assertDirectoryExists(GLPI_ROOT . '/inc');
        $this->assertFileExists(GLPI_ROOT . '/index.php');
    }
}