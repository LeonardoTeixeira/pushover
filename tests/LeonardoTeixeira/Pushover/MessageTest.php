<?php

namespace LeonardoTeixeira\Pushover;

class MessageTest extends \PHPUnit_Framework_TestCase
{
    private $messages;

    public function setUp()
    {
        $this->messages = [
            [
                'title' => 'Example Message 1',
                'message' => 'Example content message 1.',
                'url' => 'http://www.google.com/',
                'url_title' => 'Google',
                'priority' => - 2,
                'sound' => 'classical',
                'date' => '2014-08-14'
            ],
            [
                'title' => 'Example Message 2',
                'message' => 'Example content message 2.',
                'url' => 'https://github.com/',
                'url_title' => 'Github',
                'priority' => 1,
                'sound' => 'spacealarm',
                'date' => '2014-08-10'
            ]
        ];
    }

    public function testConstructor()
    {
        foreach ($this->messages as $message) {
            $m = new Message($message['message'], $message['title'], $message['priority']);
            $this->assertEquals($message['title'], $m->getTitle());
            $this->assertEquals($message['message'], $m->getMessage());
            $this->assertEquals($message['priority'], $m->getPriority());
        }
    }

    public function testGettersAndSetters()
    {
        foreach ($this->messages as $message) {
            $m = new Message();

            $m->setTitle($message['title']);
            $m->setMessage($message['message']);
            $m->setUrl($message['url']);
            $m->setUrlTitle($message['url_title']);
            $m->setPriority($message['priority']);
            $m->setSound($message['sound']);
            $m->setDate(new \DateTime($message['date']));

            $this->assertEquals($message['title'], $m->getTitle());
            $this->assertEquals($message['message'], $m->getMessage());
            $this->assertEquals($message['url'], $m->getUrl());
            $this->assertEquals($message['url_title'], $m->getUrlTitle());
            $this->assertEquals($message['priority'], $m->getPriority());
            $this->assertEquals($message['sound'], $m->getSound());
            $this->assertEquals($message['date'], $m->getDate()
                ->format('Y-m-d'));
        }
    }

    public function testHasMethods()
    {
        foreach ($this->messages as $message) {
            $m = new Message();

            $m->setMessage($message['message']);
            $m->setPriority($message['priority']);

            $this->assertFalse($m->hasTitle());
            $this->assertFalse($m->hasUrl());
            $this->assertFalse($m->hasUrlTitle());
            $this->assertFalse($m->hasSound());
            $this->assertFalse($m->hasDate());
        }

        foreach ($this->messages as $message) {
            $m = new Message();

            $m->setTitle($message['title']);
            $m->setMessage($message['message']);
            $m->setUrl($message['url']);
            $m->setUrlTitle($message['url_title']);
            $m->setPriority($message['priority']);
            $m->setSound($message['sound']);
            $m->setDate(new \DateTime($message['date']));

            $this->assertTrue($m->hasTitle());
            $this->assertTrue($m->hasUrl());
            $this->assertTrue($m->hasUrlTitle());
            $this->assertTrue($m->hasSound());
            $this->assertTrue($m->hasDate());
        }
    }

    /**
     * @expectedException LeonardoTeixeira\Pushover\Exceptions\InvalidArgumentException
     */
    public function testInvalidArgumentExceptionFromPriority()
    {
      $m = new Message();
      $m->setPriority(-5);
    }

    /**
     * @expectedException LeonardoTeixeira\Pushover\Exceptions\InvalidArgumentException
     */
    public function testInvalidArgumentExceptionFromSound()
    {
      $m = new Message();
      $m->setSound('invalid_sound');
    }
}
