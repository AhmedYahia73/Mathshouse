<?php

namespace App\Http\Controllers\Affilate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

use App\Models\Affilate;
use App\Models\AffilateService;

class Aff_DashboardController extends Controller
{
    
    public function index(){
        $affilate = Affilate::where('user_id', auth()->user()->id)
        ->first();
        $services = AffilateService::where('affilate_id', $affilate->id)
        ->get();

        return view('Affilate.Dashboard.Dashboard', compact('affilate', 'services'));
    }

    public function aff_link( $id, Request $request ){
        Cookie::queue('affilate', $id, 60 * 24 * 60);
        
        return redirect()->route('home');
    }

}
