<?php

namespace App\Services\FileParser;

use App\Services\FileParser\Drivers\{
    DriverInterface
};

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

/**
 * Parsers base functionality
 */
abstract class AbstractParser implements ParserInterface
{
    /**
     * File Handler
     *
     * @var DriverInterface
     */
    private DriverInterface $driver;

    /**
     * What Driver to use
     *
     * @param DriverInterface $driver
     * @return $this
     */
    public function setDriver(DriverInterface $driver): self
    {
        $this->driver = $driver;
        return $this;
    }

    /**
     * Get Driver Instance
     *
     * @return DriverInterface
     */
    protected function getDriver(): DriverInterface
    {
        return $this->driver;
    }

    /**
     * Parse Given File
     *
     * @param UploadedFile $file
     * @return Collection
     */
    public function process(UploadedFile $file): Collection
    {
        // create collection of files
        $this->driver->setFiles([$file]);

        // store file
       return $this->driver->getContents();
    }
}
