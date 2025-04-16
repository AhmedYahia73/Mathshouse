<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentEmail;

use App\Models\Category;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\UsagePromo;
use App\Models\PromoCode;
use App\Models\PaymentMethod;
use App\Models\PaymentOrder;
use App\Models\PaymentRequest;
use App\Models\Wallet;
use App\Models\Affilate;
use App\Models\Commission;
use App\Models\AffilateService;
use App\Models\AffilateRequest;
use App\Models\MarketingPopup;
use App\Models\PromoCourse; 
use App\Models\Lesson; 
use App\Models\IdeaLesson; 
use App\Models\Question;
use App\Models\quizze;
use App\Models\Currancy;
use App\service\PaymentPaymob;
use Illuminate\Support\Facades\Session;

class CoursesController extends Controller
{
use PaymentPaymob;

    public function categories(){
        $categories = Category::all();
        $popup = MarketingPopup::
        where('starts', '<=', now())
        ->where('ends', '>=', now())
        ->whereHas('popup_pages', function($query){
            $query->where('page_name', 'Categories');
        })
        ->get();

        return view('Visitor.Courses.Categories', compact('categories', 'popup'));
    }

    public function courses($id){
        $courses = Course::where('category_id', $id)
        ->get();
        $popup = MarketingPopup::
        where('starts', '<=', now())
        ->where('ends', '>=', now())
        ->whereHas('popup_pages', function($query){
            $query->where('page_name', 'Courses');
        })
        ->get();

        return view('Visitor.Courses.Courses', compact('courses', 'popup'));
    }

    public function course($id){ 
        $chapters = Chapter::where('course_id', $id)
        ->get();
        $course = Course::where('id', $id)
        ->first();
        $currency = Currancy::all();
        
        foreach ($chapters as $key => $item) { 
            if ( count($item->price) == 0 || $item->price == null) {
                $min =  0;
            } 
            else {
                $min =  $item->price[0]->price;
                foreach (  $item->price as $element ) {
                    if ( $min > $element->price ) {
                        $min = $element->price;
                    }
                }
            }
            $chapters[$key]['ch_price'] = $min;
        } 
        $course_price = Course::
        with('prices')
        ->where('id', $id)
        ->first();
        $discount = 0;
        $price = 0;
        $total_price = 0;
        if ( count($item->price) != 0 && $item->price != null) {
            $discount = @$course_price->prices[0]->discount;
            $price = @$course_price->prices[0]->price;
            if (is_numeric($price)) {
                for ($i=0, $end = count($course_price->prices); $i < $end; $i++) { 
                    if( $price > $course_price->prices[$i]->price){
                        $price = $course_price->prices[$i]->price;
                    }
                }
            }
            $total_price = $price - $price * $discount / 100;
        }
        $chapters_count = Chapter::where('course_id', $id)
        ->pluck('id');
        $lessons_count = Lesson::whereIn('chapter_id', $chapters_count)
        ->pluck('id');
        $videos_count = IdeaLesson::whereIn('lesson_id', $lessons_count)
        ->get();
        $questions = Question::whereIn('lesson_id', $lessons_count)
        ->count();
        $quizs = quizze::whereIn('lesson_id', $lessons_count)
        ->count();
        $related_course = Course::where('id', '!=', $id)
        ->get();
        
        return view('Visitor.Courses.Chapters', 
        compact('chapters', 'course_price', 'price', 'course', 'total_price', 'related_course',
        'chapters_count', 'lessons_count', 'videos_count', 'questions', 'quizs', 'currency'));
    }
    
    public function buy_chapters( Request $req ){

        return $req->all();
    }
    
