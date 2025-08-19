<?php

namespace App\Http\Controllers\Api\Parent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyEmail;
use App\Mail\Sign_upEmail;
use App\Mail\ForgetPassword as ForgetPasswordEmail;
use App\Models\ForgetPassword;

use App\Models\SupParent;

class ParentLoginController extends Controller
{
    public function __construct(private SupParent $parent){}

    public function sign_up(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required', 
            'email' => 'required|email|unique:sup_parents,email', 
            'phone' => 'required|unique:sup_parents,phone', 
            'password' => 'required|min:7', 
            'conf_password' => 'required|same:password', 
            // 'status' => 'required|boolean', 
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $parentRequest = $validator->validated();
        $parentRequest['password'] = bcrypt($request->password);
        $user = $this->parent
        ->create($parentRequest);
        
        $token = $user->createToken("parent")->plainTextToken;
        $user->token = $token ;

        return response()->json([
            'parent' => $user,
            'token' => $token,
        ]);
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $parent = $this->parent
        ->where('email', $request->email)
        ->orWhere('phone', $request->email)
        ->first();
       if (!empty($parent)) {
            if (!$parent->status) {
                return response()->json([
                    'errors' => ' This Account Unavailable'
                ], 400);
            }
            if (password_verify($request->input('password'), $parent->password)) { 
                $token = $parent->createToken("Parent")->plainTextToken;
                $parent->token = $token;

                return response()->json([
                    'parent' => $parent,
                    'token' => $token
                ], 200);
            }
            else{
                return response()->json(['errors' => 'Your Account Not Available'], 400);
            }
        } else {
            return response()->json(['errors' => 'Your Account Not Available'], 400);
        } 
    }

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
        $user = $this->parent
        ->where('email', $request->user)
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
                'errors' => 'Email or Phone is Wrong'
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
        $user = $this->parent
        ->where('email', $request->user)
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
                'errors' => 'Code Is Wrong'
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
        $user = $this->parent
        ->where('email', $request->user)
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
                'errors' => 'Code Is Wrong'
            ]);
        }
    }
}
