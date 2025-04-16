<?php

namespace App\Http\Controllers\Admin\paymob;

use App\Http\Controllers\Controller;
use App\Models\PaymentRequest;
use Illuminate\Http\Request;

class CallBackPaymobController extends Controller
{
    public function __construct(private PaymentRequest $paymentRequest){}
    // This Call Back Paymob When Make Payment With Payment 
     public function callback(Request $request)
    {
        //this call back function its return the data from paymob and we show the full response and we checked if hmac is correct means successfull payment
        $data = $request->all();
        ksort($data);
        $hmac = $data['hmac'];
        $array = [
            'amount_cents',
            'created_at',
            'currency',
            'error_occured',
            'has_parent_transaction',
            'id',
            'integration_id',
            'is_3d_secure',
            'is_auth',
            'is_capture',
            'is_refunded',
            'is_standalone_payment',
            'is_voided',
            'order',
            'owner',
            'pending',
            'source_data_pan',
            'source_data_sub_type',
            'source_data_type',
            'success',
        ];
        $connectedString = '';
        foreach ($data as $key => $element) {
            if (in_array($key, $array)) {
                $connectedString .= $element;
            }
        }
        $secret = env('PAYMOB_HMAC');
        $hased = hash_hmac('sha512', $connectedString, $secret);
        if ($hased == $hmac) {
            //this below data used to get the last order created by the customer and check if its exists to 
            // $todayDate = Carbon::now();
            // $datas = Order::where('user_id',Auth::user()->id)->whereDate('created_at',$todayDate)->orderBy('created_at','desc')->first();
            $status = $data['success'];
            // $pending = $data['pending'];

            if ($status == "true") {
                 $transaction_id = $data['order'];
                  $totalAmount = $data['amount_cents'] / 100;
                $paymentRequest = $this->paymentRequest->where('transaction_id',$transaction_id)->first();
                 $paymentRequest->update(['state'=>'Approve']);
                $paymentRequest->chapters_order()->update(['state'=> 1]);
                 $paymentRequest->chapters_order;
                // Mail::to('wegotores@gmail.com')->send(new PaymentMail($data));
              
                //here we checked that the success payment is true and we updated the data base and empty the cart and redirct the customer to thankyou page

                $redirectUrl = route('student');;
                   $message = 'Your payment is being processed. Please wait...';
                   $timer = 5; // 3  seconds
                $totalAmount = $data['amount_cents'] / 100;
              return view('Student.Payment.paymentSuccess',
              compact('paymentRequest','totalAmount','message','data','redirectUrl','timer'));
            //    return redirect()->away($redirectUrl . '?' . http_build_query([
            //    'success' => true,
            //    'payment_id' => $payment_id,
            //    'total_amount' => $totalAmount,
            //    "alert('payment Success')"
            //    ]));
            } else {
                    $transaction_id = $data['order'];
                      $paymentRequest = $this->paymentRequest->where('transaction_id',$transaction_id)->first();
                      $paymentRequest->update(['state'=>'Rejected']);
                      
                       $redirectUrl = route('student');;
                       $message = 'Your payment is Failed. Please try again...';
                       $timer = 3; // 3 seconds
                       $totalAmount = $data['amount_cents'] / 100;
                       return view('Student.Payment.paymentSuccess',
                       compact('paymentRequest','totalAmount','message','redirectUrl','timer','data'));

            }
        } else {
            return response()->json(['message' => 'Something Went Wrong Please Try Again']);
        }
    } 
}
