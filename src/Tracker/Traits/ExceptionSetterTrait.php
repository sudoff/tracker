<?php

declare(strict_types=1);

namespace Tracker\Traits;

trait ExceptionSetterTrait
{
    public function setFile(string $file): void
    {
        $this->file = $file;
    }

    /**
     * @param int $line
     * @return void
     */
    public function setLine(int $line): void
    {
        $this->line = $line;
    }
}
