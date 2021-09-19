<?php

namespace App\Services\FileParser\Drivers;

use Illuminate\Support\Collection;

/**
 * Drivers Interface
 */
interface DriverInterface
{
    /**
     * Set Files to parse
     *
     * @return $this
     */
    public function setFiles(array $files = []): self;

    /**
     * returns an Array with all the file contents
     *
     * @return Collection
     */
    public function getContents(): Collection;
}
