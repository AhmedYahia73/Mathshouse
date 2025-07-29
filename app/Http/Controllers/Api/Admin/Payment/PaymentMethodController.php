<?php

namespace App\Http\Controllers\Api\Admin\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function __construct(private PaymentMethod $payment_method){}

    public function view(Request $request){
        $payment_methods = $this->payment_method
        ->get();

        return response()->json([
            'payment_methods' => $payment_methods
        ]);
    }

    public function create(Request $request){
        
    }

    public function modify(Request $request, $id){
        
    }

    public function delete(Request $request, $id){
        
    }
}
