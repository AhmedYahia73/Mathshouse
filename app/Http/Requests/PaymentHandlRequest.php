<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentHandlRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //This request About all Checkout Request Method
                    'payment_method_id'=>'required',
                    'payment'=>'required',
                    'price'=>'required',
                    'image' => 'required|image|max:55222222000',
                    'type'=>'required',
                    'duration'=>'string',
        ];
       
    }
}
