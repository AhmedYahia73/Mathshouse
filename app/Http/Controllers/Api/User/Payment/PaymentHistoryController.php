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
