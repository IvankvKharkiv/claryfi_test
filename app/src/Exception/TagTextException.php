<?php

namespace App\Exception;

class TagTextException extends \RuntimeException
{
    public function __construct(string $message = 'Something went wrong during tag text parsing.', int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
