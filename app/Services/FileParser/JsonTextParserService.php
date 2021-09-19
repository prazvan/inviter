<?php

namespace App\Services\FileParser;

use Illuminate\Http\UploadedFile;
use App\Services\FileParser\Drivers\TextFile as TextFileDriver;
use App\Helpers\Traits\Singleton;
use Illuminate\Support\Collection;

/**
 * Json Text Parser Service.
 * Takes an uploaded file and parse it to a valid collection
 */
final class JsonTextParserService extends AbstractParser
{
    // use the singleton pattern
    use Singleton;

    /**
     * Parse the given uploaded file.
     *
     * @param UploadedFile $file
     * @return Collection
     * @throws \Exception
     */
    public function parse(UploadedFile $file): Collection
    {
        try
        {
            // make new empty collection
            $jsonCollection = collect([]);

            // before we parse, let's set the driver and temp file
            // the driver can handle other business logic, for example like saving the date into the db, or calling apis...
            $contents = $this->setDriver(new TextFileDriver)->process($file);

            // parse each file and make a json collection of them
            $contents->each(function ($file) use ($jsonCollection)
            {
                // parse each line, try to decode it and add it to the collection
                foreach ($file as $line)
                {
                    if ($decoded = json_decode($line, true))
                    {
                        $jsonCollection->push(collect($decoded));
                    }
                }
            });

            return $jsonCollection;
        }
        catch (\Exception $exception)
        {
            // here we can do some awesome logging of errors :)
            throw $exception;
        }
    }
}
