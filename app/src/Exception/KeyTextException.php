<?php

namespace App\Exception;

class KeyTextException extends \RuntimeException
{
    public function __construct(string $message = 'Something went wrong during key text parsing.', int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
