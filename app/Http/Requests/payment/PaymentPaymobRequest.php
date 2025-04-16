<?php

namespace App\Http\Requests\payment;

use Illuminate\Foundation\Http\FormRequest;

class PaymentPaymobRequest extends FormRequest
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
            // This Request About All Request With Paymob
            'payment_method_id'=>'required',
            'payment'=>'required',
            'price'=>'required',
            'cart' => ['required'], // must specify type
            'cart.*chapters' => ['required','array',], // must specify type
            'cart.*chapters.*.chapter_id' => ['required','integer'], 
            'cart.course_id' => ['required','integer'], // must specify type
            'cart.package_id' => ['required','integer'], // must specify type
        ];
    }
}
