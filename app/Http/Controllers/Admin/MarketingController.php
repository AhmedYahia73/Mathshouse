<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Commission;
use App\Models\User;
use App\Models\Affilate;
use App\Models\Payout;
use App\Models\PaymentMethod;
use App\Models\PromoCode;
use App\Models\PromoCourse;
use App\Models\PromoChapter;
use App\Models\PromoPackage;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Package;
use App\Models\MarketingPopup;
use App\Models\PopupPage;
use App\Models\PopupPopupPage;

class MarketingController extends Controller
{
    protected $popup_arr = ['name', 'starts', 'ends'];

    public function commission(){
        $affilate = Affilate::get();
        return view('Admin.Marketing.Commissions', compact('affilate'));
    }

    public function marketing_popup(){
        $popups = MarketingPopup::get();
        $pages = PopupPage::get();

        return view('Admin.Marketing.Popup', compact('popups', 'pages'));
    }

    public function del_popup( $id ){
        MarketingPopup::
        where('id', $id)
        ->delete();

        return redirect()->back();
    }
    
    public function edit_popup( Request $req, $id ){
        $req->validate([
            'name' => 'required',
            'starts' => 'required|date',
            'ends' => 'required|date',
        ]);
        $arr = $req->only($this->popup_arr);

        $img_name = null;
        extract($_FILES['image']);
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
        
        move_uploaded_file($tmp_name, 'images/MarketingPopup/' . $img_name);
        
        MarketingPopup::
        where('id', $id)
        ->update($arr);
        
        PopupPopupPage::where('marketing_popup_id', $id)
        ->delete();

        foreach ( $req->page_id as $item ) {
            PopupPopupPage::create([
                'marketing_popup_id' => $id,
                'popup_page_id' => $item
            ]);
        }

        return redirect()->back();

    }

    public function add_popup( Request $req ){
        $req->validate([
            'name' => 'required',
            'starts' => 'required|date',
            'ends' => 'required|date',
        ]);

        $img_name = null;
        extract($_FILES['image']);
        if( !empty($name) ){
            $extension_arr = ['png', 'jpg', 'jpeg', 'svg', 'webp'];
            $extension = explode('.', $name);
            $extension = end($extension);
            $extension = strtolower($extension);
            if ( in_array($extension, $extension_arr) ) {
                $img_name = rand(0, 1000) . now() . $name;
                $img_name = str_replace([' ', ':', '-'], 'X', $img_name);
            }
            
        }
        
        $arr = $req->only($this->popup_arr);
        $arr['image'] = $img_name;
        move_uploaded_file($tmp_name, 'images/MarketingPopup/' . $img_name);
        
        $marketing = MarketingPopup::create($arr);
        

        foreach ( $req->page_id as $item ) {
            PopupPopupPage::create([
                'marketing_popup_id' => $marketing->id,
                'popup_page_id' => $item
            ]);
        }

        return redirect()->back();

    }

    public function edit_commission( Request $req ){
        Commission::where('user_id', $req->id)
        ->delete();

        for ($i=0, $end = count($req->name); $i < $end; $i++) { 
            if ( $req->precentage[$i] != null) {
                Commission::create([
                    'user_id' => $req->id,
                    'name' => $req->name[$i],
                    'precentage' => $req->precentage[$i],
                ]);
            }
        }

        return redirect()->back();
    }

    public function users(){
        $users = Affilate::all();

        return view('Admin.Marketing.Users', compact('users'));
    }

    public function m_add_users(){
        return view('Admin.Marketing.Add_User');
    }

    public function affilate_add( Request $req ){
        $req->validate([
            'email' => 'required|email',
            'phone' => 'required',
            'organization' => 'required',
        ]);

        $affilate = User::where('nick_name', $req->nick_name)
        ->first();
        if ( !empty($affilate) ) { 
            session()->flash('faild','Nick Name Is Exist');
            return redirect()->back();
        }

        $affilate = User::where('email', $req->email)
        ->first();
        if ( !empty($affilate) ) { 
            session()->flash('faild','Email Is Exist');
            return redirect()->back();
        }

        $arr = $req->only('nick_name', 'email', 'phone', 'f_name', 'l_name');
        $arr['state'] = 'Show';
        $arr['password'] = bcrypt('password');
        $arr['position'] = 'affilate';
        $user = User::create($arr);

        Affilate::create([
            'user_id' => $user->id,
            'organization' => $req->organization,
        ]);

        return redirect()->back();
    }

    public function aff_edit( $id, Request $req ){
        $arr = $req->only('f_name', 'l_name', 'nick_name', 'email', 'phone');
        if ( !empty($req->password) ) {
            $arr['password'] = bcrypt($req->password);
        } 
        
        User::where('id', $id)
        ->update($arr);
        
        Affilate::where('user_id', $id)
        ->update([
            'organization' => $req->organization
        ]);

        return redirect()->back();
    }

