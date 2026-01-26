<?php
use PHPUnit\Framework\TestCase;

// Inclure les fonctions à tester
require_once __DIR__ . '/../inc/dashboardFunctions.php';

class MockDB {
    public function request($params) {
        return new class {
            public function current() { return ['cpt' => 5]; }
        };
    }
}

class DashboardTest extends TestCase {

    private $DB;

    protected function setUp(): void {
        $this->DB = new MockDB();
    }

    public function testSafeCountRetourneEntier() {
        $this->assertIsInt(safeCount($this->DB, 'fake_table'));
    }

    public function testGetOpenIncidents() {
        $this->assertEquals(5, getOpenIncidents($this->DB));
    }

    public function testGetResolvedIncidents() {
        $this->assertEquals(5, getResolvedIncidents($this->DB));
    }
}