    public function buy_course( Request $req ){
        
           $course_data = json_decode($req->course_data);
        $course = Course::where('id', $course_data->id)
        ->first();
        $min_price = $course->prices[0]->price;
        $min_price_data = $course->prices[0];
        foreach ( $course->prices as $price) {
            if ( $min_price > $price->price ) {
                $min_price = $price->price;
                $min_price_data = $price;
            }
        }
       Cookie::queue(Cookie::forget('min_price_data'));
        
        if ( empty(auth()->user()) && $min_price == $req->chapters_price ) {
            return view('Visitor.Login.login');
        }
        elseif ( $min_price == $req->chapters_price ) {
            Cookie::queue('min_price_data', json_encode($min_price_data), 180); 
            return view('Visitor.Cart.Course_Cart', compact('course', 'min_price', 'min_price_data'));
        }
        
        $chaptersIds = json_decode($req->chapters_data); // Get Chapters Data For Convert To json
        $data = Chapter::whereIn('id', $chaptersIds)->with('price')->get(); // Get Chapters Data From Database
    // Minimum Price
     foreach($data as $chapter){
             $min = $chapter->price[0]->price;
              $discount = $chapter->price[0]->discount;
            foreach ($chapter->price as $ch_price){
                       if ($min > $ch_price->price){
                       $chapter->ch_price = $ch_price->price;
                       $discount = $ch_price->discount;
                       }
            }
        }
    //Minimum Price
        $chapters_price = $req->chapters_price;
        $chapter_discount = 0;
        $price_data = json_decode($data);
        $price_arr = [];
        foreach ( $price_data as $item ) {
            $min = $item->price[0];
            foreach ($item->price as $element) {
                if ( $element->price < $min->price ) {
                    $min = $element;
                }
            }
            $chapter_discount += $min->price - ($min->price * $min->discount / 100);
            $price_arr[] = $min;
        }
        if ( empty($req->chapters_data) ) {
            // return    $data = json_decode($req->cookie('marketing')); // Change New Method To Take cokie From Cookie
             $data = json_decode(Session::get('marketing')); //Old Method To get Data From Cookie
        Session::put('marketing', json_encode($course));
       $chapters_price = floatval(Cookie::get('chapters_price'));
        }
        // return coun$data;
            $req->session()->put('user', $data);

         Session::put('marketing', json_encode($data));  
         Cookie::queue('chapters_price', ($chapters_price), 180);
         $price_arr = json_encode($price_arr);
        if ( empty(auth()->user()) ) {
            return view('Visitor.Login.login');
        }
        else{
            $chapters = json_decode($data); 
            return view('Visitor.Cart', compact('chapters', 'chapters_price', 'price_arr', 'chapter_discount'));
        }
    }

    public function cart_buy_course( Request $req ){
        
        $course_data = json_decode(Session::get('marketing')); 
        $chapters_price = floatval(Cookie::get('chapters_price')); 
        if ( isset($course_data->id) ) { 
            
            $course = Course::where('id', $course_data->id)
            ->first();
            $min_price = $course->prices[0]->price;
            $min_price_data = $course->prices[0];
            foreach ( $course->prices as $price) {
                if ( $min_price > $price->price ) {
                    $min_price = $price->price;
                    $min_price_data = $price;
                }
            }
            Cookie::queue(Cookie::forget('min_price_data')); 
            if ( empty(auth()->user()) && $min_price == $chapters_price ) {
                return view('Visitor.Login.login');
            }
            elseif ( $min_price == $chapters_price ) {
                Cookie::queue('min_price_data', $min_price_data, 10000); 
                return view('Visitor.Cart.Course_Cart', compact('course', 'min_price', 'min_price_data'));
            }
        }
        elseif ( is_array($course_data) ) {
            $data = json_decode(Session::get('marketing')); 
            $chapters_price = floatval(Cookie::get('chapters_price'));  
            $chapter_discount = 0;
            $price_data = json_decode($data);
            $price_arr = [];
            foreach ( $price_data as $item ) {
                $min = $item->price[0];
                foreach ($item->price as $element) {
                    if ( $element->price < $min->price ) {
                        $min = $element;
                    }
                }
                $chapter_discount += $min->price - ($min->price * $min->discount / 100);
                $price_arr[] = $min;
            }
            
            if ( empty($req->chapters_data) ) {
                $data = json_decode(Session::get('marketing')); 
                $chapters_price = floatval(Cookie::get('chapters_price'));
            }
            Session::put('marketing', json_encode($data));
            Cookie::queue('chapters_price', ($chapters_price), 10000);
            Cookie::queue('price_arr', json_encode($price_arr), 10000);  
            $price_arr = json_encode($price_arr);
            $chapters = json_decode(Session::get('marketing'));
            return view('Visitor.Cart', compact('chapters', 'chapters_price', 'price_arr', 'chapter_discount'));
        }
        else{
            $chapters = [];
            $chapters_price = null;
            $price_arr = [];
            $chapter_discount = null;
            return view('Visitor.Cart', compact('chapters', 'chapters_price', 'price_arr', 'chapter_discount'));
        }
    }

