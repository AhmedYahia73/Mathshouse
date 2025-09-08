<?php

namespace App\Http\Controllers\Api\Parent\OTP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\ForgetPassword as ForgetPasswordEmail;
use Illuminate\Support\Facades\Mail;

use App\Models\ForgetPassword;
use App\Models\SupParent;

class OtpController extends Controller
{
    
    public function forget_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user' => 'required',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $user = SupParent::where('email', $request->user)
            ->orWhere('phone', $request->user)
            ->first();

        if (!empty($user)) {
            $code = rand(100000, 999999);
            ForgetPassword::create([
                'parent_id' => $user->id,
                'code' => $code,
            ]);

            Mail::To($user->email)->send(new ForgetPasswordEmail($user->id, $code));
        } else {
            return response()->json([
                'faild' => 'Email or Phone is Wrong'
            ]);
        }
    }
    

    public function confirm_code(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user' => 'required',
            'code' => 'required',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $user = SupParent::where('email', $request->user)
        ->orWhere('phone', $request->user)
        ->first(); 
        $confirm = ForgetPassword::where('parent_id', $user->id)
        ->where('code', $request->code)
        ->first();

        if (!empty($confirm)) {
            return response()->json([
                'success' => 'Congratulations Code Is Right'
            ]);
        } else {
            return response()->json([
                'faild' => 'Code Is Wrong'
            ]);
        }
    }

    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user' => 'required',
            'code' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $user = SupParent::where('email', $request->user)
            ->orWhere('phone', $request->user)
            ->first();

        $confirm = ForgetPassword::where('parent_id', $user->id)
            ->where('code', $request->code)
            ->first();

        if (!empty($confirm)) {

            $user->update(['password' => bcrypt($request->password)]);

            return response()->json([
                'success' => 'You Updated Your Password Success'
            ]);
        } else {
            return response()->json([
                'faild' => 'Code Is Wrong'
            ]);
        }
    }
}
