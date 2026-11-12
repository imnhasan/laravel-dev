<?php

namespace App\Services\Adapter;

class PayPalAdapter implements PaymentGatewayInterface
{
    private $paypal;

    public function __construct(PayPalPayment $paypal)
    {
        $this->paypal = $paypal;
    }

    public function pay(float $amount)
    {
        return $this->paypal->sendPayment($amount);
    }

    public function refund(float $amount)
    {
        return $this->paypal->sendRefund($amount);
    }
}