    public function course_payment( Request $req ){
        
        $course_data = json_decode(Session::get('marketing')); 
        $chapters_price = floatval(Cookie::get('chapters_price')); 
        if ( isset($course_data->id) ) { 
            
            $course = Course::where('id', $course_data->id)
            ->first();
            $min_price = $course->prices[0]->price;
            $min_price_data = $course->prices[0];
            foreach ( $course->prices as $price) {
                if ( $min_price > $price->price ) {
                    $min_price = $price->price;
                    $min_price_data = $price;
                }
            }
            Cookie::queue(Cookie::forget('min_price_data')); 
            if ( empty(auth()->user()) && $min_price == $chapters_price ) {
                return view('Visitor.Login.login');
            }
            elseif ( $min_price == $chapters_price ) {
                Cookie::queue('min_price_data', json_encode($min_price_data), 10000);
                return view('Visitor.Cart.Course_Cart', compact('course', 'min_price', 'min_price_data'));
            }
        }

        $data = json_decode(Session::get('marketing')); 
       $chapters_price = floatval(Cookie::get('chapters_price'));
        $chapter_discount = 0;
        $price_data = $data;
        $price_arr = [];
        
        if ( is_array($price_data) ) {
            foreach ( $price_data as $item ) {
                $min = $item->price[0];
                foreach ($item->price as $element) {
                    if ( $element->price < $min->price ) {
                        $min = $element;
                    }
                }
                $chapter_discount += $min->price - ($min->price * $min->discount / 100);
                $price_arr[] = $min;
            }
        }
        else{ 
            return $min_price = $price_data->prices[0];
            foreach ($price_data->prices as $element) {
                if ( $element->price < $min_price->price ) {
                    $min_price = $element;
                }
            }
            $chapter_discount += $min_price->price - ($min_price->price * $min_price->discount / 100);
            $min_price_data = $course->prices[0];
            return view('Visitor.Cart.Course_Cart', compact('course', 'min_price', 'min_price_data'));
        }
        
        if ( empty($req->chapters_data) ) {
            $data = json_decode(Session::get('marketing')); 
            $chapters_price = floatval(Cookie::get('chapters_price'));
        }
        Session::put('marketing', json_encode($data)); 
        Cookie::queue('chapters_price', ($chapters_price), 10000); 
        Cookie::queue('price_arr', json_encode($price_arr), 10000);
        $price_arr = json_encode($price_arr);
        $chapters = json_decode(Session::get('marketing'));
        return view('Visitor.Cart', compact('chapters', 'chapters_price', 'price_arr', 'chapter_discount'));
    }

