<?php

namespace LeonardoTeixeira\Pushover;

use LeonardoTeixeira\Pushover\Exceptions\PushoverException;
use GuzzleHttp\Client as GuzzleClient;

class Client
{
    private $user;
    private $token;

    const API_MESSAGE_URL = 'https://api.pushover.net/1/messages.json';

    public function __construct($user = null, $token = null)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function push(Message $message, $device = null)
    {
        if (! $message instanceof Message) {
            throw new PushoverException('The parameter \'$message\' must be a Message instance.');
        }
        
        if ($message->getMessage() == null) {
            throw new PushoverException('The message content was not set.');
        }
        
        $postData = array(
            'user' => $this->user,
            'token' => $this->token,
            'message' => $message->getMessage(),
            'priority' => $message->getPriority()
        );
        
        if ($device != null) {
            $postData['device'] = $device;
        }
        
        if ($message->hasTitle()) {
            $postData['title'] = $message->getTitle();
        }
        
        if ($message->hasUrl()) {
            $postData['url'] = $message->getUrl();
        }
        
        if ($message->hasUrlTitle()) {
            $postData['url_title'] = $message->getUrlTitle();
        }
        
        if ($message->hasSound()) {
            $postData['sound'] = $message->getSound();
        }
        
        if ($message->hasDate()) {
            $postData['timestamp'] = $message->getDate()->getTimestamp();
        }
        try {
            $client = new GuzzleClient();
            $response = $client->post(self::API_MESSAGE_URL, array(
                'body' => $postData
            ));
            $responseJson = $response->json();
            
            if (!isset($responseJson['status']) || $responseJson['status'] != 1) {
                if (isset($responseJson['errors'])) {
                    throw new PushoverException($responseJson['errors'][0]);
                } else {
                    throw new PushoverException('Unable to access the Pushover API.');
                }
            }
        } catch (\Exception $e) {
            throw new PushoverException($e->getMessage());
        }
    }
}
