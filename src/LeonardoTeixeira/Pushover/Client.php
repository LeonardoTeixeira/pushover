<?php

namespace LeonardoTeixeira\Pushover;

use LeonardoTeixeira\Pushover\Exceptions\PushoverException;
use Requests;

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
        
        if ($message->getPriority() == Priority::EMERGENCY) {
            if (!$message->hasRetry()) {
                throw new PushoverException('The emergency priority must have the \'retry\' parameter.');
            }

            if (!$message->hasExpire()) {
                throw new PushoverException('The emergency priority must have the \'expire\' parameter.');
            }
        }

        $postData = [
            'user' => $this->user,
            'token' => $this->token,
            'message' => $message->getMessage(),
            'priority' => $message->getPriority()
        ];

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

        if ($message->getPriority() == Priority::EMERGENCY) {
            if ($message->hasRetry()) {
                $postData['retry'] = $message->getRetry();
            }

            if ($message->hasExpire()) {
                $postData['expire'] = $message->getExpire();
            }

            if ($message->hasCallback()) {
                $postData['callback'] = $message->getCallback();
            }
        }

        if ($message->hasSound()) {
            $postData['sound'] = $message->getSound();
        }

        if ($message->hasHtml()) {
            $postData['html'] = $message->getHtml();
        }

        if ($message->hasDate()) {
            $postData['timestamp'] = $message->getDate()->getTimestamp();
        }
        try {
            $request = Requests::post(self::API_MESSAGE_URL, [], $postData);
            $responseJson = json_decode($request->body);

            if (!isset($responseJson->status) || $responseJson->status != 1) {
                if (isset($responseJson->errors)) {
                    throw new PushoverException($responseJson->errors[0]);
                } else {
                    throw new PushoverException('Unable to access the Pushover API.');
                }
            }
        } catch (\Exception $e) {
            throw new PushoverException($e->getMessage());
        }
    }
}
