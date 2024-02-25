<?php

namespace App\Service\Company;

class TransCompanyDeliveryCompany extends DeliveryCompany implements DeliveryInterface
{
    const ITEM_COST = 10;

    public function calculateDeliveryCost(int $weight): int
    {
        return $weight <= self::ITEM_COST ? 20 : 100;
    }
}
