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
    }
}
