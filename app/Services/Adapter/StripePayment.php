<?php

namespace App\Services\Adapter;



/*
|-----------------------------------------------------------------------------------------------------------------------
| Step 1
|-----------------------------------------------------------------------------------------------------------------------
*/


class StripePayment
{
    public function processPayment($amount)
    {
        // TODO: steps
        return [
            'success' => true,
            'message' => "Payment take $amount USD",
        ];
    }

}


/*
|-----------------------------------------------------------------------------------------------------------------------
| Step 2
|-----------------------------------------------------------------------------------------------------------------------
*/
//
// class StripePayment
// {
//     public function processPayment($amount) {
//         // Stripe specific implementation
//         return "Stripe take payment $$amount";
//     }
//
//     public function processRefund($amount) {
//         // Stripe specific implementation
//         return "Stripe refund $$amount";
//     }
// }