    public function del_aff( $id ){
        Affilate::where('user_id', $id)
        ->delete();

        User::where('id', $id)
        ->delete();

        return redirect()->back();
    }

    public function payout_r(){
        $payouts = Payout::where('statue', 'pendding')
        ->get();
        $payments = PaymentMethod::all();

        return view('Admin.Marketing.Payout', compact('payouts', 'payments'));
    }

    public function add_promo( Request $req ){
        $arr = $req->only('name', 'starts', 'ends', 'num_usage', 'discount', 'code');
        $req->validate([
            'name'      => 'required',
            'starts'    => 'required',
            'ends'      => 'required',
            'num_usage' => 'required|numeric',
            'discount'  => 'required|numeric',
            'code'      => 'required',
        ]);
        $promo = PromoCode::create($arr);
        if ( $req->courses ) {
            foreach ($req->courses as $course) {
                PromoCourse::create([
                    'promo_id' => $promo->id,
                    'course_id' => $course
                ]);
            }
        }
        if ( $req->packages ) {
            foreach ($req->packages as $package) {
                PromoPackage::create([
                    'promo_id' => $promo->id,
                    'package_id' => $package
                ]);
            }
        }

        return redirect()->back();
    }

    public function promo_code(){
        $promo = PromoCode::
        orderByDesc('id')
        ->simplePaginate(10);
        $courses = Course::all();
        $packages = Package::all();
        $chapters = Chapter::all();

        return view('Admin.Marketing.Promo_Code', 
        compact('promo', 'courses', 'packages', 'chapters'));
    }

    public function edit_promo( $id, Request $req ){
        $arr = $req->only('name', 'starts', 'ends', 'num_usage', 'discount', 'code');
        $req->validate([
            'name'  => 'required',
            'starts' => 'required',
            'ends' => 'required',
            'num_usage' => 'required|numeric',
            'discount' => 'required|numeric',
            'code' => 'required',
        ]);
        PromoCode::where('id', $id)
        ->update($arr);
        PromoCourse::where('promo_id', $id)
        ->delete();
        PromoPackage::where('promo_id', $id)
        ->delete();

        if ( $req->courses ) {
            foreach ($req->courses as $course) {
                PromoCourse::create([
                    'promo_id' => $id,
                    'course_id' => $course
                ]);
            }
        }
        
        if ( $req->packages ) {
            foreach ($req->packages as $package) {
                PromoPackage::create([
                    'promo_id' => $id,
                    'package_id' => $package
                ]);
            }
        }

        return redirect()->back();
    }

    public function del_promo( $id, Request $req ){
        $arr = $req->only('name', 'starts', 'ends', 'num_usage');
        PromoCode::where('id', $id)
        ->delete();

        return redirect()->back();
    }

    public function filter_payment( Request $req ){
        if ( !empty($req->date_from) && !empty($req->date_to) ) {
            $arr = Payout::where('statue', 'pendding')
            ->where('date', '>=', $req->date_from )
            ->where('date', '<=', $req->date_to )
            ->get();
        }
        elseif ( !empty($req->date_from) ) {
            $arr = Payout::where('statue', 'pendding')
            ->where('date', '>=', $req->date_from ) 
            ->get();
        }
        elseif ( !empty($req->date_to) ) {
            $arr = Payout::where('statue', 'pendding') 
            ->where('date', '<=', $req->date_to )
            ->get();
        }
        else{           
            $arr = Payout::where('statue', 'pendding')
            ->get();
        }
        $payouts = [];
        foreach ($arr as $item) {
            if ( $item->payment_method == $req->payment_id ) {
                $payouts[] = $item;
            }
        }
        $payouts = empty($req->payment_id) ? $arr : $payouts;
        $payments = PaymentMethod::all();
        $data = $req->all();

        return view('Admin.Marketing.Payout', compact('payouts', 'payments', 'data'));
    }

    public function reject_payout( $id, Request $req ){
        $payouts = Payout::where('id', $id)
        ->update([
            'statue' => 'rejected',
            'rejected_reason' => $req->rejected_reason,
        ]);

        return redirect()->back();
    }

    public function accept_payout( $id ){
        $payouts = Payout::where('id', $id)
        ->first();
        $affilate = Affilate::where('id', $payouts->affilate_id ) 
        ->first();
        if ( $affilate->wallet < $payouts->amount ) {
            session()->flash('faild','Amount Is Bigger Than Wallet');
            return redirect()->back();
        }
        $payouts->update([
            'statue' => 'approve'
        ]);
        $affilate->update([
            'wallet' => $affilate->wallet - $payouts->amount
        ]);

        return redirect()->back();
    }

}
