<?php

declare(strict_types=1);

namespace Tracker\Traits;

use ReflectionObject;
use RuntimeException;

trait ClassMetadataTrait
{
    /**
     * Get the full class name including namespace.
     *
     * @return string The full class name.
     */
    public function getClassName(): string
    {
        return static::class;
    }

    /**
     * Get the short class name without namespace.
     *
     * @return string The short class name.
     */
    public function getShortClassName(): string
    {
        return substr(strrchr('\\' . static::class, '\\') ?: "", 1);
    }

    /**
     * Get a ReflectionObject for the class to introspect its properties and methods.
     *
     * @return ReflectionObject The reflection object for the class.
     */
    public function getReflectionObject(): ReflectionObject
    {
        return new ReflectionObject($this);
    }

    /**
     * Get a unique hash for the instance of the class.
     *
     * @return string A unique hash representing the object instance.
     */
    public function getObjectHash(string $algorithm = "md5"): string
    {
        throw new RuntimeException("Unsupported method call. Override method {$this->getClassName()}::getObjectHash to use");
    }

    /**
     * Get a unique hash for the class definition.
     *
     * This hash can be used to verify changes in the class structure or version.
     *
     * @return string A unique hash representing the class definition.
     */
    public function getClassDefinitionHash(string $algorithm = "md5"): string
    {
        return hash($algorithm, $this->getClassName());
    }
}
