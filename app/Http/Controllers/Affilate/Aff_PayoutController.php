<?php

namespace App\Http\Controllers\Affilate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Affilate;
use App\Models\PaymentMethod;
use App\Models\Payout;

class Aff_PayoutController extends Controller
{
    
    public function index(){
        $affilate = Affilate::where('user_id', auth()->user()->id)
        ->first();
        $payment_method = PaymentMethod::all();

        return view('Affilate.Payout.Payout', compact('affilate', 'payment_method'));
    }

    public function aff_add_payout_req( Request $req ){
        $affilate = Affilate::where('user_id', auth()->user()->id)
        ->first();
        if ( $affilate->wallet < $req->amount ) {
            session()->flash('faild','Amount Is Bigger Than Wallet');
            return redirect()->back();
        }
        if ( empty($req->payment_method) ) {
            session()->flash('faild','You must determine payment method');
            return redirect()->back();
        }
        Payout::create([
            'amount' => $req->amount,
            'payment_method' => $req->payment_method,
            'date' => now(),
            'affilate_id' => $affilate->id,
        ]);

        return redirect()->back();
    }

}
