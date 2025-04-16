<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PaymentRequest;
use App\Models\PaymentOrder;
use App\Models\PaymentPackageOrder;
use App\Models\User;
use App\Models\Wallet;
use App\Models\AffilateRequest;
use App\Models\Affilate;
use App\Models\AffilateService;

class PaymentRequestController extends Controller
{

    public function payment_request(){
        $payment = PaymentRequest::
        where('state', '!=', 'Pendding')
        ->orderByDesc('id')
        ->simplePaginate(10);
        
        return view('Admin.Payment_Request.Payment_Request', compact('payment'));
    }

    public function payment_material( $id ){
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

        return view('Admin.Payment_Request.Invoice', compact('payment', 'service'));
    }

    public function filter_payment_req( Request $req ){
         
        $payment = PaymentRequest::
        where('state', '!=', 'Pendding')
        ->where('payment_method_id', '!=', null)
        ->orderByDesc('id')
        ->simplePaginate(10); 
        
        if ( !empty($req->from) && empty($req->to) && empty($req->state) ) {
            $payment = PaymentRequest::
            where('state', '!=', 'Pendding')
            ->where('payment_method_id', '!=', null)
            ->where('created_at', '>=', $req->from)
            ->orderByDesc('id')
            ->simplePaginate(10);
        }
        elseif ( empty($req->from) && !empty($req->to) && empty($req->state) ) {
            $payment = PaymentRequest::
            where('state', '!=', 'Pendding')
            ->where('payment_method_id', '!=', null)
            ->where('created_at', '<=', $req->to)
            ->orderByDesc('id')
            ->simplePaginate(10);
        }
        elseif ( !empty($req->from) && !empty($req->to) && empty($req->state) ) {
            $payment = PaymentRequest::
            where('state', '!=', 'Pendding')
            ->where('payment_method_id', '!=', null)
            ->where('created_at', '>=', $req->from)
            ->where('created_at', '<=', $req->to)
            ->orderByDesc('id')
            ->simplePaginate(10); 
        }
        elseif ( !empty($req->from) && empty($req->to) && !empty($req->state) ) {
            $payment = PaymentRequest::
            where('state', '!=', 'Pendding')
            ->where('payment_method_id', '!=', null)
            ->where('created_at', '>=', $req->from)
            ->where('state', $req->state)
            ->orderByDesc('id')
            ->simplePaginate(10);
        }
        elseif ( empty($req->from) && !empty($req->to) && !empty($req->state) ) {
            $payment = PaymentRequest::
            where('state', '!=', 'Pendding')
            ->where('payment_method_id', '!=', null)
            ->where('created_at', '<=', $req->to)
            ->where('state', $req->state)
            ->orderByDesc('id')
            ->simplePaginate(10);
        }
        elseif ( !empty($req->from) && !empty($req->to) && !empty($req->state) ) {
            $payment = PaymentRequest::
            where('state', '!=', 'Pendding')
            ->where('payment_method_id', '!=', null)
            ->where('created_at', '>=', $req->from)
            ->where('created_at', '<=', $req->to)
            ->where('state', $req->state)
            ->orderByDesc('id')
            ->simplePaginate(10); 
        }
        elseif ( empty($req->from) && empty($req->to) && !empty($req->state) ) {
            $payment = PaymentRequest::
            where('state', '!=', 'Pendding')
            ->where('payment_method_id', '!=', null)
            ->where('state', $req->state)
            ->orderByDesc('id')
            ->simplePaginate(10); 
        }
        $data = $req->all();
        return view('Admin.Payment_Request.Payment_Request', compact('payment', 'data'));
    }

    public function filter_pendding_payment( Request $req ){
        
        $payment = PaymentRequest::
        where('state', 'Pendding')
        ->where('payment_method_id', '!=', null)
        ->orderByDesc('id')
        ->simplePaginate(10); 
        
        if ( !empty($req->from) && empty($req->to) ) {
            $payment = PaymentRequest::
            where('state', 'Pendding')
            ->where('payment_method_id', '!=', null)
            ->where('created_at', '>=', $req->from)
            ->orderByDesc('id')
            ->simplePaginate(10);
        }
        elseif ( empty($req->from) && !empty($req->to) ) {
            $payment = PaymentRequest::
            where('state', 'Pendding')
            ->where('payment_method_id', '!=', null)
            ->where('created_at', '<=', $req->to)
            ->orderByDesc('id')
            ->simplePaginate(10);
        }
        elseif ( !empty($req->from) && !empty($req->to) ) {
            $payment = PaymentRequest::
            where('state', 'Pendding')
            ->where('payment_method_id', '!=', null)
            ->where('created_at', '>=', $req->from)
            ->where('created_at', '<=', $req->to)
            ->orderByDesc('id')
            ->simplePaginate(10); 
        }
        $data = $req->all();

        return view('Admin.Payment_Request.Pendding_Payment', compact('payment', 'data'));
    }

    public function pendding_payment(){
        $payment = PaymentRequest::
        where('state', 'Pendding')
        ->where('payment_method_id', '!=', null)
        ->orderByDesc('id')
        ->simplePaginate(10);
        
        return view('Admin.Payment_Request.Pendding_Payment', compact('payment'));
    }

