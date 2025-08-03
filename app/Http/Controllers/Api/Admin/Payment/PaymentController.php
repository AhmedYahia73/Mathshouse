<?php

namespace App\Http\Controllers\Api\Admin\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PaymentRequest;

class PaymentController extends Controller
{
    public function __construct(private PaymentRequest $payment_request){}

    public function payment_request(Request $request){
        $pending_payment_request = $this->payment_request
        ->where('state', 'Pendding')
        ->with('payment_method', 'user')
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'payment_method' => $item?->payment_method?->payment,
                'service' => $item->module,
                'price' => $item->price,
                'receipt' => $item->image_link,
                'date' => $item->created_at->format('Y-m-d'),
            ];
        });
        $payment_request_history = $this->payment_request
        ->where('state', '!=', 'Pendding')
        ->with('payment_method', 'user')
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'payment_method' => $item?->payment_method?->payment,
                'service' => $item->module,
                'price' => $item->price,
                'receipt' => $item->image_link,
                'date' => $item->created_at->format('Y-m-d'),
            ];
        });

        return response()->json([
            'pending_payment_request' => $pending_payment_request,
            'payment_request_history' => $payment_request_history,
        ]);
    }
}