    public function Use_Promocode( Request $req ){
        $chapters = json_decode(Session::get('marketing'));
        $chapters = json_decode($chapters) ?json_decode($chapters) : $chapters;
        $course_id = $chapters[0]->course_id;
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
                $promo_course = PromoCourse::where('promo_id', $promo->id)
                ->where('course_id', $course_id)
                ->first();
                if ( !empty($promo_course) ) {
                    $price = (Cookie::get('chapters_price')); 
                    $price = $price - $price * $promo->discount	/ 100;
                    Cookie::queue('chapters_price', ($price), 10000);
                    PromoCode::where('id', $promo->id)
                    ->update([
                        'num_usage' => $promo->num_usage - 1
                    ]);
                    UsagePromo::create([
                        'user_id' => auth()->user()->id,
                        'promo_id' => $promo->id,
                        'promo' => $req->promo_code
                    ]);
                    return redirect()->route('promo_check_out_chapter'); 
                }
            }
        } 
        session()->flash('faild', 'Promo Code Is Uses');
        return redirect()->route('new_payment'); 
    }

    public function promo_check_out_chapter( Request $req ){ 
        $chapters = json_decode(Session::get('marketing'));
        $chapters = is_string($chapters) ? json_decode($chapters, true) : $chapters;
        $price = floatval(Cookie::get('chapters_price'));
        $payment_methods = PaymentMethod::
        where('statue', 1)
        ->get();
        $chapters = is_array($chapters) ? $chapters : [$chapters];

        return view('Visitor.Checkout.Checkout', compact('price', 'chapters', 'payment_methods'));
    }

    public function course_use_promocode( Request $req ){
        $courses = json_decode(Session::get('marketing'));
        $course_id = $courses->id;

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
                $promo_course = PromoCourse::where('promo_id', $promo->id)
                ->where('course_id', $course_id)
                ->first();
                if ( !empty($promo_course) ) {
                    $price = floatval(Cookie::get('chapters_price'));
                    $price = $price - $price * $promo->discount	/ 100;
                    Cookie::queue('chapters_price', $price, 10000);
                    PromoCode::where('id', $promo->id)
                    ->update([
                        'num_usage' => $promo->num_usage - 1
                    ]);
                    UsagePromo::create([
                        'user_id' => auth()->user()->id,
                        'promo_id' => $promo->id,
                        'promo' => $req->promo_code
                    ]);
                    $course = json_decode(Session::get('marketing'));
                    $payment_methods = PaymentMethod::
                    where('statue', 1)
                    ->get();
            
                    return view('Visitor.C_Checkout.Checkout', compact('price', 'course', 'payment_methods'));
                    return redirect()->route('promo_check_out_course');
                }
            }
        } 
        
        session()->flash('faild', 'Promo Code Is Uses');
        return redirect()->route('c_new_payment'); 
    }

    public function promo_check_out_course( Request $req ){
        $course = json_decode(Session::get('marketing'));
        $price = floatval(Cookie::get('chapters_price'));
        $payment_methods = PaymentMethod::
        where('statue', 1)
        ->get();

        return view('Visitor.C_Checkout.Checkout', compact('price', 'course', 'payment_methods'));
    }

    public function check_out( Request $req ){
        $chapters = json_decode(Session::get('marketing'));
        $chapters = is_array($chapters) ? $chapters : json_decode($chapters);
        Cookie::queue('chapters_price', $req->chapters_pricing, 10000);
        $price = $req->chapters_pricing;
        $payment_methods = PaymentMethod::
        where('statue', 1)
        ->get();
        
        return view('Visitor.Checkout.Checkout', compact('price', 'chapters', 'payment_methods'));
    }

    public function check_out_course( Request $req ){
        $course = json_decode($req->course);
        $price = $req->price;
        Session::put('marketing', json_encode($course), 10000);
        Cookie::queue('chapters_price', $price, 10000);
        $payment_methods = PaymentMethod::
        where('statue', 1)
        ->get();

        return view('Visitor.C_Checkout.Checkout', compact('price', 'course', 'payment_methods'));
    }

    public function new_payment(){
        $course_data = json_decode(Session::get('marketing')); 
        $chapters_price = floatval(Cookie::get('chapters_price'));
        if ( isset($course_data->id) && !isset($course_data->chapter_name) ) { 
            
            $course = Course::where('id', $course_data->id)
            ->first();
            $min_price = $course->prices[0]->price;
            $min_price_data = $course->prices[0];
            foreach ( $course->prices as $price) {
                if ( $min_price > $price->price ) {
                    $min_price = $price->price;
                    $min_price_data = $price;
                }
            }
            Cookie::queue(Cookie::forget('min_price_data')); 
            if ( empty(auth()->user()) && $min_price == $chapters_price ) {
                return view('Visitor.Login.login');
            }
            elseif ( $min_price == $chapters_price ) {
                Cookie::queue('min_price_data', $min_price_data, 10000);
                return view('Visitor.Cart.Course_Cart', compact('course', 'min_price', 'min_price_data'));
            }
        }
        elseif ( isset($course_data->chapter_name) ) {
 
            $data = json_decode(Session::get('marketing'));
            $chapters_price = Cookie::get('chapters_price');
            $chapter_discount = 0;
            $price_data = json_decode($data);
            $price_arr = [];
            
                $min = $price_data->price[0];
                foreach ($price_data->price as $element) {
                    if ( $element->price < $min->price ) {
                        $min = $element;
                    }
                }
                $chapter_discount += $min->price - ($min->price * $min->discount / 100);
                $price_arr[] = $min;
            
            if ( empty($req->chapters_data) ) {
                $data = json_decode(Session::get('marketing'));
                $chapters_price = floatval(Cookie::get('chapters_price'));
            }
            Session::put('marketing', json_encode($data));
            Cookie::queue('chapters_price', ($chapters_price), 10000);
            Cookie::queue('price_arr', json_encode($price_arr), 10000);
            $price_arr = json_encode($price_arr);
            $chapters = json_decode(Session::get('marketing'));
            $chapters = [json_decode($chapters)];
            
            return view('Visitor.Cart', compact('chapters', 'chapters_price', 'price_arr', 'chapter_discount'));
       
        }

        $data = json_decode(Session::get('marketing'));
        $chapters_price = json_decode(Cookie::get('chapters_price'));
        $chapter_discount = 0;
        $price_data = json_decode($data);
        $price_arr = [];
        
        foreach ( $price_data as $item ) {
            $min = $item->price[0];
            foreach ($item->price as $element) {
                if ( $element->price < $min->price ) {
                    $min = $element;
                }
            }
            $chapter_discount += $min->price - ($min->price * $min->discount / 100);
            $price_arr[] = $min;
        }
        
        if ( empty($req->chapters_data) ) {
            $data = json_decode(Session::get('marketing'));
            $chapters_price = json_decode(Cookie::get('chapters_price'));
        }
        Session::put('marketing', json_encode($data));
        Cookie::queue('chapters_price', $chapters_price, 10000);
        Cookie::queue('price_arr', json_encode($price_arr), 10000);
        $price_arr = json_encode($price_arr);
        $chapters = json_decode(Session::get('marketing'));
        $chapters = json_decode($chapters);
        return view('Visitor.Cart', compact('chapters', 'chapters_price', 'price_arr', 'chapter_discount'));
    }

    public function c_new_payment(){
        
        $course_data = json_decode(Session::get('marketing'));
        $chapters_price = json_decode(Cookie::get('chapters_price'));
            
        $course = Course::where('id', $course_data->id)
        ->first();
        $min_price = $course->prices[0]->price;
        $min_price_data = $course->prices[0];
        foreach ( $course->prices as $price) {
            if ( $min_price > $price->price ) {
                $min_price = $price->price;
                $min_price_data = $price;
            }
        }
        Cookie::queue(Cookie::forget('min_price_data')); 
        if ( empty(auth()->user()) && $min_price == $chapters_price ) {
            return view('Visitor.Login.login');
        }
        elseif ( $min_price == $chapters_price ) {
            Cookie::queue('min_price_data', $min_price_data, 10000);
            return view('Visitor.Cart.Course_Cart', compact('course', 'min_price', 'min_price_data'));
        }
    }

    public function payment_money( Request $req ){
        $arr['price'] = floatval(Cookie::get('chapters_price'));
        $arr['user_id'] = auth()->user()->id;
        $img_state = true;
        $paymentMethod = PaymentMethod::find($req->payment_method_id);
        $payment = $paymentMethod->payment;
        extract($_FILES['image']);
        $img_name = null;
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
                $tmp = $tmp_name;
            }
            
        }
        $chapters = json_decode(Session::get('marketing'));
        try {
            $chapters = json_decode($chapters);
        } catch (\Throwable $th) {
            //throw $th;
        }
        $price = json_decode(Cookie::get('chapters_price'));
        if ( $req->payment_method_id == 'Wallet' ) {
            $wallet = Wallet::
            where('student_id', auth()->user()->id)
            ->where('state', 'Approve')
            ->sum('wallet');
            
            if ( $wallet < $price ) {
                session()->flash('faild', 'You Wallet Is not Enough');
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
        if( $payment == "Paymob"){
             $user=auth()->user();
                return $this->credit($user,$paymentMethod,$chapters,$price,'Chapters');
        }else{
        $p_request = PaymentRequest::create($arr);

        }
        if ( $req->payment_method_id == 'Wallet' ) {
            Wallet::create([
                'student_id' => auth()->user()->id,
                'wallet' => -$price,
                'state' => 'Approve',
                'date' => now(),
                'payment_request_id' => $p_request->id,
            ]);
            $p_method = isset($p_request->method->payment) ? $p_request->method->payment : 'Wallet';
            $duration = 0;
            $total = 0;
            for ($i=0, $end = count($chapters); $i < $end; $i++) { 
                foreach ( $chapters[$i]->price as $item ) {
                    if ( $item->price == $chapters[$i]->ch_price ) {
                        $duration = $item->duration;
                        $total += ($item->price - $item->price * $item->discount / 100);
                    }
                }
                PaymentOrder::create( 
                    ['payment_request_id' => $p_request->id,
                    'chapter_id' => $chapters[$i]->id,
                    'duration' => $duration,
                    'state' => 1]);
            }
            if ( !empty(Cookie::get('affilate')) ) {
                $commision = 0;
                $commision = Commission::where('name', 'Chapter')
                ->where('user_id', intval(Cookie::get('affilate')))
                ->where('state', 1)
                ->first();
                $commision = empty($commision) ? 0 : $commision->precentage;
                $commision = $total * $commision / 100;
                $service = 'Chapter';
                $affilate = Affilate::
                where('id', intval(Cookie::get('affilate')))
                ->first();
                $affilate->update([
                    'wallet' => $affilate->wallet + $commision
                ]);
                    
                AffilateService::create([
                    'affilate_id' => intval(Cookie::get('affilate')),
                    'service' => $service,
                    'earned' => $commision,
                ]);
            }
        }
        else {
            
            $p_method = isset($p_request->method->payment) ? $p_request->method->payment : 'Wallet';
            $duration = 0;
            $total = 0;
            for ($i=0, $end = count($chapters); $i < $end; $i++) { 
                foreach ( $chapters[$i]->price as $item ) {
                    if ( $item->price == $chapters[$i]->ch_price ) {
                        $duration = $item->duration;
                        $total += $item->price;
                    }
                }
                PaymentOrder::create( 
                    ['payment_request_id' => $p_request->id,
                    'chapter_id' => $chapters[$i]->id,
                    'duration' => $duration,]);
            }

            if ( !empty(Cookie::get('affilate')) ) {
                $commision = 0;
                $commision = Commission::where('name', 'Chapter')
                ->where('user_id', floatval(Cookie::get('affilate')))
                ->where('state', 1)
                ->first();
                $commision = empty($commision) ? 0 : $commision->precentage;
                $commision = $price * $commision / 100;
                $service = 'Chapter';
                    
                AffilateRequest::create([
                    'affilate_id' => floatval(Cookie::get('affilate')),
                    'service' => $service,
                    'earned' => $commision,
                    'payment_req_id' => $p_request->id
                ]);
            }
        }

        if ( $img_name != null ) {
            move_uploaded_file($tmp, 'images/payment_reset/' . $img_name);
        }
        
        return view('Visitor.Order.Order', compact('chapters', 'price', 'p_method'));
    }

    public function course_payment_money( Request $req ){
            $payment_methods = PaymentMethod::
            where('statue', 1)
            ->where('id',$req->payment_method_id)
            ->first();
        $arr['price'] = floatval(Cookie::get('chapters_price'));
        $arr['user_id'] = auth()->user()->id;
        $img_state = true;

        extract($_FILES['image']);
        $img_name = null;
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
                $tmp = $tmp_name;
            }
        }
        
      
            
        //   Start Make Paymob Credit
        if(isset($payment_methods->payment)){
            if($payment_methods->payment == "Paymob"){
                $course = json_decode(Session::get('marketing'));
                $price = floatval(Cookie::get('chapters_price'));
                $token = $req->_token;
                $user = auth()->user();
                $commision = intval(Cookie::get('affilate'));
                return $this->credit($user,$payment_methods,$course,$price,'Course',$commision);
            }
        
        }
        //   End Make Paymob Credit 
        if ( $req->payment_method_id == 'Wallet' ) {
              $course = json_decode(Session::get('marketing'));
              $price = floatval(Cookie::get('chapters_price'));
            $wallet = Wallet::
            where('student_id', auth()->user()->id)
            ->where('state', 'Approve')
            ->sum('wallet'); 

            if ( $wallet < $price ) {
                session()->flash('faild', 'You Wallet Is not Enough'); 
                $payment_methods = PaymentMethod::
                where('statue', 1)
                ->get();
        
                return view('Visitor.C_Checkout.Checkout', compact('price', 'course', 'payment_methods'));
            }
           
            $arr['state'] = 'Approve'; 
            
        }elseif( $req->payment_method_id == 'paymob'){
            return "Welcom To Paymob";

        }
        elseif ( $img_state ) { 
            session()->flash('faild', 'You Must Enter Receipt');
            $payment_methods = PaymentMethod::
            where('statue', 1)
            ->get();
    
            return view('Visitor.C_Checkout.Checkout', compact('price', 'course', 'payment_methods'));
        }
        else{ 
            $arr['payment_method_id'] = $req->payment_method_id;
            Mail::To('Payment@mathshouse.net')
            ->send(new PaymentEmail($req->all(), auth()->user()));
        }
        $p_request = PaymentRequest::create($arr);
        if ( $img_name != null) {
            move_uploaded_file($tmp, 'images/payment_reset/' . $img_name);
        }
        $duration = 0;

        
        if ( $req->payment_method_id == 'Wallet' ) {
            $commision = Commission::where('name', 'Course')
            ->where('user_id', intval(Cookie::get('affilate')))
            ->where('state', 1)
            ->first();
            $commision = empty($commision) ? 0 : $commision->precentage;
            $commision = $price * $commision / 100;
            $service = 'Course';
            Wallet::create([
                'student_id' => auth()->user()->id,
                'wallet' => -$price,
                'state' => 'Approve',
                'date' => now(),
                'payment_request_id' => $p_request->id,
            ]);
            foreach ($course->prices as $item) {
                if ( $item->price == $price ) {
                    $duration = $item->duration;
                }
            }
            $chapters = Chapter::where('course_id', $course->id)
            ->get();
    
            foreach ( $chapters as $item ) {
                PaymentOrder::create([
                    'payment_request_id' => $p_request->id,
                    'chapter_id' => $item->id,
                    'duration' => $duration,
                    'state' => 1
                ]);
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
        }
        else {
            
        foreach ($course->prices as $item) {
            if ( $item->price == $price ) {
                $duration = $item->duration;
            }
        }
        $chapters = Chapter::where('course_id', $course->id)
        ->get();

        if ( !empty(Cookie::get('affilate')) ) {
            $commision = 0;
            $commision = Commission::where('name', 'Course')
            ->where('user_id', intval(Cookie::get('affilate')))
            ->where('state', 1)
            ->first();
            $commision = empty($commision) ? 0 : $commision->precentage;
            $commision = $price * $commision / 100;
            $service = 'Course';
                
            AffilateRequest::create([
                'affilate_id' => intval(Cookie::get('affilate')),
                'service' => $service,
                'earned' => $commision,
                'payment_req_id' => $p_request->id
            ]);
        }

        foreach ( $chapters as $item ) {
            PaymentOrder::create([
                'payment_request_id' => $p_request->id,
                'chapter_id' => $item->id,
                'duration' => $duration,
            ]);
        }
        }
        
        $p_method = isset($p_request->method->payment) ? $p_request->method->payment : 'Wallet';
        return view('Visitor.C_Order.Order', compact('course', 'price', 'p_method'));
    }

    public function remove_course_package( $id ){
        $chapters = json_decode(Session::get('marketing'));
       
        $price = json_decode(Cookie::get('chapters_price'));
        $arr = [];
        $price = 0;
        foreach ($chapters as $item) {
            if ( $item->id != $id ) {
                $arr[] = $item;
                $price += $item->ch_price;
            }
        }
        $arr = json_encode($arr);
        Session::put('marketing', $arr);
        Cookie::queue('chapters_price', $price, 10000);
        $chapters_price = $price;
        $chapters = json_decode(Session::get('marketing'));
        return view('Visitor.Cart', compact('chapters', 'chapters_price'));
    }

    public function sel_duration_course( Request $req ){
        $price = 0;
        $arr = [];
        foreach ( $req->data as $item ) {
            $price += floatval($item['price']);
            $ch_arr = json_decode($item['chapter']);
            $ch_arr->ch_price = floatval($item['price']);
            $arr[] = $ch_arr;
        }
        $arr = json_encode($arr);

        Session::put('marketing', json_encode($arr));
        Cookie::queue('chapters_price', $price, 10000);
        return response()->json([
            'req' => $arr
        ]);
    }

    public function api_courses_data( Request $req ){
        if ( !intval($req->chapters[0]) ) {
            return response()->json([
                'chapters' => 0,
                'lessons' => 0,
                'questions' => 0,
                'videos' => 0,
                'pdf' => 0,
                'quizs' => 0,
            ]);
        }
        $chapters = Chapter::whereIn('id', $req->chapters)
        ->pluck('id');
        $lessons = Lesson::whereIn('chapter_id', $chapters)
        ->pluck('id');
        $questions = Question::whereIn('lesson_id', $lessons)
        ->pluck('id');
        $videos_pdf = IdeaLesson::whereIn('lesson_id', $lessons)
        ->pluck('id');
        $quizs = quizze::whereIn('lesson_id', $lessons)
        ->pluck('id');

        return response()->json([
            'chapters' => count($chapters),
            'lessons' => count($lessons),
            'questions' => count($questions),
            'videos' => count($videos_pdf),
            'pdf' => count($videos_pdf),
            'quizs' => count($quizs),
        ]);
    }

    public function api_chechout_description( Request $req ){
        $description = PaymentMethod::
        select('description')
        ->where('id', $req->id)
        ->first();

        return response()->json($description );
    }
    
}
