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
                'message' => 'Example content message <b>1</b>.',
                'url' => 'http://www.google.com/',
                'url_title' => 'Google',
                'priority' => - 2,
                'sound' => 'classical',
                'html' => 1,
                'date' => '2014-08-14'
            ],
            [
                'title' => 'Example Message 2',
                'message' => 'Example content message <b>2</b>.',
                'url' => 'https://github.com/',
                'url_title' => 'Github',
                'priority' => 1,
                'sound' => 'spacealarm',
                'html' => 1,
                'date' => '2014-08-10'
            ],
            [
                'title' => 'Example Message 3',
                'message' => 'Example content message <b>3</b>.',
                'url' => 'https://slack.com/',
                'url_title' => 'Slack',
                'priority' => 2,
                'sound' => 'mechanical',
                'html' => 1,
                'date' => '2017-01-19',
                'retry' => 30,
                'expire' => 7200,
                'callback' => 'http://localhost'
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
            $m->setHtml($message['html']);
            $m->setDate(new \DateTime($message['date']));
            if ($message['priority'] == 2) {
                $m->setRetry($message['retry']);
                $m->setExpire($message['expire']);
                $m->setCallback($message['callback']);
            }

            $this->assertEquals($message['title'], $m->getTitle());
            $this->assertEquals($message['message'], $m->getMessage());
            $this->assertEquals($message['url'], $m->getUrl());
            $this->assertEquals($message['url_title'], $m->getUrlTitle());
            $this->assertEquals($message['priority'], $m->getPriority());
            $this->assertEquals($message['sound'], $m->getSound());
            $this->assertEquals($message['html'], $m->getHtml());
            $this->assertEquals($message['date'], $m->getDate()
                ->format('Y-m-d'));
            if ($message['priority'] == 2) {
                $this->assertEquals($message['retry'], $m->getRetry());
                $this->assertEquals($message['expire'], $m->getExpire());
                $this->assertEquals($message['callback'], $m->getCallback());
            }
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
            $this->assertFalse($m->hasRetry());
            $this->assertFalse($m->hasExpire());
            $this->assertFalse($m->hasCallback());
            $this->assertFalse($m->hasSound());
            $this->assertFalse($m->hasHtml());
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
            $m->setHtml($message['html']);
            $m->setDate(new \DateTime($message['date']));
            if ($message['priority'] == 2) {
                $m->setRetry($message['retry']);
                $m->setExpire($message['expire']);
                $m->setCallback($message['callback']);
            }

            $this->assertTrue($m->hasTitle());
            $this->assertTrue($m->hasUrl());
            $this->assertTrue($m->hasUrlTitle());
            $this->assertTrue($m->hasSound());
            $this->assertTrue($m->hasHtml());
            $this->assertTrue($m->hasDate());

            if ($message['priority'] == 2) {
                $this->assertTrue($m->hasRetry());
                $this->assertTrue($m->hasExpire());
                $this->assertTrue($m->hasCallback());
            } else {
                $this->assertFalse($m->hasRetry());
                $this->assertFalse($m->hasExpire());
                $this->assertFalse($m->hasCallback());
            }
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
