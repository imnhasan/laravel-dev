<?php

namespace App\Http\Controllers\Adapter;

use App\Http\Controllers\Controller;
use App\Services\Adapter\PaymentProcessor;
use App\Services\Adapter\PayPalPayment;
use App\Services\Adapter\StripeAdapter;
use App\Services\Adapter\StripePayment;
use Illuminate\Http\Request;

class AdapterController extends Controller
{


    /*
|-----------------------------------------------------------------------------------------------------------------------
| Step 1
|-----------------------------------------------------------------------------------------------------------------------
*/

    // public function index(Request $request)
    // {
    //     $paymentMethod = $request->type;
    //     $amount = $request->amount;
    //
    //     if ($paymentMethod === 'stripe') {
    //         $stripePayment = new StripePayment();
    //         $result = $stripePayment->processPayment($amount);
    //         dump($result);
    //     } elseif ($paymentMethod === 'paypal') {
    //         $paypalPayment = new PayPalPayment();
    //         $result = $paypalPayment->charge($amount);
    //         dump($result);
    //     }
    // }


    /*
|-----------------------------------------------------------------------------------------------------------------------
| Step 2
|-----------------------------------------------------------------------------------------------------------------------
*/


    // public function index(Request $request)
    // {
    //     $paymentMethod = $request->type;
    //     $amount = $request->amount;
    //
    //     $paymentProcessor = new PaymentProcessor($paymentMethod);
    //     $pay = $paymentProcessor->processPayment($amount);
    //     $refund = $paymentProcessor->processRefund($amount - 20);
    //
    //     dump($pay, $refund);
    // }



    /*
|-----------------------------------------------------------------------------------------------------------------------
| Step 3
|-----------------------------------------------------------------------------------------------------------------------
*/

    public function index(Request $request) {
        $amount = $request->amount;

        // Stripe usage
        $stripe = new StripePayment();
        $adapter = new StripeAdapter($stripe);
        $processor = new PaymentProcessor($adapter);
        return $processor->processPayment($amount);
    }



}
