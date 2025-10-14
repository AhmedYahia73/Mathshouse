<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Contact;

class ContactController extends Controller
{

    public function index(){
        return redirect('https://mathshouse.net/ContactUs');
    }

    public function contact_msg( Request $req ){
        $arr = $req->only('name', 'email', 'subject', 'message');
        Contact::create($arr);

        return redirect()->back();
    }

}
