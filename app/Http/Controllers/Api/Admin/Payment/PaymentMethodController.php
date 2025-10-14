<?php

namespace App\Http\Controllers\Api\Admin\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\trait\Image;

use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function __construct(private PaymentMethod $payment_method){}
    use Image;

    public function view(Request $request){
        $payment_methods = $this->payment_method
        ->select('id', 'payment', 'description', 'logo', 'statue')
        ->get();

        return response()->json([
            'payment_methods' => $payment_methods
        ]);
    }

    public function status(Request $request, $id){
        $payment_methods = $this->payment_method
        ->where('id', $id)
        ->update([
            'statue' => $request->statue
        ]);

        return response()->json([
            'success' => 'You update status success'
        ]);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'payment' => ['required'],
            'description' => ['required'],
            'logo' => ['required'],
            'statue' => ['required'],
        ]);
        if ($validator->fails()) { 
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        
        $paymentRequest = [
            'payment' => $request->payment,
            'description' => $request->description,
            'statue' => $request->statue, 
        ];
        if ($request->logo) {
            $image_path = $this->store_base64($request->logo, 'images/payment');
            $paymentRequest['logo'] = $image_path;
        }

        $this->payment_method
        ->create($paymentRequest);

        return response()->json([
            'success' => 'You add data success'
        ]);
    }

    public function modify(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'payment' => ['nullable'],
            'description' => ['nullable'],
            'logo' => ['nullable'],
            'statue' => ['nullable'],
        ]);
        if ($validator->fails()) { 
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        
        $payment_method = $this->payment_method
        ->where('id', $id)
        ->first();
        $paymentRequest = [
            'payment' => $request->payment ?? $payment_method->payment,
            'description' => $request->description ?? $payment_method->description,
            'statue' => $request->statue ?? $payment_method->statue, 
        ];
        if ($request->logo && !empty($request->logo)) {
            $image_path = $this->store_base64($request->logo, 'images/payment');
            $paymentRequest['logo'] = $image_path;
            $this->delete_image('images/payment', $payment_method->logo);
        }

        $payment_method
        ->update($paymentRequest);

        return response()->json([
            'success' => 'You update data success'
        ]);
    }

    public function delete(Request $request, $id){
        $payment_method = $this->payment_method
        ->where('id', $id)
        ->where('id', '!=', 10)
        ->where('id', '!=', 42)
        ->delete(); 

        return response()->json([
            'success' => 'You delete data success'
        ]);
    }
}
