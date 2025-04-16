<?php

namespace App\service\order;

use App\Models\Chapter;
use App\Models\Payment;
use App\Models\Commission;
use App\service\ExpireDate;
use App\Models\PaymentRequest;
use App\Models\AffilateRequest;
use App\Models\PaymentOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Exceptions\HttpResponseException;

trait placeOrder
{
    protected $paymentRequest = ['payment_method_id', 'user_id', 'payment', 'price'];
    protected $orderRequest = ['user_id', 'cart'];
    protected $priceCycle;

    public function __construct(
        private PaymentRequest $payment,
        private Chapter $chapter,
    ) {}

    public function placeOrder($data, $user, $module, $commision)
    {
        $user_id = $user->id;
        $newPayment['user_id'] = $user_id;

        $orderItems = $data['items'];
        $price = $data['amount'];
        $paymentRequest = $data['paymentMethod'];
        $paymentRequest->first();

        $newPayment = [
            'payment_method_id' => $paymentRequest->id,
            'module' => $module,
            'price' => $price,
            'state' => 'in_progress',
            'user_id' => $user_id,
        ];

        try {
            $payment = $this->payment->create($newPayment);

            if (!empty(Cookie::get('affilate'))) {
                $commision = Commission::where('name', 'Chapter')
                    ->where('user_id', floatval(Cookie::get('affilate')))
                    ->where('state', 1)
                    ->first();
                $commision = empty($commision) ? 0 : $commision->precentage;
                $price = $price * $commision / 100;
                AffilateRequest::create([
                    'affilate_id' => floatval(Cookie::get('affilate')),
                    'service' => $module,
                    'earned' => $commision,
                    'payment_req_id' => $payment->id
                ]);
            }
        } catch (\Throwable $th) {
            throw new HttpResponseException(response()->json(['error' => 'Payment processing failed'], 500));
        }

        $cart = $orderItems ?? null;
        if (isset($cart['Course']) || isset($cart['Chapters'])) {
            $order = $this->createOrdersForItems($orderItems, $payment, $price, $module);
        }

        try {
            // Additional processing if needed
        } catch (\Throwable $th) {
            throw new HttpResponseException(response()->json(['error' => 'Order processing failed'], 500));
        }

        return [
            'payment' => $payment,
            'orderItems' => $order,
        ];
    }

    private function createOrdersForItems($orderItems, $payment, $price, $service)
    {
        $cart = $orderItems ?? null;
        $orderData = [];
        $totalPaymentPrice = $price;
        if (isset($cart['Course'])) {
            $course = $cart['Course'];
            $chapters = $this->chapter->where('course_id', $course->id)->get();
            $duration = $this->courseDuration($course, $price, $service);

            foreach ($chapters as $chapter) {
                $chapterOrder = $chapter->paymentOrder()->create([
                    'payment_request_id' => $payment->id,
                    'chapter_id' => $chapter->id,
                    'duration' => $duration,
                    'state' => 0
                ]);
                $orderData[] = [
                    'name' => $chapter->chapter_name,
                    'amount_cents' => $price,
                    'description' => "Total Price Is $price And Services Is $service",
                    'quantity' => 1,
                ];
            }

            return [
                'items' => $orderData,
                'total' => floatval($price)
            ];
        }

        if (isset($cart['Chapters'])) {
            $chapters = $cart['Chapters'];
            $duration = $this->courseDuration($chapters, $price, $service);
            $totalPrice = 0;

           foreach ($chapters as $chapter) {
                 $chapters; 
            $chapterCurrencyCeck = $this->checkCurrency($chapters, $payment);
                if($chapterCurrencyCeck === false){
                    session()->flash('faild', 'Some Chapter Don\'t Have Same Currency Of Payment Method');
                    return redirect()->back();
                }else{
           foreach ($chapter->price as $price) {
           $duration = $price->duration;
           $itemPrice = $price->price;
           }
           
           $chapterOrder = PaymentOrder::create([
           'chapter_id' => $chapter->id,
           'payment_request_id' => $payment->id,
           'duration' => $duration ?? 0, // Default to 0 if not set
           'state' => 0
           ]);
}
           $orderData[] = [
           'name' => $chapter->chapter_name,
           'amount_cents' => $itemPrice ?? 0,
           'description' => "Total Price Is " . ($price->price ?? 0) . " And Services Is $service and Duration Is " .
           ($duration ?? 'N/A'),
           'quantity' => 1,
           ];
           }

            return [
                'items' => $orderData,
                'total' => floatval($totalPaymentPrice)
            ];
        }

        return response()->json(['message' => 'No course found in the cart.'], 400);
    }
    public  function checkCurrency($chapters,$payment){
        foreach($chapters as $chapter){
            $checkCurrency = $payment->payment_method->payment_currancies->contains($chapter->currancy_id);
            if($checkCurrency === false){
                return false;
            }else{
                return true;
            }
        }
        
    }
    public function courseDuration($models, $price, $service)
    {
        if ($service == 'Course') {
            foreach ($models->prices as $item) {
                if ($item->price == $price) {
                    return $item->duration;
                }
            }
        }

        if ($service == 'Chapters') {
            foreach ($models as $item) {
                if ($item->price == $price) {
                    return $item->duration;
                }
            }
        }

        return false;
    }

