<?php

date_default_timezone_set('UTC');

ini_set('display_errors', true);
error_reporting(E_ALL);

$autoloadPath = __DIR__ . '/../vendor/autoload.php';

if (! file_exists($autoloadPath)) {
    die('File autoload.php not found. Run \'composer install\' command.');
}

require $autoloadPath;
