<?php

namespace App\Http\Controllers\Api\Admin\Package;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Course;
use App\Models\Package;
use App\Models\PaymentPackageOrder;
use App\Models\SmallPackage;

use Carbon\Carbon;

class PackageReportController extends Controller
{
    public function __construct(private Course $course,
    private SmallPackage $small_package,
    private PaymentPackageOrder $payment_package_order){}

    public function lists(Request $request){
        $packages = Package::all();
        $small_package = $this->small_package;
        $payment_package_order = $this->payment_package_order;
        $courses = $this->course;
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
        $course = $this->course;
        $students = User::
        select('id', 'nick_name', 'phone')
        ->with('payment_package.package_order.package', 'small_package',
            'exams_history', 'questions_history', 'lives_history')
        ->get()
        ->map(function($item) use($course, $small_package){
            $small_package = $small_package->where('user_id', auth()->user()->id)
            ->get();
            $s_exams = $small_package->where('module', 'Exam')->sum('number');
            $s_questions = $small_package->where('module', 'Question')->sum('number');
            $s_live = $small_package->where('module', 'Live')->sum('number');
            $exam = $payment_package_order->
            leftJoin('payment_requests', 'payment_package_order.payment_request_id', '=', 'payment_requests.id')
            ->leftJoin('packages', 'payment_package_order.package_id', '=', 'packages.id')
            ->where('payment_package_order.state', 1)
            ->where('packages.module', 'Exam')
            ->where('payment_package_order.user_id', auth()->user()->id)
            ->sum('payment_package_order.number') + $s_exams;
            
            $questions = $payment_package_order->
            leftJoin('payment_requests', 'payment_package_order.payment_request_id', '=', 'payment_requests.id')
            ->leftJoin('packages', 'payment_package_order.package_id', '=', 'packages.id')
            ->where('payment_package_order.state', 1)
            ->where('packages.module', 'Question')
            ->where('payment_package_order.user_id', auth()->user()->id)
            ->sum('payment_package_order.number') + $s_questions;
            
            $live = $payment_package_order->
            leftJoin('payment_requests', 'payment_package_order.payment_request_id', '=', 'payment_requests.id')
            ->leftJoin('packages', 'payment_package_order.package_id', '=', 'packages.id')
            ->where('payment_package_order.state', 1)
            ->where('packages.module', 'Live')
            ->where('payment_package_order.user_id', auth()->user()->id)
            ->sum('payment_package_order.number') + $s_live;
            
            $exam_details1 = $small_package->
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
            $live_details1 = $small_package->
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
            $question_details1 = $small_package->
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
            $courses = $courses->get();
            $live_details2 = $payment_package_order->
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
            $exam_details2 = $payment_package_order->
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
            $question_details2 = $payment_package_order->
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

            $exam_history_count = $item?->exams_history?->count() ?? 0;
            $question_history_count = $item?->questions_history?->count() ?? 0;
            $live_history_count = $item?->lives_history?->count() ?? 0;

            $exam_history = $item?->exams_history ?? [];
            $question_history = $item?->questions_history ?? [];
            $live_history = $item?->lives_history ?? [];

            $exam_history_details = [];
            $question_history_details = [];
            $live_history_details = [];

            foreach ($exam_history as $key => $element) {
                $course_id = $element?->exams?->course_id;
                $exam_history_details[$course_id] = [
                    'course' => $course->where('id', $course_id)->first()?->course_name,
                    'number' => isset($exam_history_details[$course_id]) ? 
                        ($exam_history_details[$course_id]['number'] + 1) : 1
                ];
            } 
            foreach ($question_history as $key => $element) {
                $course_id = $element?->exams?->course_id;
                $question_history_details[$course_id] = [
                    'course' => $course->where('id', $course_id)->first()?->course_name,
                    'number' => isset($question_history_details[$course_id]) ? 
                        ($question_history_details[$course_id]['number'] + 1) : 1
                ];
            } 
            foreach ($live_history as $key => $element) {
                $course_id = $element?->exams?->course_id;
                $live_history_details[$course_id] = [
                    'course' => $course->where('id', $course_id)->first()?->course_name,
                    'number' => isset($live_history_details[$course_id]) ? 
                        ($live_history_details[$course_id]['number'] + 1) : 1
                ];
            }

            return [
                'id' => $item->id,
                'nick_name' => $item->nick_name,
                'phone' => $item->phone,
                'live_count' => $live_count,
                'question_count' => $question_count,
                'exam_count' => $exam_count,
                
                'live_details' => $live_details,
                'question_details' => $question_details,
                'exam_details' => $exam_details,
                
                'exam_history_count' => $exam_history_count,
                'question_history_count' => $question_history_count,
                'live_history_count' => $live_history_count,
                
                'exam_history_details' => array_values($exam_history_details),
                'question_history_details' => array_values($question_history_details),
                'live_history_details' => array_values($live_history_details),
            ];
        });

        return response()->json([
            'students' => $students
        ]);
    }

}
