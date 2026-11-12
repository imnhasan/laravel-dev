<?php

namespace App\Services\Adapter;

use Exception;


/*
|-----------------------------------------------------------------------------------------------------------------------
| Step 2
|-----------------------------------------------------------------------------------------------------------------------
*/

// class PaymentProcessor
// {
//     private $paymentMethod;
//
//     public function __construct(string $paymentMethod)
//     {
//         $this->paymentMethod = $paymentMethod;
//     }
//
//     public function processPayment(float $amount)
//     {
//         if ($this->paymentMethod === 'stripe') {
//             $stripe = new StripePayment();
//             return $stripe->processPayment($amount);
//         } elseif ($this->paymentMethod === 'paypal') {
//             $paypal = new PaypalPayment();
//             return $paypal->charge($amount);
//         } else {
//             return false;
//         }
//     }
//
//     public function processRefund(float $amount)
//     {
//         if ($this->paymentMethod === 'stripe') {
//             $stripe = new StripePayment();
//             return $stripe->processRefund($amount);
//         } elseif ($this->paymentMethod === 'paypal') {
//             $paypal = new PaypalPayment();
//             return $paypal->sendRefund($amount);
//         } else {
//             return false;
//         }
//     }
// }


/*
|-----------------------------------------------------------------------------------------------------------------------
| Step 3
|-----------------------------------------------------------------------------------------------------------------------
*/

class PaymentProcessor {
    private $gateway;

    public function __construct(PaymentGatewayInterface $gateway) {
        $this->gateway = $gateway;
    }

    public function processPayment(float $amount)
    {
        return $this->gateway->pay($amount);
    }

    public function processRefund(float $amount)
    {
        return $this->gateway->refund($amount);
    }
}
