<?php declare(strict_types=1);

namespace Tracker\Traits;

use Exception;

trait ImmutableTrait
{

    /**
     * @param string $name
     * @param mixed $value
     * @return mixed
     * @throws Exception
     */
    public function __set(string $name, $value)
    {
        throw new Exception("Cannot modify immutable object");
    }

    /**
     * @param string $name
     * @return mixed
     * @throws Exception
     */
    public function __get(string $name)
    {
        throw new Exception("Cannot directly access object property");
    }
}