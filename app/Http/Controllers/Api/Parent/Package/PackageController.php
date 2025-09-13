<?php

namespace App\Http\Controllers\Api\Parent\Package;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentEmail;
use App\trait\Image;

use App\Models\PaymentPackageOrder;
use App\Models\PaymentRequest;
use App\Models\SmallPackage;
use App\Models\Package;
use App\Models\PaymentMethod; 
use App\Models\Wallet;
use App\Models\Affilate;
use App\Models\AffilateService;
use App\Models\AffilateRequest;
use App\Models\Commission;
use App\Models\PromoPackage;
use App\Models\UsagePromo;
use App\Models\PromoCode;
use App\Models\Course;
use App\Models\User;

use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;

class PackageController extends Controller
{
    use Image;

    public function my_packages(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id'
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $packages = Package::all();
        foreach ( $packages as $item ) {
            $newTime = Carbon::now()->subDays($item->duration); 
            $payment = PaymentPackageOrder::
            where('package_id', $item->id)
            ->get();

            foreach ( $payment as $value ) {
                
                if ( $value->date < $newTime ) 
                 {  
                    $value->delete();
                 }
            }
        }

        $small_package = SmallPackage::where('user_id', $request->user_id)
        ->get();
        $s_exams = $small_package->where('module', 'Exam')->sum('number');
        $s_questions = $small_package->where('module', 'Question')->sum('number');
        $s_live = $small_package->where('module', 'Live')->sum('number');
        $exam = PaymentPackageOrder::
        leftJoin('payment_requests', 'payment_package_order.payment_request_id', '=', 'payment_requests.id')
        ->leftJoin('packages', 'payment_package_order.package_id', '=', 'packages.id')
        ->where('payment_package_order.state', 1)
        ->where('packages.module', 'Exam')
        ->where('payment_package_order.user_id', $request->user_id)
        ->sum('payment_package_order.number') + $s_exams;
        
        $questions = PaymentPackageOrder::
        leftJoin('payment_requests', 'payment_package_order.payment_request_id', '=', 'payment_requests.id')
        ->leftJoin('packages', 'payment_package_order.package_id', '=', 'packages.id')
        ->where('payment_package_order.state', 1)
        ->where('packages.module', 'Question')
        ->where('payment_package_order.user_id', $request->user_id)
        ->sum('payment_package_order.number') + $s_questions;
        
        $live = PaymentPackageOrder::
        leftJoin('payment_requests', 'payment_package_order.payment_request_id', '=', 'payment_requests.id')
        ->leftJoin('packages', 'payment_package_order.package_id', '=', 'packages.id')
        ->where('payment_package_order.state', 1)
        ->where('packages.module', 'Live')
        ->where('payment_package_order.user_id', $request->user_id)
        ->sum('payment_package_order.number') + $s_live;
        
        $courses = Course::
        select('course_name', 'id')
        ->where('category_id', $request->user()->category_id)
        ->with('packages:id,name,course_id,price,number,duration,module')
        ->get();
        return response()->json([
            'exams' => $exam,
            'questions' => $questions,
            'lives' => $live,
            'courses' => $courses,
        ]);
    }


    public function packages(Request $request, $id){ 
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id'
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $courses = Course::
        select('course_name', 'id')
        ->where('id', $id)
        ->with('packages:id,name,course_id,price,number,duration,module')
        ->first();

        return response()->json([
            'courses' => $courses
        ]);
    }

    public function lists(){
        $payment_methods = PaymentMethod::where('statue', 1)
        ->get()
        ->map(function($item){
            $payment_type = 'text';
            if ($item->payment == 'vodafone cash') {
                $payment_type = 'phone';
            }
            elseif ($item->payment == 'Instapay') {
                $payment_type = 'link';
            }
            elseif ($item->payment == 'Paymob') {
                $payment_type = 'integration';
            }
            return [ 
                'id' => $item->id,
                'payment' => $item->payment,
                'payment_type' => $payment_type,
                'description' => $item->description,
                'logo' => url('images/payment/' . $item->logo),
            ];
        });

        return response()->json([
            'payment_methods' => $payment_methods
        ]);
    }

