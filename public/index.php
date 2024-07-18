<?php declare(strict_types=1);

use const Tracker\CONFIG_SECTION_REMOTE_HOST;

$autoload = realpath(__DIR__ . '/../vendor/autoload.php');

if(file_exists($autoload)) {
    require_once $autoload;

    echo CONFIG_SECTION_REMOTE_HOST;
}