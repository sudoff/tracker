<?php

declare(strict_types=1);

namespace Tracker\Traits;

use Tracker\Exceptions\SingletonException;

trait SingletonTrait
{
    /**
     * Holds the singleton instance of this class.
     * @var self
     */
    private static $instance = [];

    /**
     * Returns the singleton instance of this class.
     * @return self The singleton instance.
     */
    final public static function getInstance(): self
    {
        $class = static::class;
        if (!isset(static::$instance[$class])) {
            static::$instance[$class] = new static();
            static::$instance[$class]->traitSingletonInit();
        }
        return static::$instance[$class];
    }

    /**
     * Singleton constructor.
     */
    final private function __construct()
    {
    }

    /**
     * Initialization method for the singleton instance.
     * @return void
     */
    abstract protected function traitSingletonInit(): void;

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
