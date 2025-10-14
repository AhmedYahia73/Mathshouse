<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    
    public function index(){
        return redirect('https://mathshouse.net/About');
    }

}
