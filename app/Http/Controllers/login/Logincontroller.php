<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Sign_upEmail;

use App\Models\User;
use App\Models\ConfirmSign;
use App\Models\LoginUser;
use App\Models\Country;
use App\Models\City;
use App\Models\Currancy;
use App\Models\Wallet;
use Illuminate\Support\Facades\Cookie;

use Carbon\Carbon;

class Logincontroller extends Controller
{
        
        public function __construct(
                private Wallet $wallet,
                private Currancy $currancy,
                
                ){}
        public function index( Request $request ){
                $now = Carbon::now();
                $timeMinus120Minutes = $now->subMinutes(300);
                $value = Cookie::get('device_id');
                if ( empty($value) ) {
                        $value = rand(1, 99999999999);
                        Cookie::queue(Cookie::make('device_id', $value, 60 * 24 * 365));
                }

                if ( auth()->user() ) {
                        $l_user = LoginUser::
                        where('type', 'web')
                        ->where('user_id', auth()->user()->id)
                        ->where('created_at', '>=', $timeMinus120Minutes)
                        ->first();
                }
                if ( isset($l_user) && isset(auth()->user()->position) && auth()->user()->position == 'student' ) {
                        return redirect()->route('stu_dashboard');
                }
                if ( isset($l_user) && isset(auth()->user()->position) && auth()->user()->position == 'user_admin' ) {
                        return redirect()->route('dashboard');
                }
                if ( isset($l_user) && isset(auth()->user()->position) && auth()->user()->position == 'admin' ) {
                        return redirect()->route('dashboard');
                }
                if ( isset($l_user) && isset(auth()->user()->position) && auth()->user()->position == 'teacher' ) {
                        return redirect()->route('t_dashboard');
                }
                if ( isset($l_user) && isset(auth()->user()->position) && auth()->user()->position == 'affilate' ) {
                        return redirect()->route('stu_affilate');
                }
                LoginUser::
                where('ip', $value)
                ->delete();
                return view('pages.authanticated.login');            
        }

        public function store(Request $request){
                
                $request->validate([
                'email'=> 'required|email',
                'password'=> 'required'
                ],[
                'email.required'=> 'Email or Password Invalid',
                'email.email'=> 'Email or Password Invalid',
                'password.required'=> 'Email or Password Invalid',
                ]);


                        $user = User::where('email',$request->input('email'))->first();
                        if(!$user){
                                return redirect()->route('login.index')->withErrors(['error'=>'The Email or Password Invalid']);

                        }
                        if ($user->state == 'hidden') {
                                return redirect()->route('login.index')->withErrors(['error'=>'The Email Is Not Enable']);
                        }
                        if(!password_verify($request->input('password'),$user->password)){
                                return redirect()->route('login.index')->withErrors(['error'=>'The  Password Invalid']);
                        }
                        $now = Carbon::now();
                        $timeMinus120Minutes = $now->subMinutes(300);
                        if ( auth()->user() ) {
                                $l_user = LoginUser::
                                where('type', 'web') 
                                ->where('user_id', $user->id)
                                ->where('created_at', '>=', $timeMinus120Minutes)
                                ->first();
                                if ( $l_user ) {
                                        return redirect()->route('login.index')->withErrors(['error'=>'You are logged in from another device.']);
                                }
                        }

			Auth::loginUsingId($user->id);

                        $credentials = $request->only('email','password');

                                
                        $authantecated = Auth::attempt($credentials);
                        
                        if($authantecated){
                                $user = User::where('email',$request->email)->first();
                                $token = $user->createToken("user")->plainTextToken;
                                $user->token =$token ;

                                $current_url = Cookie::get('previous_page'); 
                                if ($current_url) {
                                        Cookie::queue(Cookie::forget('previous_page'));
                                        return redirect($current_url);
                                }
                                $value = Cookie::get('device_id');
                                if ( empty($value) ) {
                                        $value = rand(1, 99999999999);
                                        Cookie::queue(Cookie::make('device_id', $value, 60 * 24 * 365));
                                }
                                LoginUser::create([
                                        'type' => 'web',
                                        'user_id'=> $user->id,
                                        'ip' => $value,
                                ]);
                                if( $user->position == 'admin'){
                                        return redirect()->route('dashboard')->with(['success'=>'Loged In']);
                                }
                                elseif( $user->position == 'user_admin'){
                                        return redirect()->route('dashboard')->with(['success'=>'Loged In']);
                                }
                                elseif( $user->position == 'teacher'){
                                        return redirect()->route('t_dashboard')->with(['success'=>'Loged In']);
                               }
                               elseif( $user->position == 'student'){
                                        return redirect()->route('stu_dashboard');
                               }
                               elseif( $user->position == 'affilate'){
                                        return redirect()->route('stu_affilate');
                               }
                                return view();
                        }
                        if(!$authantecated){
                                return redirect()->route('login.index')->withErrors(['error'=>'The Email or Password Invalid']);
                        }

                           
        }
        

