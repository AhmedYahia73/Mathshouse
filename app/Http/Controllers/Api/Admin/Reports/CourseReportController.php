<?php

namespace App\Http\Controllers\Api\Admin\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class CourseReportController extends Controller
{
    public function __construct(private User $users){}

    public function view(Request $request){
        $users = $this->users
        ->with([
            'payment_req_approve' => function ($query) {
                $query->where('module', 'Chapters')
                    ->with(['chapters_order.chapter.course']);
            }
        ])
        ->whereHas('payment_req_approve.chapters_order.chapter.course')
        ->get()
        ->map(function ($user) {
            return [
                'id' => $user->id,
                'f_name' => $user->f_name,
                'l_name' => $user->l_name,
                'nick_name' => $user->nick_name,
                'courses' => $user->payment_req_approve
                    ->flatMap(function ($payment) {
                        return $payment->chapters_order->map(function ($order) {
                            if ($order->chapter && $order->chapter->course) {
                                return [
                                    'course_name' => $order->chapter->course->course_name
                                ];
                            }
                            return null;
                        })->filter(); // remove nulls
                    })->values(),
            ];
        });

        $categories = Category::all();
        $courses = Course::all();

        return response()->json([
            'users' => $users,
            'categories' => $categories,
            'courses' => $courses,
        ]);
    }

    public function filter(Request $request){
        $validator = Validator::make($request->all(), [
            'category_id' => ['required', 'exists:categories,id'],
            'course_id' => ['exists:courses,id'],
        ]);
        if ($validator->fails()) { 
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        if($request->course_id){
            $users = $this->users
            ->with([
                'payment_req_approve' => function ($query) use($request){
                    $query->where('module', 'Chapters')
                        ->with(['chapters_order.chapter.course' => function($query) use($request){
                            $query->where('id', $request->course_id);
                        }]);
                }
            ])
            ->whereHas('payment_req_approve.chapters_order.chapter.course', function($query) use($request){
                $query->where('id', $request->course_id);
            })
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'f_name' => $user->f_name,
                    'l_name' => $user->l_name,
                    'nick_name' => $user->nick_name,
                    'courses' => $user->payment_req_approve
                        ->flatMap(function ($payment) {
                            return $payment->chapters_order->map(function ($order) {
                                if ($order->chapter && $order->chapter->course) {
                                    return [
                                        'course_name' => $order->chapter->course->course_name
                                    ];
                                }
                                return null;
                            })->filter(); // remove nulls
                        })->values(),
                ];
            });
        }
        else{
            $users = $this->users
            ->with([
                'payment_req_approve' => function ($query) use($request){
                    $query->where('module', 'Chapters')
                        ->with(['chapters_order.chapter.course' => function($query) use($request){
                            $query->where('category_id', $request->category_id);
                        }]);
                }
            ])
            ->whereHas('payment_req_approve.chapters_order.chapter.course', function($query) use($request){
                $query->where('category_id', $request->category_id);
            })
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'f_name' => $user->f_name,
                    'l_name' => $user->l_name,
                    'nick_name' => $user->nick_name,
                    'courses' => $user->payment_req_approve
                        ->flatMap(function ($payment) {
                            return $payment->chapters_order->map(function ($order) {
                                if ($order->chapter && $order->chapter->course) {
                                    return [
                                        'course_name' => $order->chapter->course->course_name
                                    ];
                                }
                                return null;
                            })->filter(); // remove nulls
                        })->values(),
                ];
            });
        }

        return response()->json([
            'users' => $users
        ]);
    }
}
