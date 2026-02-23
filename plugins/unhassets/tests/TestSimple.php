<?php
use PHPUnit\Framework\TestCase;

class TestSimple extends TestCase {
    public function testAddition() {
        $this->assertEquals(4, 2+2);
    }
}