        public function market_login(Request $request){
                $request->validate([
                'email'=> 'required|email',
                'password'=> 'required'
                ],[
                'email.required'=> 'Email or Password Invalid',
                'email.email'=> 'Email or Password Invalid',
                'password.required'=> 'Email or Password Invalid',
                ]);

                        $user = User::where('email',$request->input('email'))->first();
                        if(!$user){
                                return view('Visitor.Login.login');

                        }
                        if ($user->state == 'hidden') {
                                return view('Visitor.Login.login');
                        }
                        if(!password_verify($request->input('password'),$user->password)){
                                return view('Visitor.Login.login');

                        }
                        $now = Carbon::now();
                        $timeMinus120Minutes = $now->subMinutes(300);
                        $value = Cookie::get('device_id');
                        if ( empty($value) ) {
                                $value = rand(1, 99999999999);
                                Cookie::queue(Cookie::make('device_id', $value, 60 * 24 * 365));
                        }
                        if ( auth()->user() ) {
                                $l_user = LoginUser::
                                where('type', 'web') 
                                ->where('user_id', $user->id)
                                ->where('created_at', '>=', $timeMinus120Minutes)
                                ->first();
                                if ( !empty($l_user) ) {
                                        return view('Visitor.Login.login');
                                }
                        }
                        LoginUser::
                        where('ip', $value)
                        ->delete();
			Auth::loginUsingId($user->id);

                        $credentials = $request->only('email','password');

                                
                        $authantecated = Auth::attempt($credentials);
                        
                        if($authantecated){
                                $user = User::where('email',$request->email)->first();
                                $token = $user->createToken("user")->plainTextToken;
                                $user->token =$token ;

                                $value = Cookie::get('device_id');
                                if ( empty($value) ) {
                                        $value = rand(1, 99999999999);
                                        Cookie::queue(Cookie::make('device_id', $value, 60 * 24 * 365));
                                }
                                LoginUser::create([
                                'type' => 'web', 
                                'user_id'=> $user->id,
                                'ip' => $value,
                                ]);
                                
                                if( $user->position == 'admin'){
                                        return redirect()->route('course_payment');
                                }
                                elseif( $user->position == 'user_admin'){
                                        return redirect()->route('course_payment');
                                }
                                elseif( $user->position == 'teacher'){
                                        return redirect()->route('course_payment');
                                }
                                elseif( $user->position == 'student'){
                                        return redirect()->route('course_payment');
                                }
                                return view();
                        }
                        if(!$authantecated){
                                return view('Visitor.Login.login');
                        }

                           
        }
        
        public function destroy(){
                if ( auth()->user() && !empty( auth()->user()) ) {
                        LoginUser::where('type' , 'web')
                        ->where('user_id', auth()->user()->id)
                        ->delete();
                        Auth::logout();
                        return redirect()->route('login.index');
                }
                else{
                        return redirect()->route('login.index');
                }

        } 
        public function delete_account($id){
                if ( auth()->user() && !empty( auth()->user()) ) {
                        LoginUser::where('type' , 'web')
                        ->where('user_id', auth()->user()->id)
                        ->delete();
                        Auth::logout();
                        return redirect()->route('login.index');
                }
                else{
                        return redirect()->route('login.index');
                }

        } 

        public function sign_up(){
               $countries = Country::all();
                $cities = City::all();
                return view('pages.authanticated.sign_up', 
                compact('countries', 'cities'));
        }

        public function sign_up_add( Request $req ){

                session()->flash('data', $req->all());
                $req->validate([
                        'f_name'=>'required',
                        'l_name'=>'required',
                        'nick_name'=>'required',
                        'phone'=>'required',
                        'email' => 'email|required'
                ]);
                        
                if ( $req->password != $req->conf_password ) {
                        session()->flash('faild','Confirm Password Wrong');
                        return redirect()->back();
                }
                 
                $arr = $req->only('f_name', 'l_name', 'email', 'nick_name', 'phone', 'city_id', 'grade');
                $arr['position'] = 'student';
                $arr['state'] = 'Show';
                $arr['password'] = bcrypt($req->password);
                $code = rand(0, 10000);

                $email = $arr['email'];
                $nick_name = User::where('nick_name',$req->nick_name)->first();
                $check = User::where('email',$email)->first();

                if( !empty($nick_name) ){
                        return redirect()->back()->withErrors(['nick_name'=>'This Nick Name Already Exist']) ; 
                }
                if( !empty($check) ){
                        return redirect()->back()->withErrors(['email'=>'This Email Already Exist']) ; 
                }
                $user = User::create($arr);
                
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
                 'type' => 'web', 
                 'user_id'=> $user->id,
                 'ip' => $value,
                ]);

                return redirect()->route('stu_dashboard');
        }

        public function signup_confirm( Request $req ){
                $user = ConfirmSign::where('code', $req->code)
                ->where('email', $req->email)
                ->first();

                if ( !empty($user) ) {
                        User::where('email', $req->email)
                        ->update([
                                'state' => 'Show'
                        ]);
                        return redirect()->route('login.index');
                }
        }

        public function profile_confirm(Request $req){
                if ( $req->type == 'extra' ) {
                        User::where('id', $req->user_id)
                        ->update([
                                'extra_email' => $req->email
                        ]);
                }
                if ( $req->type == 'parent' ) {
                        User::where('id', $req->user_id)
                        ->update([
                                'parent_email' => $req->email
                        ]);
                }

                return redirect()->route('stu_dashboard');
        }

}
