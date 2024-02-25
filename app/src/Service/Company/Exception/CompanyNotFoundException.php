<?php

namespace App\Service\Company\Exception;

class CompanyNotFoundException extends \RuntimeException
{
    public function __construct(string $message = 'Company not found', int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
