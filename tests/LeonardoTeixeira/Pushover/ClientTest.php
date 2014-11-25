<?php

namespace LeonardoTeixeira\Pushover;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    private $clients;

    public function setUp()
    {
        $this->clients = [
            [
                'user' => 'DFx4rPNV232ad49uzPE4vAKaU2m67q',
                'token' => 'khvGW7kDj4MeJ2uG8c3z973No49wWY'
            ],
            [
                'user' => '2T72X267muFg2FGZqT46ze8KskxMmA',
                'token' => '4GmnbfBcr3rR4VT7r2G4eK22HL7a2J'
            ],
            [
                'user' => 'LB787zoD82899PqpT6zbiGeaAAo8xA',
                'token' => 'Q7HTQ9yjW8LRfroy83V34764ydaYQE'
            ]
        ];
    }

    public function testConstructor()
    {
        foreach ($this->clients as $client) {
            $c = new Client($client['user'], $client['token']);
            $this->assertEquals($client['user'], $c->getUser());
            $this->assertEquals($client['token'], $c->getToken());
        }
    }

    public function testGettersAndSetters()
    {
        foreach ($this->clients as $client) {
            $c = new Client();
            $c->setUser($client['user']);
            $c->setToken($client['token']);
            $this->assertEquals($client['user'], $c->getUser());
            $this->assertEquals($client['token'], $c->getToken());
        }
    }
}
