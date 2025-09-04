<?php

namespace App\Http\Controllers\Api\Admin\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(){}

    public function view(Request $request){
        $user = $request->user();

        return response()->json([
            'f_name' => $user->f_name,
            'l_name' => $user->l_name,
            'nick_name' => $user->nick_name,
            'email' => $user->email,
            'phone' => $user->phone,
        ]);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'nick_name' => 'unique:users,nick_name,' . $request->user()->id,
            'email' => 'email|unique:users,email,' . $request->user()->id,
            'phone' => 'unique:users,phone,' . $request->user()->id,
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
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return response()->json([
            'success' => 'You update your profile'
        ]);
    }
}
