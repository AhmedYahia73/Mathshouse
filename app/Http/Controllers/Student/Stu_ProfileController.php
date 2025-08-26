<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Category;
use App\Mail\MyEmail;

class Stu_ProfileController extends Controller
{
    public function index(){
        $user = User::where('id', auth()->user()->id)
        ->first();
        $categories = Category::
        select('id', 'cate_name')
        ->get();
        return view('Student.Profile.Profile', compact('user', 'categories'));
    }

    public function stu_edit_profile( Request $req ){
        $img_name = null;
        extract($_FILES['image']);
        $user = User::where('id', '!=', auth()->user()->id)
        ->where('email', $req->email)
        ->first();
        if ( !empty($user) ) {
            session()->flash('faild', 'Email Is Exist Please Change It');
            return redirect()->back();
        }
        $arr = $req->only('f_name', 'l_name', 'email', 'phone', 'nick_name', 'category_id');
        if( !empty($name) ){
            $extension_arr = ['png', 'jpg', 'jpeg', 'svg', 'webp'];
            $extension = explode('.', $name);
            $extension = end($extension);
            $extension = strtolower($extension);
            if ( in_array($extension, $extension_arr) ) {
                $img_name = rand(0, 1000) . now() . $name;
                $img_name = str_replace([' ', ':', '-'], 'X', $img_name);
                $arr['image'] = $img_name;
            }
           
        }
        $emails = [];
        
        if ( !empty($req->password) ) {
            $arr['password'] = bcrypt($req->password);
        }
        if ( !empty($req->extra_email) ) {
            $email = $req->extra_email;
            $type = "extra";
            $user_id = auth()->user()->id;
            Mail::To($email)->send(new MyEmail($email, $type, $user_id));
        } 
        move_uploaded_file($tmp_name, 'images/users/' . $img_name);
        User::where('id', auth()->user()->id)
        ->update($arr);
        
        session()->flash('success', 'You update your profile success');
        return redirect()->back();
    }
    
}
