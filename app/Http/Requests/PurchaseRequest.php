<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'payment_method' => ['required'],
            'purchase_post_code' => ['required'],
            'purchase_address' => ['required'],
        ];
    }

    public function messages()
    {
        return[
            'payment_method.required' => '支払方法を入力してください',
            'purchase_post_code.required' => '配送先の郵便番号を入力してください',
            'purchase_address.required' => '配送先の住所を入力してください',
        ];
    }
}
