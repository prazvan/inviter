<?php

namespace App\Services\FileParser\Drivers;

use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Exceptions\InvalidFileException;

/**
 * Some Basic file manipulation :)
 */
final class TextFile extends AbstractDriver
{
    /**
     * Get Contents of Files
     */
    public function getContents(): Collection
    {
        $contents = [];

        // move the file to storage
        $this->files->each(function ($file, int $index) use (&$contents)
        {
            try
            {
                // add only files that can be parsed
                if ($lines = explode("\n", $file->getContent()))
                {
                    // parse each line from the contents
                    $contents[$index] = $lines;
                }
            }
            catch (FileException $exception)
            {
                throw new InvalidFileException;
            }
        });

        return collect($contents);
    }
}
