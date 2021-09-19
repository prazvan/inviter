<?php

namespace App\Exceptions;


use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * Invalid File
 */
class InvalidFileException extends FileException
{
    // error code
    public $code = Response::HTTP_UNPROCESSABLE_ENTITY;

    // custom error message
    public $message = "File is invalid!";
}
