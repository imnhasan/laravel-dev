<?php

namespace App\Services\Adapter;

interface PaymentGatewayInterface
{
    public function pay(float $amount);
    public function refund(float $amount);
}
