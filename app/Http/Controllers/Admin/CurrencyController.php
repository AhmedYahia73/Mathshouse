<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Currancy;

class CurrencyController extends Controller
{
    public function __construct(private Currancy $currency){}
    protected $currencyRequest = [
        'currency',
        'amount',
    ];

    public function view(){
        $currencies = $this->currency->with('paymentMethod')->get();

        return view('Admin.Currancy.Currancy', compact('currencies'));
    }

    public function add(Request $request){
        $request->validate([
            'currency'=>'required',
            'amount'=>'required|numeric',
        ]);
        $data = $request->only($this->currencyRequest);
        $this->currency->create($data);

        return redirect()->back();
    }

    public function modify(Request $request, $id){
        $request->validate([
            'currency'=>'required',
            'amount'=>'required|numeric',
        ]);
        $data = $request->only($this->currencyRequest);
        $this->currency->where('id', $id)
        ->update($data);

        return redirect()->back();
    }

    public function delete($id){
        $this->currency->where('id', $id)
        ->delete();

        return redirect()->back();
    }
}
