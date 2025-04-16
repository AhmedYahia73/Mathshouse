<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Package;
use App\Models\User;
use App\Models\SmallPackage;
use App\Models\Course;
use App\Models\Category;

class PackagesController extends Controller
{
    
    public function index(){
        $courses = Course::all();
        $categories = Category::all();
        $package = Package::
        orderByDesc('id')
        ->simplePaginate(10);
        return view('Admin.Packages.Packages', compact('package', 'courses', 'categories'));
    }

    public function del_package( $id ){
        Package::where('id', $id)
        ->delete();

        return redirect()->back();
    }

    public function edit_package( $id, Request $req ){
        $req->validate([
            'name'  => 'required',
            'module' => 'required',
            'number' => 'required|numeric',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
        ]);
        $arr = $req->only('name', 'module', 'number', 'price', 'duration', 'course_id');
        Package::where('id', $id)
        ->update( $arr );

        return redirect()->back();
    }

    public function add_package( Request $req ){
        $req->validate([
            'name'  => 'required',
            'module' => 'required',
            'number' => 'required|numeric',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
        ]);
        $arr = $req->only('name', 'module', 'number', 'price', 'duration', 'course_id');
        Package::create($arr);

        return redirect()->back();
    }

    public function add_stu_package(){
        $users = User::where('position', 'student')
        ->get();
        $categories = Category::all();
        $courses = Course::all();
        
        return view('Admin.Packages.Add_Package', 
        compact('users', 'categories', 'courses'));
    }

    public function stu_package_add( Request $req ){ 
        if ($req['student']['number'] < 0) {
            return response()->json([
                'errors' => 'Number must be greater than 0'
            ], 400);
        }
        SmallPackage::create([
            'module' => $req['student']['module'],
            'number' => $req['student']['number'],
            'user_id' => $req['student']['userid'],
            'admin_id' => auth()->user()->id,
        ]);
        
        return response()->json([
            'success' => 'You Add Data Success'
        ]);
    }

    public function package_history(){
        $small_packages = SmallPackage::
        orderByDesc('id')
        ->simplePaginate(10);
        $users = User::
        where('position', 'admin')
        ->orWhere('position', 'user_admin')
        ->get();

        return view('Admin.Packages.History', compact('small_packages', 'users'));
    }

    public function package_history_admin( Request $req ){
        if ( empty($req->admin_id) ) {
            $small_packages = SmallPackage::
            orderByDesc('id')
            ->simplePaginate(10);
        }
        else {
            $small_packages = SmallPackage::
            where('admin_id', $req->admin_id)
            ->orderByDesc('id')
            ->simplePaginate(10);
        }
        $users = User::
        where('position', 'admin')
        ->orWhere('position', 'user_admin')
        ->get();
        $data = $req->all();

        return view('Admin.Packages.History', compact('small_packages', 'users', 'data'));
    }

    public function package_stu_search( Request $req ){
        $users = User::
        where('nick_name', 'like', '%'. $req->name .'%')
        ->where('position', 'student')
        ->orWhere('phone', 'like', '%'. $req->name .'%')
        ->where('position', 'student')
        ->get();

        if ( count($users) == 0 || empty($users) ) {          
            return response()->json([
                'faild' => 'Data Is Empty',
            ]);
        }

        return response()->json([
            'users' => $users,
        ]);
    }

    public function add_small_package( Request $req ){
        // if ($req->number < 0) {            
        //     session()->flash('faild', 'Number must be greater than 0');
        //     return redirect()->back();
        // }
        SmallPackage::create([
            'user_id'  => $req->user_id,
            'category_id'   => $req->category_id,
            'course_id'   => $req->course_id,
            'module'   => $req->module,
            'number'   => $req->number,
            'admin_id' => auth()->user()->id,
        ]);
        
        return redirect()->back();
    }

}
