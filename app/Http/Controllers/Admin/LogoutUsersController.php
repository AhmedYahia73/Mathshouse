<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\LoginUser;
use App\Models\PersonalAccessToken;



class LogoutUsersController extends Controller
{
  public function __construct( private User $user)
  {
       
  }
    public function index(){
        $users_id = LoginUser::pluck('user_id');
        $students = User::
        whereIn('id', $users_id)
        ->orderBy('position')
        ->get();

        return view('Admin.Settings.LogoutUser', compact('students'));
    }

    public function logout( $id ){
        LoginUser::where('user_id', $id)
        ->delete();
        PersonalAccessToken::where('tokenable_id', $id)
        ->delete();

        return redirect()->back();
    }

}
