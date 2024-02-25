<?php

namespace App\Service\Company;

use App\Service\Company\Exception\CompanyNotFoundException;

class CompanyFactory
{
    const TRANS_COMPANY = 'trans_company';
    const PACK_GROUP = 'pack_group';
    const WRONG_COMPANY_FOR_ERROR_CHECK = 'wrong_company_for_error_check';

    const COMPANY_CHOISES = [
        self::TRANS_COMPANY => 'TransCompany',
        self::PACK_GROUP => 'PackGroup',
    ];

    public static function createCompany(string $companySlug): DeliveryInterface
    {
        return match ($companySlug) {
            self::PACK_GROUP => new PackGroupDeliveryCompany(),
            self::TRANS_COMPANY => new TransCompanyDeliveryCompany(),
            default => throw new CompanyNotFoundException(sprintf('Company %s not found', $companySlug)),
        };
    }
}
