<?php

namespace App\Http\Controllers\Student\payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\payment\PaymentPaymobRequest;
use App\Models\PaymentRequest;
use App\service\PaymentPaymob;
use Illuminate\Http\Request;

class PaymentPaymobController extends Controller
{

    use PaymentPaymob;
    // This Controller About Payment Check Out By Paymob
     public function credit(PaymentPaymobRequest $request)
    {
         $requestValidated = $request->validated();
        //this fucntion that send all below function data to paymob and use it for routes;
        $user = $request->user();
        
         $tokens = $this->getToken();
        return $order = $this->createOrder( $request , $tokens, $user);
        $amount_cents = $order->amount_cents;
        $paymentToken = $this->getPaymentToken($user, $amount_cents, $order, $tokens);
        $items = $order->items;
        //    $items = $order['order'];
        $totalAmount = (float)$request->total_amount;
        $paymentLink = "https://accept.paymob.com/api/acceptance/iframes/" . env('PAYMOB_IFRAME_ID') . '?payment_token=' . $paymentToken;
        //  redirect($paymentLink);
        return response()->json(
            [
                'url' => $paymentLink,
            ]
        );

        // return Redirect::away('https://accept.paymob.com/api/acceptance/iframes/'.env('PAYMOB_IFRAME_ID').'?payment_token='.$paymentToken);
    }
}
