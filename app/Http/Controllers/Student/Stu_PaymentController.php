<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PaymentRequest;
use App\Models\PaymentOrder;
use App\Models\PaymentPackageOrder;

class Stu_PaymentController extends Controller
{
    
    public function stu_payment_history( Request $req ){
        $data = $req->all();
        if ( !empty($req->state) ) {
            $payments = PaymentRequest::
            where('user_id', auth()->user()->id)
            ->where('state', $req->state)
            ->orderByDesc('id')
            ->simplePaginate(10);
        }
        else {
            $payments = PaymentRequest::
            where('user_id', auth()->user()->id)
            ->orderByDesc('id')
            ->simplePaginate(10);
        }

        return view('Student.Payment.History', compact('payments', 'data'));
    }

    public function payment_filter( Request $req ){
        $payments = PaymentRequest::
        where('user_id', auth()->user()->id)
        ->where('state', $req->state)
        ->orderByDesc('id')
        ->simplePaginate(10);

        return view('Student.Payment.History', compact('payments'));
    }

    public function payment_invoice( $id ){
        $payment = PaymentRequest::where('id', $id)
        ->first();
        $service = null;
        if ($payment->module == 'Chapters') {
            $service = PaymentOrder::
            where('payment_request_id', $payment->id)
            ->get();
        }
        elseif ($payment->module == 'Package') {
            $service = PaymentPackageOrder::
            where('payment_request_id', $payment->id)
            ->first();
        }

        return view('Student.Payment.Invoice', compact('payment', 'service'));
    }

}
