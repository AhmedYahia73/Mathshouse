<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currancy;
use Illuminate\Http\Request;

use App\Models\PaymentMethod;

class PaymentController extends Controller
{
    public function __construct(private Currancy $currancy){}
    public function payment(){
        $payments = PaymentMethod::
        with('payment_currancies')->orderByDesc('id')
        ->simplePaginate(10);
        $currancies = Currancy::orderByDesc('id')->get();
        return view('Admin.Payment.Payment', 
        compact('payments','currancies'));
    }

    public function payment_add( Request $req ){
        $currancies = $req->currancy; // Start Get Currancies References To This Payment
        $img_name = null;
        $arr = $req->only('payment', 'statue', 'description');
        $req->validate([
            'payment' => 'required',
        ]);
        extract($_FILES['logo']);
        if ( !empty($name) ) {
            $img_name = now() . rand(1, 10000) . $name;
            $img_name = str_replace([':', '-', ' '], 'X', $img_name);
            $arr['logo'] = $img_name;
        }
        $paymentMethod = PaymentMethod::create($arr);
         $paymentMethod->payment_currancies()->sync($currancies);
        move_uploaded_file($tmp_name, 'images/payment/' . $img_name);

        return redirect()->back();
    }

    public function del_payment( Request $req ){
        PaymentMethod::where('id', $req->id)
        ->delete();

        return redirect()->back();
    }

    public function payment_edit( Request $req ){
        $img_name = null;
        $arr = $req->only('payment', 'description','currency_id');
        $req->validate([
            'payment' => 'required',
        ]);
        
        $arr['statue'] = isset($req->statue) ? 1 : 0;
        extract($_FILES['logo']);
        if ( !empty($name) ) {
            $img_name = now() . rand(1, 10000) . $name;
            $img_name = str_replace([':', '-', ' '], 'X', $img_name);
            $arr['logo'] = $img_name;
        }
        $paymentMethod = PaymentMethod::findOrFail($req->id);
          $paymentMethod->update($arr);
        if(isset($req->currancy)){
            $currencies_id = $req->currancy;
            $paymentMethod->payment_currancies()->sync( $currencies_id);
        }
            
        move_uploaded_file($tmp_name, 'images/payment/' . $img_name);

        return redirect()->back();
    }

}
