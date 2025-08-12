<?php

namespace App\Http\Controllers\Api\User\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\trait\Image;
use Illuminate\Support\Facades\Cookie;
use App\service\PaymentPaymob;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentEmail;

use App\Models\Category;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\IdeaLesson;
use App\Models\quizze;
use App\Models\UsagePromo;
use App\Models\PromoCode;
use App\Models\PromoCourse;
use App\Models\PaymentMethod;

class CourseController extends Controller
{
    public function __construct(private Category $categories,
    private Lesson $lessons, private Question $questions,
    private quizze $quiz, private IdeaLesson $idea,
    private UsagePromo $usage_promo,
    private PromoCode $promo_code,
    private PromoCourse $promo_course,
    private PaymentMethod $payment_method,
    private Course $course,
    private Chapter $chapters){}
    use Image;
    use PaymentPaymob;

    public function lists(Request $request){
        
        $lessons_db = $this->lessons;
        $questions_db = $this->questions;
        $quiz_db = $this->quiz;
        $idea_db = $this->idea;
        $categories = $this->categories
        ->with(['courses.chapter.lessons'])
        ->get()
        ->map(function($item)
        use($lessons_db, $questions_db, $quiz_db, $idea_db){
            return [
                'id' => $item->id,
                'category_name' => $item->cate_name,
                'category_description' => $item->cate_des,
                'category_image' => $item->image_link,
                'teacher' => $item?->teacher?->nick_name,
                'course' => $item?->courses?->map(function($element)
                use($lessons_db, $questions_db, $quiz_db, $idea_db){
                    $chapters_ids = $element->chapter->pluck('id');
                    $chapters = $chapters_ids->count();
                    $lessons = $lessons_db
                    ->whereIn('chapter_id', $chapters_ids)
                    ->pluck('id');
                    $questions = $questions_db
                    ->whereIn('lesson_id', $lessons)
                    ->count();
                    $quiz = $quiz_db
                    ->whereIn('lesson_id', $lessons)
                    ->count();
                    $ideas = $idea_db
                    ->whereIn('lesson_id', $lessons)
                    ->count();
                    return [
                        'id' => $element->id,
                                    
                        'videos_count' => $ideas,
                        'chapters_count' => $chapters,
                        'lessons_count' => $lessons->count(),
                        'questions_count' => $questions,
                        'quizs_count' => $quiz,
                        'pdfs_count' => $ideas,

                        'price' => $element?->prices?->min('price'),
                        'all_prices' => $element?->prices,
                        'course_name' => $element->course_name,
                        'course_description' => $element->course_des,
                        'course_image' => $element->image_link,
                        'teacher' => $element?->teacher?->nick_name,
                        'chapters' => $element->chapter->map(function($item2){
                            return [
                                'id' => $item2->id,
                                'chapter_price' => $item2?->price?->min('price'),
                                'chapter_all_prices' => $item2?->price,
                                'chapter_name' => $item2->chapter_name,
                                'lessons' => $item2->lessons
                                ->map(function($element2){
                                    return [
                                        'id' => $element2->id,
                                        'lesson_name' => $element2->lesson_name,
                                    ];
                                })
                            ];
                        })
                    ];
                }),
            ];
        });
        $payment_methods = $this->payment_method
        ->where('statue', 1)
        ->get();

        return response()->json([
            'categories' => $categories,
            'payment_methods' => $payment_methods,
        ]);
    }

