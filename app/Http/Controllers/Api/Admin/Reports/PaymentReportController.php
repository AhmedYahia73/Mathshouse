<?php

namespace App\Http\Controllers\Api\Admin\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\PaymentRequest;

class PaymentReportController extends Controller
{
    public function __construct(private PaymentRequest $payment_request){}

    public function view(Request $request){
        $payment = PaymentRequest::
        where('state', 'Approve')
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'f_name' => $item?->user?->f_name,
                'l_name' => $item?->user?->l_name,
                'nick_name' => $item?->user?->nick_name,
                'type' => $item->module,
                'price' => $item->price,
                'user_id' => $item->user_id,
            ];
        });

        return response()->json([
            'payments' => $payment,
            'total_payments' => $payment->sum('price'),
            'payments' => $payment->unique('user_id')->count(),
        ]);
    }

    public function filter(Request $request){
        $validator = Validator::make($request->all(), [
            'from' => ['sometimes'], 
            'to' => ['sometimes'], 
        ]);
        if ($validator->fails()) { 
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        $payment = PaymentRequest::
        where('state', 'Approve');
        if($request->from){
            $payment = $payment
            ->where('created_at', '>=', $req->from);
        }
        if($request->to){
            $payment = $payment
            ->where('created_at', '<=', $req->to);
        }
        $payment = $payment->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'f_name' => $item?->user?->f_name,
                'l_name' => $item?->user?->l_name,
                'nick_name' => $item?->user?->nick_name,
                'type' => $item->module,
                'price' => $item->price,
                'user_id' => $item->user_id,
            ];
        });

        return response()->json([
            'payments' => $payment,
            'total_payments' => $payment->sum('price'),
            'payments' => $payment->unique('user_id')->count(),
        ]);
    }
}
