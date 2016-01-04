<?php

require __DIR__ . '/../vendor/autoload.php';

date_default_timezone_set('UTC');

use LeonardoTeixeira\Pushover\Client;
use LeonardoTeixeira\Pushover\Message;
use LeonardoTeixeira\Pushover\Priority;
use LeonardoTeixeira\Pushover\Sound;
use LeonardoTeixeira\Pushover\Exceptions\PushoverException;

$client = new Client('YOUR_USER_CODE_HERE', 'YOUR_TOKEN_HERE');

$message = new Message();
$message->setMessage('Your messsage <b>here</b>.');
$message->setTitle('Title here');
$message->setUrl('http://www.example.com/');
$message->setUrlTitle('Click me!');
$message->setPriority(Priority::HIGH);
$message->setSound(Sound::SIREN);
$message->setHtml(true);
$message->setDate(new \DateTime());

try {
    $client->push($message);
    echo 'The message has been pushed!', PHP_EOL;
} catch (PushoverException $e) {
    echo 'ERROR: ', $e->getMessage(), PHP_EOL;
}
