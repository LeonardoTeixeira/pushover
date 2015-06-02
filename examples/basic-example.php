<?php

require __DIR__ . '/../vendor/autoload.php';

use LeonardoTeixeira\Pushover\Client;
use LeonardoTeixeira\Pushover\Message;
use LeonardoTeixeira\Pushover\Exceptions\PushoverException;

$client = new Client('YOUR_USER_CODE_HERE', 'YOUR_TOKEN_HERE');

$message = new Message('Your message here.');

// you also can pass a title and device on constructor
// $message = new Message('Your message here.', 'Title here', 'device_id');

try {
    $client->push($message);
    echo 'The message has been pushed!', PHP_EOL;
} catch (PushoverException $e) {
    echo 'ERROR: ', $e->getMessage(), PHP_EOL;
}
