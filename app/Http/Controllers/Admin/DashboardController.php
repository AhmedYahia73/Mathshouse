<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Validator;

use App\Models\PaymentRequest;
use App\Models\Country;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        addVendors(['amcharts', 'amcharts-maps', 'amcharts-stock']);

        $payment_graph = PaymentRequest::
        selectRaw("SUM(price) as total, DATE(created_at) as date")
        ->where('state', 'Approve')
        ->groupBy(DB::raw('DATE(created_at)'))
        ->get();
                    
        $firstDate = PaymentRequest::min('created_at');
        $lastDate  = PaymentRequest::max('created_at');
 
        if (!$firstDate || !$lastDate) {
            $average = 0;
        } else {
            $firstDate = Carbon::parse($firstDate)->startOfDay();
            $lastDate  = Carbon::parse($lastDate)->endOfDay();
            $days = $firstDate->diffInDays($lastDate) + 1;

            $totalPrice = PaymentRequest::whereBetween('created_at', [$firstDate, $lastDate])
                ->sum('price');

            $average = $days > 0 ? $totalPrice / $days : 0;
        }
        $avg_payment_day = $average;
        $avg_payment_week = $average * 7;
        $avg_payment_month = $average * 30.4375;
        $avg_payment = [
            'day' => $avg_payment_day,
            'week' => $avg_payment_week,
            'month' => $avg_payment_month,
        ];
        $countries = Country::all();
        return view('Admin.Dashboards.index', compact('payment_graph', 'avg_payment', 'countries'));
    }

    public function grades_count(Request $request){
        $validator = Validator::make($request->all(), [
            'country_id'  => ['required', 'exists:countries,id'],
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $students = User::
        selectRaw('grade, category_id, COUNT(id) as students_count')
        ->whereHas('city', function($query) use($request) {
            $query->where('country_id', $request->country_id);
        })
        ->with('category:id,cate_name')
        ->groupBy('grade', 'category_id')
        ->orderBy('grade')
        ->get()
        ->groupBy('grade');

        return response()->json([
            'students' => $students
        ]);
    }
}
