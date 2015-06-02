<?php

namespace LeonardoTeixeira\Pushover;

class SountTest extends \PHPUnit_Framework_TestCase
{

    private $sounds;

    public function setUp()
    {
        $this->sounds = [
            'pushover',
            'bike',
            'bugle',
            'cashregister',
            'classical',
            'cosmic',
            'falling',
            'gamelan',
            'incoming',
            'intermission',
            'magic',
            'mechanical',
            'pianobar',
            'siren',
            'spacealarm',
            'tugboat',
            'alien',
            'climb',
            'persistent',
            'echo',
            'updown',
            'none'
        ];
    }

    public function testContainsAllSounds()
    {
        $allSounds = Sound::getAllSounds();
        foreach ($this->sounds as $sound) {
            $this->assertContains($sound, $allSounds);
        }
    }

    public function testIfSoundExists()
    {
      $this->assertTrue(Sound::has('mechanical'));
      $this->assertFalse(Sound::has('invalid_sound'));
    }
}
