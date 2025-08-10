<?php

namespace App\Http\Controllers\Api\User\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PaymentRequest;

class PaymentHistoryController extends Controller
{
    public function __construct(private PaymentRequest $payment_request){}

    public function history(){
        $history = $this->payment_request
        ->where('user_id', auth()->user()->id)
        ->orderByDesc('id')
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'date' => $item->created_at->format('Y-m-d'),
                'payment_method' => $item?->payment_method?->payment ?? 'Wallet',
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
        
        $history = $this->payment_request
        ->where('user_id', auth()->user()->id)
        ->with('payment_method', 'package_order.package.course.category',
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
            $invoice['package'] = $history?->package_order?->package?->name;
            $invoice['category'] = $history?->package_order?->package?->course?->category?->cate_name;
            $invoice['course'] = $history?->package_order?->package?->course?->course_name;
            $invoice['chapters'] = null;
        }
        else{
            $chapters = $history?->chapters_order?->chapter && $history?->chapters_order?->chapter->count() > 0 ?true : false;
            $invoice['package'] = null;
            $invoice['category'] = $chapters ? $history?->chapters_order?->chapter[0]?->course?->category?->cate_name : null;
            $invoice['chapters'] = $history?->chapters_order?->chapter?->pluck('chapter_name');
            $invoice['course'] = $chapters ? $history?->chapters_order?->chapter[0]?->course?->course_name : null;
        }

        return response()->json([
            'invoice' => $invoice
        ]);
    }
}
