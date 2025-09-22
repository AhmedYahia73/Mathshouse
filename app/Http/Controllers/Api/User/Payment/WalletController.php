<?php

namespace App\Http\Controllers\Api\User\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\trait\Image;

use App\Models\Wallet;
use App\Models\PaymentMethod;

class WalletController extends Controller
{
    public function __construct(private PaymentMethod $payment_method,
    private Wallet $wallet){
    }
    use Image;

    public function history(){
        $wallets = $this->wallet
        ->where('student_id', auth()->user()->id)
        ->where('wallet', '>', 0)
        ->orderByDesc('id')
        ->get()
        ->map(function($item){
            return [
                'wallet' => $item->wallet,
                'date' => $item->date,
                'state' => $item->state,
                'payment_method' => $item?->method?->payment,
                'rejected_reason' => $item->rejected_reason,
            ];
        });
        $money = $this->wallet
        ->where('student_id', auth()->user()->id)
        ->orderByDesc('id')
        ->where('state', 'Approve')
        ->sum('wallet');
        $payment_methods = $this->payment_method
        ->where('statue', 1)
        ->get();

        return response()->json([
            'wallet_history' => $wallets,
            'money' => $money,
            'payment_methods' => $payment_methods,
        ]);
    }

    public function recharge(Request $request){
        $validator = Validator::make($request->all(), [
            'wallet' => 'required|numeric',
            'payment_method_id' => 'required|exists:payment_method,id',  
            'image' => 'sometimes',  
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $walletRequest = [
            'student_id' => auth()->user()->id,
            'wallet' => $request->wallet,
            'date' => now(),
            'state' => 'Pendding',
            'payment_method_id' => $request->payment_method_id,
        ];
 
        $image_path = $this->store_base64($request->image, 'images/wallet');
        $walletRequest['image'] = $image_path;
        Wallet::create($walletRequest);

        return response()->json([
            'success' => 'You charge wallet success'
        ]);
    }
}
