<?php

namespace LeonardoTeixeira\Pushover;

class Priority
{
    const LOWEST = - 2;
    const LOW = - 1;
    const NORMAL = 0;
    const HIGH = 1;

    public static function getAllPriorities()
    {
        return array(
            self::LOWEST,
            self::LOW,
            self::NORMAL,
            self::HIGH
        );
    }
}
