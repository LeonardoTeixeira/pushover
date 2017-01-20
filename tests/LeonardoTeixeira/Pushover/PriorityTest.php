<?php

namespace LeonardoTeixeira\Pushover;

class PriorityTest extends \PHPUnit_Framework_TestCase
{
    public function testPriorities()
    {
        $this->assertEquals(- 2, Priority::LOWEST);
        $this->assertEquals(- 1, Priority::LOW);
        $this->assertEquals(0, Priority::NORMAL);
        $this->assertEquals(1, Priority::HIGH);
        $this->assertEquals(2, Priority::EMERGENCY);
    }

    public function testIfPriorityExists()
    {
      $this->assertTrue(Priority::has(-2));
      $this->assertTrue(Priority::has(-1));
      $this->assertTrue(Priority::has(0));
      $this->assertTrue(Priority::has(1));
      $this->assertTrue(Priority::has(2));
      $this->assertFalse(Priority::has(-5));
      $this->assertFalse(Priority::has(10));
    }
}
