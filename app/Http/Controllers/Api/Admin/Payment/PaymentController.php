<?php

namespace App\Http\Controllers\Api\Admin\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\PaymentRequest;
use App\Models\AffilateRequest;
use App\Models\AffilateService;
use App\Models\Affilate;
use App\Models\Wallet;
use App\Models\PaymentOrder;
use App\Models\PaymentPackageOrder;

class PaymentController extends Controller
{
    public function __construct(private PaymentRequest $payment_request,
    private Wallet $wallet, private AffilateRequest $affilate_request,
    private AffilateService $affilate_service, private Affilate $affilate,
    private PaymentOrder $payment_order, private PaymentPackageOrder $payment_package_order){}

    public function payment_request(Request $request){
        $pending_payment_request = $this->payment_request
        ->where('state', 'Pendding')
        ->with('payment_method', 'user')
        ->orderByDesc('updated_at')
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
        ->orderByDesc('updated_at')
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'payment_method' => $item?->payment_method?->payment,
                'service' => $item->module,
                'price' => $item->price,
                'receipt' => $item->image_link,
                'date' => $item->created_at->format('Y-m-d'),
                'rejected_reason' => $item->rejected_reason,
            ];
        });

        return response()->json([
            'pending_payment_request' => $pending_payment_request,
            'pending_payment_request_count' => $pending_payment_request->count(),
            'payment_request_history' => $payment_request_history,
        ]);
    }

    public function reject_request(Request $request, $id){
       $validator = Validator::make($request->all(), [
            'rejected_reason' => ['required'], 
        ]);
        if ($validator->fails()) { 
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $this->payment_request
        ->where('id', $id)
        ->update([
            'rejected_reason' => $request->rejected_reason,
            'state' => 'Rejected',
        ]);

        return response()->json([
            'success' => 'You update status success'
        ]);
    }

    public function approve_request(Request $request, $id){
        $this->payment_request
        ->where('id', $id)
        ->update([ 
            'state' => 'Approve',
        ]);

        $aff_req = $this->affilate_request
        ->where('payment_req_id', $id)
        ->first();

        if ( !empty($aff_req) ) {
            $this->affilate_service
            ->create([
                'affilate_id' => $aff_req->affilate_id,
                'service' => $aff_req->service,
                'earned' => $aff_req->earned,
            ]);

            $aff_wallet = $this->affilate
            ->where('id', $aff_req->affilate_id)->first()->wallet;
            $this->affilatee
            ->where('id', $aff_req->affilate_id)
            ->update(['wallet' => $aff_wallet + $aff_req->earned]);
        }

        $payment = $this->payment_request
        ->where('id', $id)
        ->first();
        if ( $payment->module == 'Chapters' ) {
            $this->payment_order
            ->where('payment_request_id', $id)
            ->update([
                'state' => 1,
                'date' => now(),
            ]);
        } else {
            $this->payment_package_order
            ->where('payment_request_id', $id)
            ->update([
                'state' => 1,
                'date' => now(),
            ]);
            
            $payment_package_order = $this->payment_package_order
            ->where('payment_request_id', $id)
            ->with('package')
            ->first();
            
            $number = $payment_package_order?->package?->number ?? 0;
        }

        return response()->json([
            'success' => 'You update status success'
        ]);
    }

    public function wallet(Request $request){
        $wallet = $this->wallet
        ->where('wallet', '>', '0')
        ->orderByDesc('updated_at')
        ->orderByDesc('id')
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'rejected_reason' => $item->rejected_reason,
                'wallet' => $item->wallet,
                'date' => $item->date,
                'payment_method_id' => $item?->method?->payment,
                'image' => $item->image_link,
                'currency' => $item->currency,
                'student' => $item?->student?->nick_name,
                'state' => $item->state, 
                'updated_at' => $item->updated_at
            ];
        });
        $pending_wallet = $wallet->where('state', 'Pendding')
        ->values();
        $history_wallet = $wallet->where('state', '!=' ,'Pendding') 
        ->sortByDesc('updated_at')
        ->values();

        return response()->json([
            'pending_wallet' => $pending_wallet,
            'history_wallet' => $history_wallet,
        ]);
    }

    public function approve_wallet(Request $request, $id){
        $this->wallet
        ->where('id', $id)
        ->update(['state' => 'Approve']);

        return response()->json([
            'success' => 'You approve wallet success'
        ]);
    }

    public function rejected_wallet( $id, Request $request ){
       $validator = Validator::make($request->all(), [
            'rejected_reason' => ['required'], 
        ]);
        if ($validator->fails()) { 
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        
        $wallet = $this->wallet
        ->where('id', $id)
        ->update(['state' => 'Rejected',
        'rejected_reason' => $request->rejected_reason ]);

        return response()->json([
            'success' => 'You reject wallet success'
        ]);
    }
}
