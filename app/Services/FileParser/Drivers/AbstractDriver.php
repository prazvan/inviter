<?php

namespace App\Services\FileParser\Drivers;

use Illuminate\Support\Collection;

/**
 * Base Driver Functionality
 */
abstract class AbstractDriver implements DriverInterface
{
    /**
     * Create collection of temp resources
     *
     * @var Collection
     */
    protected Collection $files;

    /**
     * @param array $files
     * @return self
     */
    public function setFiles(array $files = []): self
    {
        $this->files = collect($files);
        return $this;
    }

    /**
     * @return Collection
     */
    abstract function getContents(): Collection;
}
