<?php

namespace App\Services\Adapter;

class StripeAdapter implements PaymentGatewayInterface
{
    private $stripe;

    public function __construct(StripePayment $stripe)
    {
        $this->stripe = $stripe;
    }

    public function pay(float $amount)
    {
        return $this->stripe->processPayment($amount);
    }

    public function refund(float $amount)
    {
        return $this->stripe->processRefund($amount);
    }
}