    public function chaters_data(Request $request){
        $validator = Validator::make($request->all(), [ 
            'chapter_ids' => 'array|required',
            'chapter_ids.*' => 'required|exists:chapters,id',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        } 
        $chapters = count($request->chapter_ids);
        $lessons = $this->lessons
        ->whereIn('chapter_id', $request->chapter_ids)
        ->pluck('id');
        $questions = $this->questions
        ->whereIn('lesson_id', $lessons)
        ->count();
        $quiz = $this->quiz
        ->whereIn('lesson_id', $lessons)
        ->count();
        $ideas = $this->idea
        ->whereIn('lesson_id', $lessons)
        ->count();
        
        return response()->json([
            'videos' => $ideas,
            'chapters' => $chapters,
            'lessons' => $lessons->count(),
            'questions' => $questions,
            'quizs' => $quiz,
            'pdfs' => $ideas,
        ]);
    }

    public function use_promocode( Request $request ){
        $validator = Validator::make($request->all(), [ 
            'promo_code' => 'required',
            'course_id' => 'required|exists:courses,id',
            'amount' => 'required|numeric',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        } 
        $course_id = $request->course_id;

        $uses = $this->usage_promo
        ->where('user_id',$request->user()->id)
        ->where('promo', $request->promo_code)
        ->first();

        if ( empty($uses) ) {
            $promo = $this->promo_code
            ->where('starts', '<=', date('Y-m-d'))
            ->where('ends', '>=', date('Y-m-d'))
            ->where('num_usage', '>', 0)
            ->where('code', $request->promo_code)
            ->first();
            if ( !empty($promo) ) {
                $promo_course = $this->promo_course
                ->where('promo_id', $promo->id)
                ->where('course_id', $course_id)
                ->first();
                if ( !empty($promo_course) ) {
                    $price = $request->amount;
                    $price = $price - $price * $promo->discount	/ 100;
                    $this->promo_code
                    ->where('id', $promo->id)
                    ->update([
                        'num_usage' => $promo->num_usage - 1
                    ]);
                    $this->usage_promo
                    ->create([
                        'user_id' => $request->user()->id,
                        'promo_id' => $promo->id,
                        'promo' => $request->promo_code
                    ]); 
                    $payment_methods = $this->payment_method
                    ->where('statue', 1)
                    ->get();
                    
                    return response()->json([
                        'payment_methods' => $payment_methods,
                        'new_price' => $price,
                    ]);
                }
            }
        } 

        return response()->json([
            'errors' => 'Promo Code is Expired'
        ], 400); 
    }

    public function buy_course(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|exists:courses,id',
            'amount' => 'required|numeric',
            'payment_method_id' => 'required|exists:payment_method,id',
            'duration' => 'required|numeric',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        } 
        $price = $request->amount;
        $course = $request->course_id;
        $payment_methods = PaymentMethod::
        where('statue', 1)
        ->where('id',$request->payment_method_id)
        ->first();
        $paymentRequest['price'] = $price;
        $paymentRequest['user_id'] = $request->user()->id;
        $img_state = true;
        $duration = $request->duration;
 
        $img_name = null; 
        if ( $request->image ) { 
            $img_state = false;
            $image_path = $this->store_base64($request->image, 'images/payment_reset');
            $paymentRequest['image'] = $image_path;
        }
        $course = $this->course
        ->where('id', $request->course_id)
        ->with(['prices' => function($query) use($duration){
            $query->where('duration', $duration)
            ->first();
        }])
        ->first();
        $price = $request->amount;

        //   Start Make Paymob Credit
        if(isset($payment_methods->payment)){ 
            if($payment_methods->payment == "Paymob"){
                $user = auth()->user();
                $commision = intval(Cookie::get('affilate'));
                $payment_link = $this->credit_mobile($user,$payment_methods,$course,$price,'Course',$commision);

                return response()->json([
                    'payment_link' => $payment_link
                ]);
            }
        }
        //   End Make Paymob Credit 
        if ( $request->payment_method_id == 'Wallet' ) {
            $wallet = Wallet::
            where('student_id', auth()->user()->id)
            ->where('state', 'Approve')
            ->sum('wallet'); 

            if ( $wallet < $price ) {
                return response()->json([
                    'errors' => 'You need to charge wallet'
                ], 400);
            }
           
            $paymentRequest['state'] = 'Approve'; 
            
        } 
        elseif ( $img_state ) { 
            return response()->json([
                'errors' => 'You must upload receipt'
            ], 400);
        }
        else{ 
            $paymentRequest['payment_method_id'] = $request->payment_method_id;
            Mail::To('Payment@mathshouse.net')
            ->send(new PaymentEmail($request->all(), auth()->user()));
        }
        $p_request = PaymentRequest::create($paymentRequest);
        $duration = $request->duration;

        
        if ( $request->payment_method_id == 'Wallet' ) { 
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
        }
        else { 
        $chapters = Chapter::where('course_id', $course->id)
        ->get();

        foreach ( $chapters as $item ) {
            PaymentOrder::create([
                'payment_request_id' => $p_request->id,
                'chapter_id' => $item->id,
                'duration' => $duration,
            ]);
        }
        }
        
        $p_method = isset($p_request->method->payment) ? $p_request->method->payment : 'Wallet';
        return response()->json([
            'course' => $course,
            'payment_method' => $p_method,
            'price' => $price,
        ]);
    }

    public function buy_chapters(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|exists:courses,id',
            'chapters' => 'required|array',
            'chapters.chapter_id' => 'required|exists:chapters,id',
            'chapters.duration' => 'required|numeric',
            'amount' => 'required|numeric',
            'payment_method_id' => 'required|exists:payment_method,id', 
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        } 
        $price = $request->amount;
        $course = $request->course_id;
        $payment_methods = PaymentMethod::
        where('statue', 1)
        ->where('id',$request->payment_method_id)
        ->first();
        $paymentRequest['price'] = $price;
        $paymentRequest['user_id'] = $request->user()->id;
        $img_state = true;
        $img_name = null;
        $payment = $payment_methods?->payment;
 
        if ( $request->image ) { 
            $img_state = false;
            $image_path = $this->store_base64($request->image, 'images/payment_reset');
            $paymentRequest['image'] = $image_path;
        }
        $chapters = [];
        foreach ($request->chapters as $item) {
            $duration =  $item['duration'];
            $chapter_item = $this->chapters
            ->whereIn('id', $item['chapter_id'])
            ->with(['price' => function($query) use($duration){
                $query->where('duration', $duration)
                ->first();
            }])
            ->first();
            $chapter_item->duration = $duration;
            $chapters[] = $chapter_item;
        }
        $chapters = collect($chapters); 
        $price = $request->amount;
        if ( $request->payment_method_id == 'Wallet' ) {
            $wallet = Wallet::
            where('student_id', auth()->user()->id)
            ->where('state', 'Approve')
            ->sum('wallet');
            
            if ( $wallet < $price ) {
                return response()->json([
                    'errors' => 'You must recharge wallet'
                ], 400);
            }
            $paymentRequest['state'] = 'Approve'; 
        }
        elseif ( $img_state ) {
            return response()->json([
                'errors' => 'You Must Upload Receipt'
            ], 400);
        
        }
        else{ 
            $paymentRequest['payment_method_id'] = $request->payment_method_id;
            Mail::To('Payment@mathshouse.net')
            ->send(new PaymentEmail($request->all(), auth()->user()));
        }
        if( $payment == "Paymob"){
            $user=auth()->user();
            $payment_link = $this->credit_mobile($user,$paymentMethod,$chapters,$price,'Chapters');
            return response()->json([
                'payment_link' => $payment_link
            ]);
        }else{
        $p_request = PaymentRequest::create($paymentRequest);

        }
        if ( $request->payment_method_id == 'Wallet' ) {
            Wallet::create([
                'student_id' => auth()->user()->id,
                'wallet' => -$price,
                'state' => 'Approve',
                'date' => now(),
                'payment_request_id' => $p_request->id,
            ]);
            $p_method = isset($p_request->method->payment) ? $p_request->method->payment : 'Wallet';
            $duration = 0; 
            for ($i=0, $end = count($chapters); $i < $end; $i++) {
                PaymentOrder::create( 
                    ['payment_request_id' => $p_request->id,
                    'chapter_id' => $chapters[$i]->id,
                    'duration' => $$chapters[$i]->duration,
                    'state' => 1]);
            } 
        }
        else {
            
            $p_method = isset($p_request->method->payment) ? $p_request->method->payment : 'Wallet';
            $duration = 0; 
            for ($i=0, $end = count($chapters); $i < $end; $i++) {
                PaymentOrder::create( 
                ['payment_request_id' => $p_request->id,
                'chapter_id' => $chapters[$i]->id,
                'duration' => $chapters[$i]->duration,]);
            }
        }
        
        return response()->json([
            'price' => $price,
            'p_method' => $p_method,
            'chapters' => $chapters,
        ]);
    }
}
