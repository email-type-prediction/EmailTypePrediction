<?php
declare(strict_types=1);

namespace EmailTypePrediction\EmailTypePrediction\Exceptions;

use Exception;

class InvalidTypeException extends Exception
{
    private const DEFAULT_MESSAGE = 'Parameter type is invalid';

    public function __construct(string $message = self::DEFAULT_MESSAGE)
    {
        parent::__construct($message);
    }
}