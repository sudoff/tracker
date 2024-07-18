<?php

declare(strict_types=1);

namespace Tracker\Traits;

trait StaticOnlyTrait
{
    /**
     * Prevent creating a new instance of the class.
     */
    final private function __construct()
    {
        // Intentionally left empty to prevent instance creation
    }

    /**
     * Prevent the object from being unserialized.
     */
    final protected function __wakeup()
    {
        // Intentionally left empty to prevent deserialization
    }

    /**
     * Prevent the object from being cloned.
     */
    final protected function __clone()
    {
        // Intentionally left empty to prevent cloning
    }
}
