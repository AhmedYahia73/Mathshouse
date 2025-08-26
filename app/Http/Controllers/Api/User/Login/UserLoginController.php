<?php

namespace App\Http\Controllers\Api\User\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyEmail;
use App\Mail\Sign_upEmail;
use Illuminate\Support\Facades\Cookie;
use App\Mail\ForgetPassword as ForgetPasswordEmail;

use App\Models\ForgetPassword;
use App\Models\LoginUser;
use App\Models\User;
use App\Models\Country;
use App\Models\Category;
use App\Models\Wallet;
use App\Models\Currancy;
use App\Models\City;

class UserLoginController extends Controller
{
// /user/login
// email, password
// /user/logout
// user/forget_password
// keys => user
// يكتب الايميل او التليفون
// /user/confirm_code
// keys
// code, user
// user/update_password
// keys
// user, code, password

    public function __construct(
        private Wallet $wallet,
        private Currancy $currancy,
    
    ){}

    public function sign_up_lists(){
        $countries = Country::
        select('id', 'name')
        ->get();
        $categories = Category::
        select('id', 'cate_name')
        ->get();
        $cities = City::
        select('id', 'city', 'country_id')
        ->get();

        return response()->json([
            'countries' => $countries,
            'categories' => $categories,
            'cities' => $cities,
        ]);
    }
    
    public function sign_up(Request $request){
        $validator = Validator::make($request->all(), [
            'f_name' => 'required',
            'l_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'nick_name' => 'required|unique:users,nick_name',
            'phone' => 'required|unique:users,phone',
            'city_id' => 'required|exists:cities,id',
            'country_id' => 'required|exists:countries,id',
            'category_id' => 'required|exists:categories,id',
            'grade' => 'required|numeric',
            'password' => 'required',
            'conf_password' => 'required|same:password',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $userRequest = $validator->validated();
        $userRequest['position'] = 'student';
        $userRequest['state'] = 'Show';
        $userRequest['password'] = bcrypt($request->password);
        $user = User::create($userRequest);

        $token = $user->createToken("user")->plainTextToken;
        $user->token =$token ;
        $user = Auth::loginUsingId($user->id);
                // Start Make Two Wallet EGP and USD
        $dolar = $this->currancy->select('id')->where('currency', 'USD')->first();
        $pound = $this->currancy->select('id')->where('currency', 'EGP')->first();
        $userWallet = [
                ['student_id'=>$user->id,'wallet'=>0,'date'=>now(),'currency_id'=>$dolar->id],
                ['student_id'=>$user->id,'wallet'=>0,'date'=>now(),'currency_id'=>$pound->id]
        ];
        $this->wallet->insert($userWallet);
        $value = Cookie::get('device_id');
        if ( empty($value) ) {
            $value = rand(1, 99999999999);
            Cookie::queue(Cookie::make('device_id', $value, 60 * 24 * 365));
        }
        LoginUser::create([
            'type' => 'mobile', 
            'user_id'=> $user->id,
        ]);

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

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
            $user_login = LoginUser::
            where('user_id', $user->id)
            ->where('type', 'mobile')
            ->first();
            // if(!empty($user_login)){
            //     return response()->json([
            //         'errors' => 'You login from another device'
            //     ], 400);
            // }

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
        if(!empty($user->position)){
            LoginUser::where('type', 'mobile')
            ->where('user_id', $user->id)
            ->delete();
        }
        $user = Auth::user();
        $request->user();
        if (empty($user)) {
            return response()->json(['faild' => 'You are not Login'], 403);
        }
        if ($user->tokens()->delete()) {
            return response()->json(['success' => 'Logout Success'], 200);
        }
    }

    public function delete(Request $request){
        User::
        where('id', $request->user()->id)
        ->delete();

        return response()->json([
            'success' => 'You delete account success'
        ]);
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
        $user = User::where('email', $request->user)
            ->orWhere('phone', $request->user)
            ->first();

        if (!empty($user)) {
            $code = rand(100000, 999999);
            ForgetPassword::create([
                'user_id' => $user->id,
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
        $user = User::where('email', $request->user)
        ->orWhere('phone', $request->user)
        ->first(); 
        $confirm = ForgetPassword::where('user_id', $user->id)
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
        $user = User::where('email', $request->user)
            ->orWhere('phone', $request->user)
            ->first();

        $confirm = ForgetPassword::where('user_id', $user->id)
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
