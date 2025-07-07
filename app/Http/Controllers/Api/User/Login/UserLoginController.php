<?php

namespace App\Http\Controllers\Api\User\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\LoginUser;
use App\Models\User;

class UserLoginController extends Controller
{
    public function login(Request $request)
    {      
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->first();
            if ($user->state == 'hidden') {
                return response()->json([
                    'faild' => ' This Account Unavailable'
                ]);
            }
            LoginUser::create([
            'type' => 'mobile', 
            'user_id'=> $user->id]);
            $token = $user->createToken("personal access tokens")->plainTextToken;
            $user->token = $token;

            return response()->json([
                'user' => $user,
                'token' => $token
            ], 200);
        } else {
            return response()->json(['faild' => 'Your Account Not Available']);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        LoginUser::where('type', 'mobile')
        ->where('user_id', $user->id)
        ->delete();
        $user = Auth::user();
        $request->user();
        if (empty($user)) {
            return response()->json(['faild' => 'You are not Login'], 403);
        }
        if ($user->tokens()->delete()) {
            return response()->json(['success' => 'Logout Success'], 200);
        }
    }
}
