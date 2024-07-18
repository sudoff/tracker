<?php

declare(strict_types=1);

namespace Tracker\Traits;

use Tracker\Exceptions\SingletonException;
use Throwable;

trait SingletonConstructorTrait
{
    /**
     * Holds the singleton instance of this class.
     * @var static
     */
    private static $instance;

    /**
     * Returns the singleton instance, creating it with provided arguments on the first call.
     * Subsequent calls with different arguments will throw an exception.
     *
     * @param mixed ...$args Arguments to pass to the constructor on the first call.
     * @return self The singleton instance.
     * @throws SingletonException|Throwable If called with arguments after the initial creation.
     */

    final public static function getInstance(...$args): self
    {
        static $instance = null;
        if ($instance === null) {
            $instance = new static(...$args);
        } elseif (!empty($args)) {
            throw new SingletonException("An instance of this Singleton has already been created with different parameters.");
        }
        return $instance;
    }


    /**
     * Constructor for the singleton instance.
     *
     * @param mixed ...$args Arguments to pass to the constructor on the first call.
     * @throws Throwable Any exception that could be thrown during the initialization.
     */
    final private function __construct(...$args)
    {
        $this->traitSingletonInit(...$args);
    }

    /**
     * Initialization method for the singleton instance. Must be implemented by the using class.
     *
     * @param mixed ...$args Arguments to initialize the singleton instance.
     */
    abstract protected function traitSingletonInit(...$args): void;

    /**
     * Prevents the singleton from being unserialized.
     * @throws SingletonException If a deserialization attempt is made.
     */
    final protected function __wakeup()
    {
        throw new SingletonException("You can not deserialize a singleton");
    }

    /**
     * Prevents the singleton from being serialized.
     * @throws SingletonException If a serialization attempt is made.
     */
    final protected function __sleep()
    {
        throw new SingletonException("You can not serialize a singleton");
    }

    /**
     * Prevents the singleton from being cloned.
     * @throws SingletonException If a cloning attempt is made.
     */
    final protected function __clone()
    {
        throw new SingletonException("You can not clone a singleton");
    }
}
