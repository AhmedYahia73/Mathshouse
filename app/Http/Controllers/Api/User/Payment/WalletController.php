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
    protected $fawryPayService;
    public function __construct(private PaymentMethod $payment_method,
    private Wallet $wallet,
    FawryPayService $fawryPayService){
        $this->fawryPayService = $fawryPayService;
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
    
    use PlaceOrder; // This Trait For Make Order 
    public function payAtFawry(Request $request)
    {
        $request['customerProfileId'] = $request->user()->id ;
        $request['customerMobile'] = $request->user()->phone ;
        // Make Random Number For MerchantRefNumber
        do {
            $length = 6;
            // Generate a random number of the desired length
            $min = pow(10, $length - 1); // Minimum number based on length ( 1000000000 for 10 digits)
            $max = pow(10, $length) - 1; // Maximum number based on length ( 9999999999 for 10 digits)
            $randomNumber = random_int($min, $max);

            // Check if this number already exists in Payment
            $exists = $this->wallet::where('merchantRefNum', $randomNumber)->exists();
            $request['merchantRefNum'] = $randomNumber ;
          } while ($exists); // Repeat until a unique number is generated
                // End Random Number For MerchantRefNumber

        // Validate incoming request data
        $request->validate([
            // 'customerName' => 'required|string',
            'customerMobile' => 'required|string',
            // 'customerEmail' => 'required|email',
            'customerProfileId' => 'required|numeric',
            // 'merchantRefNum' => 'required|string',
            // 'amount' => 'required|numeric',
            // 'description' => 'required|string',
            'chargeItems' => 'required|array',
        ]);
      
        
         // Start Create Order If Operation Payment Success
        $placeOrder = $this->placeOrder($request);
         // Start Create Order If Operation Payment Success
     
        // Extract data
        $merchantRefNum = $request->merchantRefNum;
        $customerProfileId =$request->customerProfileId;
        $paymentMethod = 'PayAtFawry';
        $amount = $placeOrder['chargeItems']['price'];

        // Generate signature
        $signature = $this->fawryPayService->generateSignature($merchantRefNum, $customerProfileId, $paymentMethod, $amount);
        // Prepare the request payload
        $data = [
            'merchantCode' => env('FAWRY_MERCHANT_CODE'),
            'customerName' => $request->customerName,
            'customerMobile' => $request->customerMobile,
            'customerEmail' => $request->customerEmail,
            'customerProfileId' => $request->customerProfileId, // old Request => $request->customerProfileId Changed Cause When Pass Token I Will Get user_id
            'merchantRefNum' => $merchantRefNum,
            'amount' => number_format($placeOrder['chargeItems']['price'], 2, '.', ''),
            'paymentExpiry' => $request->paymentExpiry ?? null,
            'currencyCode' => 'EGP',
            'language' => $request->language ?? 'en-gb',
            'chargeItems' => [$placeOrder['chargeItems']],
            'signature' => $signature,
            'paymentMethod' => $paymentMethod,
            'description' => $request->description
        ];
 
        
            
        // Make the charge request
       $response = $this->fawryPayService->createCharge($data);
        // Return response to the client

   
        
        return response()->json($response);
    }

    public function checkPaymentStatus(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'merchantRefNum' => 'required|string',
        ]);

        // Extract the reference number
        $merchantRefNum = $request->merchantRefNum;
        // Start Confirmation Order
        // Start Confirmation Order
        // Get payment status
        $response = $this->fawryPayService->getPaymentStatus($merchantRefNum);

        if(isset($response['orderStatus']) && $response['orderStatus'] == 'EXPIRED' or $response['orderStatus'] == 'UNPAID'){
            return response()->json([
                'faild'=>'Something Wrong',
            ],498);
        };
       
          return $orderConfirmation = $this->confirmOrder($response);
            if($orderConfirmation){
                return response()->json([
                    'success'=>'Order Success',
                    'orderDetales'=>[
                        'paymentAmount'=>$response['paymentAmount'],
                        'paymentMethod'=>$response['paymentMethod'],
                    ]
                ]);
            }

    // Return response to the client
    // return response()->json($response,200);
    }

}