    public function payment_approve($payment)
    {
        if ($payment) {
            $payment->update(['status' => 'approved']);
            return true;
        }
        return false;
    }

    public function order_success($payment)
    {
        $payment_approved = $this->payment_approve($payment);
        $orders = $payment->orders;
        $user = $payment->user;

        $domainIds = $orders->whereNotNull('domain_id')->pluck('domain_id', 'price_cycle')->unique();
        $extraIds = $orders->whereNotNull('extra_id')->pluck('extra_id', 'price_cycle')->unique();
        $planIds = $orders->whereNotNull('plan_id')->pluck('plan_id')->unique();
        $plan_price_cycle = $orders->whereNotNull('price_cycle')->pluck('price_cycle')->unique();

        if ($domainIds->isNotEmpty()) {
            $date = now();
            $renueDate = $date->addYear();
            $this->domain->whereIn('id', $domainIds)->update(['price_status' => true, 'renewdate' => $renueDate]);
        }

        if ($planIds->isNotEmpty()) {
            $expireDate = $this->getExpireDateTime($plan_price_cycle, now());
            $packate_cycle = $this->package_cycle($plan_price_cycle, now());
            foreach ($planIds as $key => $plan_id) {
                $user->update([
                    'plan_id' => $plan_id,
                    'expire_date' => $expireDate,
                    'package' => $packate_cycle,
                ]);
            }
        }

        foreach ($orders as $order) {
            $priceCycle = $order->price_cycle;
            $expireDate = $this->getOrderDateExpire($priceCycle, now());
            $order->update(['expire_date' => $expireDate]);
        }

        $domains = $domainIds->isNotEmpty() ? $this->domain->whereIn('id', $domainIds)->get()->keyBy('id') : collect();
        $extras = $extraIds->isNotEmpty() ? $this->extra->whereIn('id', $extraIds)->get()->keyBy('id') : collect();
        $plans = $planIds->isNotEmpty() ? $this->plan->whereIn('id', $planIds)->get()->keyBy('id') : collect();

        $createdOrders = $orders->map(function ($order) use ($domains, $extras, $plans) {
            $newService = [];

            if ($order->domain_id !== null) {
                $newService['domain'] = $domains->find($order->domain_id);
            }
            if ($order->extra_id !== null) {
                $newService['extra'] = $extras->find($order->extra_id);
            }
            if ($order->plan_id !== null) {
                $newService['plan'] = $plans->find($order->plan_id);
            }

            return $newService;
        });

        return $orders;
    }
}
