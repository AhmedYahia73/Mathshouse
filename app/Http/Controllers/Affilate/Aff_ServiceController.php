<?php

namespace App\Http\Controllers\Affilate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Commission;

class Aff_ServiceController extends Controller
{
    
    public function aff_service(){
        $services = Commission::
        where('user_id', auth()->user()->id)
        ->get();

        return view('Affilate.Services.Services', compact('services'));
    }

}
