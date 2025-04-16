<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\UserAdmin;
use App\Models\Admin_role;

class AdminsController extends Controller
{
    //
    public function role_admins(){
        $user_admin = UserAdmin::
        orderByDesc('id')
        ->get();

        return view('Admin.Admins.RoleAdmin',
        compact('user_admin'));
    }

    public function role_admin_add( Request $req ){

        $req->validate([
            'user_admin' => 'required',
        ]);
        if(!$req){
       session()->flash('faild', 'You Should Be Shoose The Roles');
       return redirect()->back();
       }
        $user_admin = UserAdmin::create(['user_admin' => $req->user_admin]);
        foreach ( $req->roles as $item ) {
            Admin_role::create([
                'user_admin_id' => $user_admin->id,
                'admin_role' => $item,
            ]);
        }      
        session()->flash('success', 'Admin Roles Added Successfully');
        return redirect()->back();
    }

    public function role_del_admin($id){
        UserAdmin::where('id', $id)
        ->delete();

        return redirect()->back();
    }

    public function role_admin_edit( Request $req, $id ){
        Admin_role::where('user_admin_id', $id)
        ->delete();
        $req->roles = empty($req->roles) ? []: $req->roles;
        foreach ( $req->roles as $item ) {
            Admin_role::create([
                'user_admin_id' => $id,
                'admin_role' => $item,
            ]);
        }
        return redirect()->back();
    }

    public function admins(){
        $sup_admins = User::where('position', 'admin')
        ->orderByDesc('id')
        ->get();
        $admins = User::where('position', 'user_admin')
        ->orderByDesc('id')
        ->get();
        $user_admin = UserAdmin::all();

        return view('Admin.Admins.Admins', compact('sup_admins', 'admins', 'user_admin'));
    }

    public function del_admin( $id ){
        User::where('id', $id)
        ->where('position', '!=', 'super_admin')
        ->delete();
        session()->flash('success', 'Admin Deleted Successfully');
        return redirect()->back();
    }

    public function admin_edit( Request $req ){
        $req->validate([
        'nick_name'=>'required',
        'email'=>'required|email',
        'phone'=>'required',
        ]);
        $emails = User::where('id', '!=', $req->user_id)
        ->where('email' , $req->email)
        ->first();

        if ( !empty($emails) ) {
            session()->flash('faild','Email is Duplicated');
            return redirect()->back();
        }
        $nick_name = User::where('id', '!=', $req->user_id)
        ->where('nick_name' , $req->nick_name)
        ->first();

        if ( !empty($nick_name) ) {
            session()->flash('faild','Nick Name is Exist');
            return redirect()->back();
        }

        $arr = $req->only('nick_name', 'email', 'phone', 'user_admin_id', 'f_name', 'l_name');

        if ( !empty($req->password) ) {
           $arr['password'] = bcrypt($req->password);
        }
        User::where('id', $req->user_id)
        ->where('position', '!=', 'super_admin')
        ->update($arr);
        session()->flash('success', 'Admin Updated Successfully');
        return redirect()->route('admins_list');
    }

    public function admin_add(){
        return view('Admin.Admins.AddAdmin');
    }

    public function add_admin( Request $req ){
       
        $user = User::where('email', $req->email)
        ->first();
        if ( !empty($user) ) {
            session()->flash('faild','Email is Duplicated');
            return redirect()->back();
        }
        $arr = $req->only('nick_name', 'email', 'phone', 'user_admin_id');
        $req->validate([
        'nick_name'=>'required',
        'email'=>'required|email',
        'phone'=>'required',
        ]);
        $emails = User::where('email' , $req->email)
        ->first();

        if ( !empty($emails) ) {
            session()->flash('faild','Email is Duplicated');
            return redirect()->back();
        }
        $nick_name = User::where('nick_name' , $req->nick_name)
        ->first();

        if ( !empty($nick_name) ) {
            session()->flash('faild','Nick Name is Duplicated');
            return redirect()->back();
        }
        $arr['password'] = bcrypt($req->password);
        $arr['position'] = 'user_admin';
        $arr['state'] = 'Show';
        $user = User::create($arr);
         session()->flash('success','Admin Added Successfully');
        return redirect()->back();
    }
    
    public function admin_filter( Request $req ){
        $sup_admins = [];
        $admins = User::where('user_admin_id', $req->user_admin_id)
        ->orderByDesc('id')
        ->get();
        $user_admin = UserAdmin::
        orderByDesc('id')
        ->get();
        $data = $req->all();
        session()->flash('success', 'Filter Successfully');
        return view('Admin.Admins.Admins', compact('sup_admins', 'admins', 'user_admin', 'data'));
    }

}
