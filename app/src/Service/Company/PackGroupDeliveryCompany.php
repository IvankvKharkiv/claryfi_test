<?php

namespace App\Service\Company;

class PackGroupDeliveryCompany extends DeliveryCompany implements DeliveryInterface
{
    const ITEM_COST = 1;

    public function calculateDeliveryCost(int $weight): int
    {
        return $weight * self::ITEM_COST;
    }
}
