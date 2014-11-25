# Pushover for PHP

[![Build Status](https://travis-ci.org/LeonardoTeixeira/pushover.svg?branch=master)](https://travis-ci.org/LeonardoTeixeira/pushover)
[![Total Downloads](https://poser.pugx.org/leonardoteixeira/pushover/downloads.svg)](https://packagist.org/packages/leonardoteixeira/pushover)
[![License](https://poser.pugx.org/leonardoteixeira/pushover/license.svg)](https://packagist.org/packages/leonardoteixeira/pushover)

A simple PHP library for the [Pushover](https://pushover.net) service.

This library was written using the [PSR-4](http://www.php-fig.org/psr/psr-4/) standards.

## Installation

Use the [Composer](https://getcomposer.org/) to install.

### composer.json

```json
{
	"require": {
		"leonardoteixeira/pushover": "dev-master"
	}
}
```

### Running the composer

```
composer install
```

## Usage

### Basic Example

```php
<?php

require 'vendor/autoload.php';

use LeonardoTeixeira\Pushover\Client;
use LeonardoTeixeira\Pushover\Message;
use LeonardoTeixeira\Pushover\Exceptions\PushoverException;

$client = new Client('YOUR_USER_CODE_HERE', 'YOUR_TOKEN_HERE');

$message = new Message('Your message here.');

try {
    $client->push($message);
    echo 'The message has been pushed!', PHP_EOL;
} catch (PushoverException $e) {
    echo 'ERROR: ', $e->getMessage(), PHP_EOL;
}
```
You also can pass a title and device on constructor:

```php
$message = new Message('Your message here.', 'Title here', 'device_id');
```
### Complete Example

```php
<?php

require 'vendor/autoload.php';

date_default_timezone_set('UTC');

use LeonardoTeixeira\Pushover\Client;
use LeonardoTeixeira\Pushover\Message;
use LeonardoTeixeira\Pushover\Priority;
use LeonardoTeixeira\Pushover\Sound;
use LeonardoTeixeira\Pushover\Exceptions\PushoverException;

$client = new Client('YOUR_USER_CODE_HERE', 'YOUR_TOKEN_HERE');

$message = new Message();
$message->setMessage('Your messsage here.');
$message->setTitle('Title here');
$message->setUrl('http://www.example.com/');
$message->setUrlTitle('Click me!');
$message->setPriority(Priority::HIGH);
$message->setSound(Sound::SIREN);
$message->setDate(new \DateTime());

try {
    $client->push($message);
    echo 'The message has been pushed!', PHP_EOL;
} catch (PushoverException $e) {
    echo 'ERROR: ', $e->getMessage(), PHP_EOL;
}
```

## Running the tests

```
vendor/bin/phpunit
```
