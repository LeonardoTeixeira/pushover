<?php

require __DIR__ . '/../vendor/autoload.php';

use LeonardoTeixeira\Pushover\Client;
use LeonardoTeixeira\Pushover\Message;

$client = new Client('YOUR_USER_CODE_HERE', 'YOUR_TOKEN_HERE');

$message = new Message('Your message here.');

// you also can pass a title and device on constructor
// $message = new Message('Your message here.', 'Title here', 'device_id');

try {
    $client->push($message);
    echo 'The message has been pushed!', PHP_EOL;
} catch (\Exception $e) {
    echo 'ERROR: ', $e->getMessage(), PHP_EOL;
}
