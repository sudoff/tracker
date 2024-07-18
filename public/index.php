<?php

declare(strict_types=1);

use Tracker\Log\Logger;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use function Tracker\isGetMethod;
use function Tracker\isPostMethod;

$autoload = realpath(__DIR__ . '/../vendor/autoload.php');

if (file_exists($autoload)) {
    require_once $autoload;

    if (!defined('DEV_MODE')) {
        define('DEV_MODE', false);
    }

    if (DEV_MODE) {
        $whoops = new Run();
        $whoops->pushHandler(new PrettyPageHandler());
        $whoops->register();
    } else {
        Kint::$enabled_mode = false;
    }

    set_error_handler(function ($errno, $errstr, $errfile, $errline) {
        $logger = Logger::getLogger();

        $errorTypes = [
            E_ERROR => 'Error',
            E_WARNING => 'Warning',
            E_PARSE => 'Parse Error',
            E_NOTICE => 'Notice',
            E_CORE_ERROR => 'Core Error',
            E_CORE_WARNING => 'Core Warning',
            E_COMPILE_ERROR => 'Compile Error',
            E_COMPILE_WARNING => 'Compile Warning',
            E_USER_ERROR => 'User Error',
            E_USER_WARNING => 'User Warning',
            E_USER_NOTICE => 'User Notice',
            E_STRICT => 'Runtime Notice',
            E_RECOVERABLE_ERROR => 'Catchable Fatal Error',
            E_DEPRECATED => 'Deprecated',
            E_USER_DEPRECATED => 'User Deprecated',
        ];

        $type = $errorTypes[$errno] ?? 'Unknown Error';

        $message = sprintf('%s: %s in %s on line %d', $type, $errstr, $errfile, $errline);

        if ($errno === E_ERROR || $errno === E_CORE_ERROR || $errno === E_COMPILE_ERROR || $errno === E_USER_ERROR) {
            $logger->critical($message);
        } else {
            $logger->warning($message);
        }

        return false;
    });

    echo 'Hello World!';


    if (isGetMethod()) {
        echo "GET";
    } elseif (isPostMethod()) {
        echo "POST";
    }
}
