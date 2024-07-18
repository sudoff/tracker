<?php declare(strict_types=1);


$autoload = realpath(__DIR__ . '/../vendor/autoload.php');

if (file_exists($autoload)) {
    require_once $autoload;


    var_dump(class_exists("\\Tracker\\EnvManager"));

}