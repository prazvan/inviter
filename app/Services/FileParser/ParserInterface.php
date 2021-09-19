<?php

namespace App\Services\FileParser;

use App\Services\FileParser\Drivers\DriverInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

/**
 * Parser Interface
 */
interface ParserInterface
{
    /**
     * Set Parser Driver
     *
     * @return mixed
     */
    public function setDriver(DriverInterface $driver): self;

    /**
     * Parse uploaded Files and return contents as Collection
     *
     * @param UploadedFile $file
     * @return Collection
     */
    public function parse(UploadedFile $file): Collection;
}