    public function payment_package( $id, Request $request){
        $validator = Validator::make($request->all(), [
            'payment_method_id' => 'required',
            'user_id' => 'required|exists:users,id'
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        $package_data = Package::where('id', $id)
        ->first();
        $arr = [];
        $arr['price'] = $package_data->price;
        $price = $package_data->price;
        $arr['module'] = 'Package';
        $arr['user_id'] = $request->user_id;
        $img_state = true;
 
        $img_name = null; 
        $tmp = null;
        if ($request->image) {
            $image_path = $this->store_base64($request->image, 'images/payment_reset');
            $arr['image'] = $image_path;
            $img_state = false;
        }
        $user = User::
        where('id', $request->user_id)
        ->first();
        
        if ( $img_state ) { 
            return response()->json([
                'errors' => 'You Must Enter Receipt'
            ], 400); 
        }
        else{ 
            $arr['payment_method_id'] = $request->payment_method_id == 'Wallet' ? null: $request->payment_method_id;
            Mail::To('Payment@mathshouse.net')
            ->send(new PaymentEmail($request->all(), $user));
        }
        $p_request = PaymentRequest::create($arr);
        $p_method = isset($p_request->method->payment) ? $p_request->method->payment : 'Wallet'; 
        if ( $request->payment_method_id == 'Wallet' ) {
            $commision = 0;
            $service = null;
            if ( $package_data->module == 'Exam' ) {
                $user_acc = User::where('id', $request->user_id)
                ->first();
                $commision = Commission::where('name', 'Exams')
                ->where('user_id', intval(Cookie::get('affilate')) )
                ->where('state', 1)
                ->first();
                $commision = empty($commision) ? 0 : $commision->precentage;
                $commision = $price * $commision / 100;
                $service = 'Exams';
            }
            elseif ( $package_data->module == 'Question' ) {
                $user_acc = User::where('id', $request->user_id)
                ->first();
                $commision = Commission::where('name', 'Questions')
                ->where('user_id', intval(Cookie::get('affilate')))
                ->where('state', 1)
                ->first();
                $commision = empty($commision) ? 0 : $commision->precentage;
                $commision = $price * $commision / 100;
                $service = 'Questions';
            }
            elseif ( $package_data->module == 'Live' ) {
                $user_acc = User::where('id', $request->user_id)
                ->first();
                $commision = Commission::where('name', 'Live Session')
                ->where('user_id', intval(Cookie::get('affilate')))
                ->where('state', 1)
                ->first();
                $commision = empty($commision) ? 0 : $commision->precentage;
                $commision = $price * $commision / 100;
                $service = 'Live Session';
            }

            if ( !empty(Cookie::get('affilate')) ) { 
                $affilate = Affilate::where('id', intval(Cookie::get('affilate')))
                ->first();
                $affilate->update([
                    'wallet' => $affilate->wallet + $commision
                ]);
                AffilateService::create([
                    'affilate_id' => $affilate->id ,
                    'service' => $service ,
                    'earned' =>  $commision, 
                ]);
            }
            Wallet::create([
                'student_id' => $request->user_id,
                'wallet' => -$price,
                'state' => 'Approve',
                'date' => now(),
                'payment_request_id' => $p_request->id,
            ]);
            PaymentPackageOrder::create([
                'payment_request_id' => $p_request->id,
                'package_id' => $package_data->id,
                'date' => now(),
                'state' => 1,
                'number' => $package_data->number,
                'user_id' => $request->user_id,
            ]);
        }
        else{
            PaymentPackageOrder::create([
                'payment_request_id' => $p_request->id,
                'package_id' => $package_data->id,
                'date' => now(),
                'number' => $package_data->number,
                'user_id' => $request->user_id,
            ]);
            if ( !empty(Cookie::get('affilate')) ) {
                $commision = 0;
                $service = null;
                if ( $package_data->module == 'Exam' ) {
                    $commision = Commission::where('name', 'Exams')
                    ->where('user_id', intval(Cookie::get('affilate')))
                    ->where('state', 1)
                    ->first();
                    $commision = empty($commision) ? 0 : $commision->precentage;
                    $commision = $price * $commision / 100;
                    $service = 'Exams';
                }
                elseif ( $package_data->module == 'Question' ) {
                    $commision = Commission::where('name', 'Questions')
                    ->where('user_id', intval(Cookie::get('affilate')))
                    ->where('state', 1)
                    ->first();
                    $commision = empty($commision) ? 0 : $commision->precentage;
                    $commision = $price * $commision / 100;
                    $service = 'Questions';
                }
                elseif ( $package_data->module == 'Live' ) {
                    $commision = Commission::where('name', 'Live Session')
                    ->where('user_id', intval(Cookie::get('affilate')))
                    ->where('state', 1)
                    ->first();
                    $commision = empty($commision) ? 0 : $commision->precentage;
                    $commision = $price * $commision / 100;
                    $service = 'Exams';
                }
                AffilateRequest::create([
                    'affilate_id' => intval(Cookie::get('affilate')),
                    'service' => $service,
                    'earned' => $commision,
                    'payment_req_id' => $p_request->id
                ]);
            }
        } 
        
        
        return response()->json([
            'success' => 'You buy package success'
        ]);
    }
}
