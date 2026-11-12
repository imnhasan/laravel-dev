<?php

namespace App\Services\Adapter;


/*
|-----------------------------------------------------------------------------------------------------------------------
| Step 1
|-----------------------------------------------------------------------------------------------------------------------
*/
//
// class PayPalPayment
// {
//     public function charge($amount)
//     {
//         return [
//             'status' => 'completed',
//             'message' => "Payment take $amount USD",
//         ];
//     }
//
// }


/*
|-----------------------------------------------------------------------------------------------------------------------
| Step 2
|-----------------------------------------------------------------------------------------------------------------------
*/
//
class PayPalPayment
{
    public function sendPayment($amount) {
        // Paypal specific implementation
        return "Paypal take payment $$amount";
    }

    public function sendRefund($amount) {
        // Paypal specific implementation
        return "Paypal refund $$amount";
    }

}
