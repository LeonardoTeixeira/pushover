<?php

namespace LeonardoTeixeira\Pushover;

use LeonardoTeixeira\Pushover\Exceptions\PushoverException;
use Requests;
use Requests_Hooks;

class Client
{
    private $user;
    private $token;

    const API_MESSAGE_URL = 'https://api.pushover.net/1/messages.json';
    const API_RECEIPTS_URL = 'https://api.pushover.net/1/receipts';

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

      if ($message->hasAttachment()) {
         $postData['attachment'] = new \CURLFile(realpath($message->getAttachment()));
      }

        try {
         // Using hooks is an ugly hack since we bypass the fancy request API
         // Up to no, Requests doesn't support multi-part headers :-/
         //
         // Should we switch to guzzle/guzzle ?
         $hooks = new Requests_Hooks();
         $hooks->register('curl.before_send', function($fp) use ($postData) {
         curl_setopt($fp, CURLOPT_POSTFIELDS, $postData);
         $postData = [];
            });
            $hooks = ['hooks' => $hooks];

            $request = Requests::post(self::API_MESSAGE_URL, [], $postData, $hooks);
            $responseJson = json_decode($request->body);

            if (!isset($responseJson->status) || $responseJson->status != 1) {
                if (isset($responseJson->errors)) {
                    throw new PushoverException($responseJson->errors[0]);
                } else {
                    throw new PushoverException('Unable to access the Pushover API.');
                }
            }
            if(isset($responseJson->receipt)) {
                return new Receipt($responseJson->receipt);
            }
            return new Receipt();

        } catch (\Exception $e) {
            throw new PushoverException($e->getMessage());
        }
    }

    public function poll(Receipt $receipt)
    {
        if (! $receipt instanceof Receipt ) {
            throw new PushoverException('The parameter \'$receipt\' must be a Receipt instance.');
        }
        
        if(is_null($receipt->getReceipt())) {
            throw new PushoverException('The receipt content was not set.');            
        }

        try {
            $request = Requests::get(self::API_RECEIPTS_URL.'/'.$receipt->getReceipt().'.json?token='.$this->token, []);
            $responseJson = json_decode($request->body, true);
            
            if (!isset($responseJson['status']) || $responseJson['status'] != 1) {
                if (isset($responseJson['errors'])) {
                    throw new PushoverException($responseJson['errors'][0]);
                } else {
                    throw new PushoverException('Unable to access the Pushover API.');
                }
            }
            return new Status($responseJson);

        } catch (\Exception $e) {
            throw new PushoverException($e->getMessage());
        }
    }
    public function cancel(Receipt $receipt)
    {
        if (! $receipt instanceof Receipt ) {
            throw new PushoverException('The parameter \'$receipt\' must be a Receipt instance.');
        }
        
        if(is_null($receipt->getReceipt())) {
            throw new PushoverException('The receipt content was not set.');            
        }

        try {
            $request = Requests::post(self::API_RECEIPTS_URL.'/'.$receipt->getReceipt().'/cancel.json', [], ['token' => $this->token]);
            $responseJson = json_decode($request->body, true);
                        
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
