# Pushover for PHP

[![Build Status](https://img.shields.io/travis/LeonardoTeixeira/pushover.svg?style=flat)](https://travis-ci.org/LeonardoTeixeira/pushover)
[![Version](https://img.shields.io/packagist/v/leonardoteixeira/pushover.svg?style=flat)](https://packagist.org/packages/leonardoteixeira/pushover)
[![Total Downloads](https://img.shields.io/packagist/dt/leonardoteixeira/pushover.svg?style=flat)](https://packagist.org/packages/leonardoteixeira/pushover)
[![License](https://img.shields.io/packagist/l/leonardoteixeira/pushover.svg?style=flat)](https://packagist.org/packages/leonardoteixeira/pushover)

A simple PHP library for the [Pushover](https://pushover.net) service.

This library was written using the [PSR-4](http://www.php-fig.org/psr/psr-4/) standards.

## Installation

Use the [Composer](https://getcomposer.org/) to install.

### composer.json

```json
{
	"require": {
		"leonardoteixeira/pushover": "1.*"
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
You also can pass a title and the priority on constructor:

```php
$message = new Message('Your message here.', 'Title here', Priority::HIGH);
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
```

### Emergency Priority
For the emergency priority you must provide the parameters `retry` and `expire`. The `callback` parameter is optional.

[More information](https://pushover.net/api#priority)

```php
$message->setPriority(Priority::EMERGENCY);
$message->setRetry(60);
$message->setExpire(10800);
$message->setCallback('http://callback-url.com/');
```

## Running the tests

```
vendor/bin/phpunit
```
