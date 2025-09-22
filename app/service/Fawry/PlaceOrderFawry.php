<?php

namespace App\service\Fawry;

use App\Models\bundle;
use App\Models\subject;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\User;
use DragonCode\Contracts\Cashier\Config\Payments\Statuses;
use Error;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SignupNotificationMail;
use Illuminate\Http\Exceptions\HttpResponseException;

trait PlaceOrderFawry
{

     protected $orderPlaceReqeust =['chargeItems','amount','customerProfileId','payment_method_id','merchantRefNum'];
 // This Is Trait About Make any Order 
   

    public function placeOrder_fawry(Request $request ){
        
        $user = $request->user();
        $newOrder = $request->only($this->orderPlaceReqeust);
        $items = $newOrder['chargeItems'];
        
        // $user_id = $request->user()->id;
        $new_item = [];
        $service = $newOrder['chargeItems'][0]['description'];
        $amount = $newOrder['amount'];
        $paymentMethod = $this->payment_method->where('payment','Fawry')->first();
        $payment_method_id = $paymentMethod->id;
        if(!$paymentMethod){
            return abort(404);
        }
     
        foreach ($items as $item) {
                
            $itemId = $item['itemId'];
            // $item_type = $service == 'Bundle' ? 'bundle' : 'subject'; // iF Changed By Sevice Name Get Price One Of Them
            $item_type = $this->checkItemType($service);
            try {
            if($service == 'Wallet'){
                $paymentData = [
                    "merchantRefNum"=> $newOrder['merchantRefNum'],
                    "student_id"=> $newOrder['customerProfileId'],
                    "wallet"=> $newOrder['amount'], 
                    "date"=>now(),
                    "payment_method_id"=>$payment_method_id,
                    "image"=>'fawry.png',
                    'state' => 'Faild',
                ];
                $payment = $this->wallet
                ->create($paymentData);
                $payment_number = $payment->id;
            }elseif($service == 'Chapters'){
                $paymentData = [
                    "merchantRefNum"=> $newOrder['merchantRefNum'],
                    "user_id"=> $newOrder['customerProfileId'],
                    "price"=> $newOrder['amount'],
                    "module"=> $service,
                    "payment_method_id"=>$payment_method_id,
                    "image"=>'fawry.png',
                    'state' => 'Faild',
                ];
                $payment = $this->payment_request
                ->create($paymentData);
                $payment_number = $payment->id;
                $chapters_data = json_decode($item['itemId']);
                foreach($chapters_data as $item){
                    $this->payment_order
                    ->create([
                        'payment_request_id' => $payment->id,
                        'chapter_id' => $item['id'],
                        'duration' => $item['duration'],
                        'state' => 1,
                        'date' => now(),
                    ]);
                } 
            }
            elseif($service == 'Package'){
                $paymentData = [
                    "merchantRefNum"=> $newOrder['merchantRefNum'],
                    "user_id"=> $newOrder['customerProfileId'],
                    "price"=> $newOrder['amount'],
                    "module"=> $service,
                    "payment_method_id"=>$payment_method_id,
                    "image"=>'fawry.png',
                    'state' => 'Faild',
                ]; 
                $payment = $this->payment_request
                ->create($paymentData);
                $payment_number = $payment->id;
                $package_data = json_decode($item['itemId']);
                $package = $this->package
                ->where('id', $package_data['id'])
                ->first();
                $this->payment_package
                ->create([
                    'payment_request_id' => $payment->id,
                    'user_id' => auth()->user()->id,
                    'package_id' => $package_data['id'],
                    'state' => 1,
                    'date' => now(),
                    'number' => $package->number,
                ]);
            }
            } 
            catch (\Throwable $th) {
                return abort(code: 500);
            }
            $data = [
                'paymentProcess' => $payment_number,
                'chargeItems'=>[
                    'itemId'=> $itemId,
                    'description'=>$item_type,
                    'price'=>$amount,
                    'quantity'=>'1',
                ]
            ];
              
        }
        return $data ;
    }
    public function confirmOrder($response){
        if(isset($response['code']) && $response['code'] == 9901){
                return response()->json($response);
        }elseif(!isset($response['merchantRefNum'])){
           $response =  response()->json(['faield'=>'Merchant Reference Number Not Found'],404);
                return $response;
        }else{
            $merchantRefNum = $response['merchantRefNum'];
            $customerMerchantId = $response['customerMerchantId'];
            $orderStatus = $response['orderStatus'];
        }
        
        if($orderStatus == 'PAID'){
            $service = 'Chapters';
            $payment =
                $this->payment_request
                ->where('user_id', auth()->user()->id)
                ->where('merchantRefNum', $merchantRefNum)
                ->first();
            if(empty($payment)){
                $payment = $this->wallet
                ->where('merchantRefNum', $merchantRefNum)
                ->where('student_id', auth()->user()->id)
                ->first();
                $service = 'Wallet';
            }
            $order = $this->checkItemType($service);

        }
        return response()->json($response);
    }

    public function checkItemType($service){
        return $service;
    }
}
