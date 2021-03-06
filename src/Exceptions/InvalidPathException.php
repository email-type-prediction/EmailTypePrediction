<?php
declare(strict_types=1);

namespace EmailTypePrediction\EmailTypePrediction\Exceptions;

use Exception;

class InvalidPathException extends Exception
{
    private const DEFAULT_MESSAGE = 'Parameter path is invalid';

    public function __construct(string $message = self::DEFAULT_MESSAGE)
    {
        parent::__construct($message);
    }
}