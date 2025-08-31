<?php

namespace App\Http\Controllers\Api\Parent\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\PaymentRequest;

class PaymentController extends Controller
{
    public function __construct(private PaymentRequest $payment_request){}

    public function history(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id', 
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $history = $this->payment_request
        ->where('user_id', $request->user_id)
        ->orderByDesc('id')
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'date' => $item->created_at->format('Y-m-d'),
                'payment_method' => $item?->payment_method?->payment ?? 'Wallet',
                'student' => $item?->user?->nick_name,
                'price' => $item->price,
                'service' => $item->module,
                'status' => $item->state,
            ];
        });

        return response()->json([
            'payments' => $history
        ]);
    }

    public function invoic(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id', 
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        
        $history = $this->payment_request
        ->where('user_id', $request->user_id)
		->where('id', $id)
        ->with('payment_method', 'first_package_order.package.course.category',
        'chapters_order.chapter.course')
        ->orderByDesc('id')
        ->first();
		
        $invoice = [
            'receipt' => $history->image_link,
            'service' => $history->module, 
            'payment_method' => $history?->payment_method?->payment ?? 'Wallet',
            'total' => $history->price, 
        ];
        if($history->module == 'Package'){
            $invoice['package'] = $history?->first_package_order?->package?->name;
            $invoice['category'] = $history?->first_package_order?->package?->course?->category?->cate_name;
            $invoice['course'] = $history?->first_package_order?->package?->course?->course_name;
            $invoice['chapters'] = null;
        }
        else{
            $chapters = $history?->chapters_order && $history?->chapters_order?->count() > 0 ?true : false;
            $invoice['package'] = null;
            $invoice['category'] = $chapters ? $history?->chapters_order[0]?->chapter?->course?->category?->cate_name : null;
            $invoice['chapters'] = $history?->chapters_order?->pluck('chapter.chapter_name');
            $invoice['course'] = $chapters ? $history?->chapters_order[0]?->chapter?->course?->course_name : null;
        }

        return response()->json([
            'invoice' => $invoice
        ]);
    }
}
