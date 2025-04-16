<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentEmail;

use App\Models\Package;
use App\Models\PaymentMethod;
use App\Models\PaymentRequest;
use App\Models\PaymentPackageOrder;
use App\Models\Wallet;
use App\Models\Affilate;
use App\Models\AffilateService;
use App\Models\AffilateRequest;
use App\Models\Commission;
use App\Models\PromoPackage;
use App\Models\UsagePromo;
use App\Models\PromoCode;
use App\Models\User;

use Illuminate\Support\Facades\Cookie;

class Stu_PackageController extends Controller
{
    
    public function package_checkout($id){
        $payment_methods = PaymentMethod::all();
        $package = Package::where('id', $id)
        ->first();
        $promo_code = json_decode(Cookie::get('promo_code'));
        if ( !empty($promo_code) && $package->id == $promo_code->id ) {
            $package = json_decode(Cookie::get('package'));
        }
        Cookie::queue('package', json_encode($package), 10000);
        
        return view('Student.PackageCheckout.Checkout' ,compact('package', 'payment_methods'));
    }

    public function payment_package( $id, Request $req ){

        if ( json_decode(Cookie::get('package')) && json_decode(Cookie::get('package'))->id == $id ) {
            $package = json_decode(Cookie::get('package'));
            Cookie::queue(Cookie::forget('promo_code'));
            Cookie::queue(Cookie::forget('package'));
        }
        else {
            $package = Package::where('id', $id)
            ->first();
        }
        $price = $package->price;
        $arr['price'] = $package->price;
        $arr['module'] = 'Package';
        $arr['user_id'] = auth()->user()->id;
        $img_state = true;

        extract($_FILES['image']);
        $img_name = null;
        $image = false;
        $tmp = null;
        if ( !empty($name) ) {
            $img_state = false;
            $extention_arr = ['jpg', 'jpeg', 'png', 'svg'];
            $extention = explode('.', $name);
            $extention = end($extention);
            $extention = strtolower($extention);
            if ( in_array($extention, $extention_arr)) {
                $img_name = now() . rand(1, 10000) . $name;
                $img_name = str_replace([' ', ':', '-'], 'X', $img_name);
                $arr['image'] = $img_name;
                $image = true;
                $tmp = $tmp_name;
            }
        }
        
        if ( $req->payment_method_id == 'Wallet' ) {
            $wallet = Wallet::
            where('student_id', auth()->user()->id)
            ->where('state', 'Approve')
            ->sum('wallet'); 

            if ( $wallet < $price ) {
                session()->flash('faild', 'Your Wallet Is not Enough'); 
                return redirect()->back();
            }
            $arr['state'] = 'Approve'; 
        }
        elseif ( $img_state ) { 
            session()->flash('faild', 'You Must Enter Receipt');
            return redirect()->back();
        
        }
        else{ 
            $arr['payment_method_id'] = $req->payment_method_id;
            Mail::To('Payment@mathshouse.net')
            ->send(new PaymentEmail($req->all(), auth()->user()));
        }
        $p_request = PaymentRequest::create($arr);
        $p_method = isset($p_request->method->payment) ? $p_request->method->payment : 'Wallet';
        $package_data = json_decode(Cookie::get('package'));
        if ( $req->payment_method_id == 'Wallet' ) {
            $commision = 0;
            $service = null;
            if ( $package->module == 'Exam' ) {
                $user_acc = User::where('id', auth()->user()->id)
                ->first();
                $commision = Commission::where('name', 'Exams')
                ->where('user_id', intval(Cookie::get('affilate')) )
                ->where('state', 1)
                ->first();
                $commision = empty($commision) ? 0 : $commision->precentage;
                $commision = $price * $commision / 100;
                $service = 'Exams';
            }
            elseif ( $package->module == 'Question' ) {
                $user_acc = User::where('id', auth()->user()->id)
                ->first();
                $commision = Commission::where('name', 'Questions')
                ->where('user_id', intval(Cookie::get('affilate')))
                ->where('state', 1)
                ->first();
                $commision = empty($commision) ? 0 : $commision->precentage;
                $commision = $price * $commision / 100;
                $service = 'Questions';
            }
            elseif ( $package->module == 'Live' ) {
                $user_acc = User::where('id', auth()->user()->id)
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
                'student_id' => auth()->user()->id,
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
                'number' => $package->number,
                'user_id' => auth()->user()->id,
            ]);
        }
        else{
            PaymentPackageOrder::create([
                'payment_request_id' => $p_request->id,
                'package_id' => $package_data->id,
                'date' => now(),
                'number' => $package->number,
                'user_id' => auth()->user()->id,
            ]);
            if ( !empty(Cookie::get('affilate')) ) {
                $commision = 0;
                $service = null;
                if ( $package->module == 'Exam' ) {
                    $commision = Commission::where('name', 'Exams')
                    ->where('user_id', intval(Cookie::get('affilate')))
                    ->where('state', 1)
                    ->first();
                    $commision = empty($commision) ? 0 : $commision->precentage;
                    $commision = $price * $commision / 100;
                    $service = 'Exams';
                }
                elseif ( $package->module == 'Question' ) {
                    $commision = Commission::where('name', 'Questions')
                    ->where('user_id', intval(Cookie::get('affilate')))
                    ->where('state', 1)
                    ->first();
                    $commision = empty($commision) ? 0 : $commision->precentage;
                    $commision = $price * $commision / 100;
                    $service = 'Questions';
                }
                elseif ( $package->module == 'Live' ) {
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
        move_uploaded_file( $tmp, 'images/payment_reset/' . $img_name);
        $pages = [];
        $q_id = Cookie::get('q_id');
        $exam_id = Cookie::get('exam_id');
        $q_ans_id = Cookie::get('q_ans_id');
        if ( is_numeric($q_id) ) {
            $pages['q_id'] = intval($q_id);
            Cookie::queue(Cookie::forget('q_id'));
        }
        elseif ( is_numeric($exam_id) ) {
            $pages['exam_id'] = intval($exam_id);
            Cookie::queue(Cookie::forget('exam_id'));
        }
        elseif ( is_numeric($q_ans_id) ) {
            $pages['q_ans_id'] = intval($q_ans_id);
            Cookie::queue(Cookie::forget('q_ans_id'));
        }
        
        
        return view('Student.Order.Order', compact('package', 'price', 'p_method', 'pages'));
    }

    public function package_use_promocode( Request $req ){
        $package = json_decode(Cookie::get('package'));
        Cookie::queue('promo_code', json_encode($package), 10000);
        
        
        $uses = UsagePromo::where('user_id', auth()->user()->id)
        ->where('promo', $req->promo_code)
        ->first(); 
        
        if ( empty($uses) ) {
            $promo = PromoCode::where('starts', '<=', now())
            ->where('ends', '>=', now())
            ->where('num_usage', '>', 0)
            ->where('code', $req->promo_code)
            ->first();
            if ( !empty($promo) ) {
                $promo_package = PromoPackage::where('promo_id', $promo->id)
                ->where('package_id', $package->id)
                ->first();
                if ( !empty($promo_package) ) {
                    $price = $package->price;
                    $price = $price - $price * $promo->discount	/ 100;
                    $package->price = $price; 
                    Cookie::queue('package', json_encode($package), 10000);
                    PromoCode::where('id', $promo->id)
                    ->update([
                        'num_usage' => $promo->num_usage - 1
                    ]);
                    UsagePromo::create([
                        'user_id' => auth()->user()->id,
                        'promo_id' => $promo->id,
                        'promo' => $req->promo_code
                    ]);
                    return redirect()->back(); 
                }
            }
        } 
        session()->flash('faild', 'Promo Code Is Uses');
        return redirect()->back(); 
    }

}
