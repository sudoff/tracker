<?php

declare(strict_types=1);

namespace Tracker\Log;

use Monolog\Handler\StreamHandler;
use Monolog\Logger as MonologLogger;

use const Tracker\CRITICAL_LOG_FILE;

class Logger
{
    private static MonologLogger $logger;

    public static function getLogger(): MonologLogger
    {
        if (self::$logger === null) {
            self::$logger = new MonologLogger('tracker');
            self::$logger->pushHandler(new StreamHandler(CRITICAL_LOG_FILE, MonologLogger::CRITICAL));
        }

        return self::$logger;
    }
}
