<?php

namespace App\Http\Controllers\Api\Admin\Package;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Package;
use App\Models\Course;

class PackageController extends Controller
{
    public function __construct(private Package $package,
    private Course $courses){}

    public function view(Request $request){
        $packages = $this->package
        ->with('course.category')
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'name' => $item->name,
                'module' => $item->module,
                'category' => $item?->course?->category?->cate_name,
                'course' => $item?->course?->course_name,
                'number' => $item->number,
                'duration' => $item->duration,
                'price' => $item->price,
            ];
        });
        $courses = $this->courses
        ->select('id', 'course_name')
        ->get();
        $modules = [
            'Exam',
            'Question',
            'Live',
        ];

        return response()->json([
            'packages' => $packages,
            'courses' => $courses,
            'modules' => $modules,
        ]);
    }

    public function modify(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => ['sometimes'],
            'module' => ['sometimes', 'in:Exam,Question,Live'],
            'course_id' => ['sometimes', 'exists:courses,id'],
            'number' => ['sometimes', 'numeric'],
            'price' => ['sometimes', 'numeric'],
            'duration' =>['sometimes', 'numeric'],
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        $package = $this->package
        ->where('id', $id)
        ->first();
        $package->name = $request->name ?? $package->name;
        $package->module = $request->module ?? $package->module;
        $package->course_id = $request->course_id ?? $package->course_id;
        $package->number = $request->number ?? $package->number;
        $package->price = $request->price ?? $package->price;
        $package->duration = $request->duration ?? $package->duration;
        $package->save();

        return response()->json([
            'success' => 'You update data success',
        ]);
    }
}
