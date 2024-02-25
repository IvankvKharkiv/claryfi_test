<?php

namespace App\Service\Company;

interface DeliveryInterface
{
    public function calculateDeliveryCost(int $weight): int;
}