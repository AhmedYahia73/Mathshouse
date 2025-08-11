<?php

namespace App\Http\Controllers\Api\User\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\Category;
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
    private PaymentMethod $payment_method){}

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

        return response()->json([
            'categories' => $categories
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
            'amount' => 'required|exists:courses,id',
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

}
