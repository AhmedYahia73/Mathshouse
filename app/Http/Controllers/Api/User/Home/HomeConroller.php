<?php

namespace App\Http\Controllers\Api\User\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PaymentPackageOrder;
use App\Models\SmallPackage;
use App\Models\Package;
use App\Models\Course;

use Carbon\Carbon;

class HomeConroller extends Controller
{
    public function __construct(){}

    public function view(Request $request){ 
        $student_data = [];
        $student_data['nick_name'] = $request->user()->nick_name;
        $student_data['grade'] = $request->user()->grade;
        $student_data['category'] = $request->user()->category?->cate_name;
        
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

        $small_package = SmallPackage::where('user_id', auth()->user()->id)
        ->get();
        $s_exams = $small_package->where('module', 'Exam')->sum('number');
        $s_questions = $small_package->where('module', 'Question')->sum('number');
        $s_live = $small_package->where('module', 'Live')->sum('number');
        $exam = PaymentPackageOrder::
        leftJoin('payment_requests', 'payment_package_order.payment_request_id', '=', 'payment_requests.id')
        ->leftJoin('packages', 'payment_package_order.package_id', '=', 'packages.id')
        ->where('payment_package_order.state', 1)
        ->where('packages.module', 'Exam')
        ->where('payment_package_order.user_id', auth()->user()->id)
        ->sum('payment_package_order.number') + $s_exams;
        
        $questions = PaymentPackageOrder::
        leftJoin('payment_requests', 'payment_package_order.payment_request_id', '=', 'payment_requests.id')
        ->leftJoin('packages', 'payment_package_order.package_id', '=', 'packages.id')
        ->where('payment_package_order.state', 1)
        ->where('packages.module', 'Question')
        ->where('payment_package_order.user_id', auth()->user()->id)
        ->sum('payment_package_order.number') + $s_questions;
        
        $live = PaymentPackageOrder::
        leftJoin('payment_requests', 'payment_package_order.payment_request_id', '=', 'payment_requests.id')
        ->leftJoin('packages', 'payment_package_order.package_id', '=', 'packages.id')
        ->where('payment_package_order.state', 1)
        ->where('packages.module', 'Live')
        ->where('payment_package_order.user_id', auth()->user()->id)
        ->sum('payment_package_order.number') + $s_live;
        
        $exam_details1 = SmallPackage::
        selectRaw('course_id, SUM(number) AS number')
        ->where('user_id', auth()->user()->id)
        ->with('course')
        ->where('module', 'Exam')
        ->groupBy('course_id')
        ->get()
        ->map(function($item){
            return [
                'course' => $item?->course?->course_name,
                'number' => $item->number
            ];
        });
        $live_details1 = SmallPackage::
        selectRaw('course_id, SUM(number) AS number')
        ->where('user_id', auth()->user()->id)
        ->with('course')
        ->where('module', 'Live')
        ->groupBy('course_id')
        ->get()
        ->map(function($item){
            return [
                'course' => $item?->course?->course_name,
                'number' => $item->number
            ];
        });
        $question_details1 = SmallPackage::
        selectRaw('course_id, SUM(number) AS number')
        ->where('user_id', auth()->user()->id)
        ->with('course')
        ->where('module', 'Question')
        ->groupBy('course_id')
        ->get()
        ->map(function($item){
            return [
                'course' => $item?->course?->course_name,
                'number' => $item->number
            ];
        });
        $courses = Course::all();
        $live_details2 = PaymentPackageOrder::
        selectRaw('sum(payment_package_order.number) as number, course_id')
        ->leftJoin('payment_requests', 'payment_package_order.payment_request_id', '=', 'payment_requests.id')
        ->leftJoin('packages', 'payment_package_order.package_id', '=', 'packages.id')
        ->where('payment_package_order.state', 1)
        ->where('packages.module', 'Live')
        ->where('payment_package_order.user_id', auth()->user()->id)
        ->groupBy('course_id')
        ->get()
        ->map(function($item) use($courses){
            $course = $courses->where('id', $item->course_id)
            ->first();
            return [
                'number' => $item?->number,
                'course' => $course?->course_name,
            ];
        });
        $exam_details2 = PaymentPackageOrder::
        selectRaw('sum(payment_package_order.number) as number, course_id')
        ->leftJoin('payment_requests', 'payment_package_order.payment_request_id', '=', 'payment_requests.id')
        ->leftJoin('packages', 'payment_package_order.package_id', '=', 'packages.id')
        ->where('payment_package_order.state', 1)
        ->where('packages.module', 'Exam')
        ->where('payment_package_order.user_id', auth()->user()->id)
        ->groupBy('course_id')
        ->get()
        ->map(function($item) use($courses){
            $course = $courses->where('id', $item->course_id)
            ->first();
            return [
                'number' => $item?->number,
                'course' => $course?->course_name,
            ];
        });
        $question_details2 = PaymentPackageOrder::
        selectRaw('sum(payment_package_order.number) as number, course_id')
        ->leftJoin('payment_requests', 'payment_package_order.payment_request_id', '=', 'payment_requests.id')
        ->leftJoin('packages', 'payment_package_order.package_id', '=', 'packages.id')
        ->where('payment_package_order.state', 1)
        ->where('packages.module', 'Question')
        ->where('payment_package_order.user_id', auth()->user()->id)
        ->groupBy('course_id')
        ->get()
        ->map(function($item) use($courses){
            $course = $courses->where('id', $item->course_id)
            ->first();
            return [
                'number' => $item?->number,
                'course' => $course?->course_name,
            ];
        });
        $live_details = collect($live_details1)->merge(collect($live_details2));
        $question_details = collect($question_details1)->merge(collect($question_details2));
        $exam_details = collect($exam_details1)->merge(collect($exam_details2));

        return response()->json([
            'student_data' => $student_data,
            'live_details' => $live_details,
            'question_details' => $question_details,
            'exam_details' => $exam_details,
            'questions' => $questions,
            'exam' => $exam,
            'lives' => $live,
        ]);
    }
}
