<?php declare(strict_types=1);

namespace Tracker\Exceptions;

use Tracker\Traits\ExceptionSetterTrait;
use RuntimeException;
use Throwable;

class SingletonException extends RuntimeException
{

    use ExceptionSetterTrait;

    /**
     * Constructs the SingletonException.
     * @param string $message  The message that explains the reason for the exception.
     * @param int $code        The code that identifies the exception.
     * @param Throwable|null $previous  The previous throwable used for exception chaining.
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}