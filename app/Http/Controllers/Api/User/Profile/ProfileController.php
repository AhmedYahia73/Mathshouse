<?php

namespace App\Http\Controllers\Api\User\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\trait\Image;

use App\Models\User;

class ProfileController extends Controller
{
    public function __construct(private User $user){}
    use Image;

    public function view(Request $request){ 
        $user = $request->user()
        ->select('f_name', 'l_name', 'nick_name', 'email', 'phone', 'parent_phone', 'parent_email',
        'grade', 'image_link');

        return response()->json([
            'student' => $user
        ]);
    }

    public function update_profile(Request $request){
        $validator = Validator::make($request->all(), [
            'nick_name' => 'unique:users,nick_name,' . $request->user()->id,
            'email' => 'unique:users,email,' . $request->user()->id,
            'phone' => 'unique:users,phone,' . $request->user()->id,
            'parent_phone' => 'unique:users,parent_phone,' . $request->user()->id,
            'parent_email' => 'unique:users,parent_email,' . $request->user()->id,
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        $user = $request->user();
        $user->f_name = $request->f_name ?? $user->f_name;
        $user->l_name = $request->l_name ?? $user->l_name;
        $user->nick_name = $request->nick_name ?? $user->nick_name;
        $user->email = $request->email ?? $user->email;
        $user->phone = $request->phone ?? $user->phone;
        $user->parent_phone = $request->parent_phone ?? $user->parent_phone;
        $user->parent_email = $request->parent_email ?? $user->parent_email;
        $user->grade = $request->grade ?? $user->grade;
        if($request->image){
            $image_path = $this->store_base64($request->image, 'images/users');
            $user->image = $image_path;
        }
        $user->save();

        return response()->json([
            'success' => 'You update your profile'
        ]);
    }
}