    public function wallet_pendding(){
        $wallets = Wallet::where('wallet', '>', '0')
        ->where('state', 'Pendding')
        ->orderByDesc('id')
        ->simplePaginate(10);

        return view('Admin.Payment_Request.Pendding_Wallet', compact('wallets'));
    }

    public function wallet_history(){
        $wallets = Wallet::where('wallet', '>', '0')
        ->where('state', '!=', 'Pendding')
        ->orderByDesc('id')
        ->simplePaginate(10);

        return view('Admin.Payment_Request.Wallet_History', compact('wallets'));
    }

    public function filter_wallet_history( Request $req ){
        $wallets = Wallet::where('wallet', '>', '0')
        ->where('state', '!=', 'Pendding')
        ->orderByDesc('id')
        ->simplePaginate(10);
        
        if ( !empty($req->from) && empty($req->to) ) {
            $wallets = Wallet::where('wallet', '>', '0')
            ->where('state', '!=', 'Pendding')
            ->where('date', '>=', $req->from)
            ->orderByDesc('id')
            ->simplePaginate(10);
        }
        elseif ( empty($req->from) && !empty($req->to) ) {
            $wallets = Wallet::where('wallet', '>', '0')
            ->where('state', '!=', 'Pendding')
            ->where('date', '<=', $req->to)
            ->orderByDesc('id')
            ->simplePaginate(10);
        }
        elseif ( !empty($req->from) && !empty($req->to) ) {
            $wallets = Wallet::where('wallet', '>', '0')
            ->where('state', '!=', 'Pendding')
            ->where('date', '>=', $req->from)
            ->where('date', '<=', $req->to)
            ->orderByDesc('id')
            ->simplePaginate(10);
        }
        $data = $req->all();

        return view('Admin.Payment_Request.Wallet_History', compact('wallets', 'data'));
    }

    public function approve_wallet( $id ){
        Wallet::
        where('id', $id)
        ->update(['state' => 'Approve']);

        return redirect()->back();
    }

    public function rejected_wallet( $id, Request $req ){
        Wallet::
        where('id', $id)
        ->update(['state' => 'Rejected',
        'rejected_reason' => $req->rejected_reason ]);

        return redirect()->back();
    }

    public function filter_pendding_wallet( Request $req ){
        $wallets = Wallet::where('wallet', '>', '0')
        ->where('state', 'Pendding')
        ->orderByDesc('id')
        ->simplePaginate(10);
        
        if ( !empty($req->from) && empty($req->to) ) {
            $wallets = Wallet::where('wallet', '>', '0')
            ->where('state', 'Pendding')
            ->where('date', '>=', $req->from)
            ->orderByDesc('id')
            ->simplePaginate(10);
        }
        elseif ( empty($req->from) && !empty($req->to) ) {
            $wallets = Wallet::where('wallet', '>', '0')
            ->where('state', 'Pendding')
            ->where('date', '<=', $req->to)
            ->orderByDesc('id')
            ->simplePaginate(10);
        }
        elseif ( !empty($req->from) && !empty($req->to) ) {
            $wallets = Wallet::where('wallet', '>', '0')
            ->where('state', 'Pendding')
            ->where('date', '>=', $req->from)
            ->where('date', '<=', $req->to)
            ->orderByDesc('id')
            ->simplePaginate(10);
        }
        $data = $req->all();

        return view('Admin.Payment_Request.Pendding_Wallet', compact('wallets', 'data'));
    }

    public function approve_payment( $id ){
        PaymentRequest::
        where('id', $id)
        ->update(['state' => 'Approve']);

        $aff_req = AffilateRequest::
        where('payment_req_id', $id)
        ->first();

        if ( !empty($aff_req) ) {
            AffilateService::create([
                'affilate_id' => $aff_req->affilate_id,
                'service' => $aff_req->service,
                'earned' => $aff_req->earned,
            ]);

            $aff_wallet = Affilate::where('id', $aff_req->affilate_id)->first()->wallet;
            Affilate::where('id', $aff_req->affilate_id)
            ->update(['wallet' => $aff_wallet + $aff_req->earned]);
        }

        $payment = PaymentRequest::
        where('id', $id)
        ->first();
        if ( $payment->module == 'Chapters' ) {
            PaymentOrder::where('payment_request_id', $id)
            ->update([
                'state' => 1,
                'date' => now(),
            ]);
        } else {
            PaymentPackageOrder::where('payment_request_id', $id)
            ->update([
                'state' => 1,
                'date' => now(),
            ]);
            
            $payment_package_order = PaymentPackageOrder::where('payment_request_id', $id)
            ->with('package')
            ->first();
            
            $number = $payment_package_order->package->number;
             

        }
        

        return redirect()->back();
    }

    public function rejected_payment( $id, Request $req ){
        PaymentRequest::
        where('id', $id)
        ->update(['state' => 'Rejected',
                'rejected_reason' => $req->rejected_reason]);

        return redirect()->back();
    }

}
