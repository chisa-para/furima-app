<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'purchase_post_code' => ['required','size:8'],
            'purchase_address' => ['required'],
        ];
    }

    public function messages()
    {
        return[
            'purchase_post_code.required' => '郵便番号を入力してください',
            'purchase_post_code.size' => '郵便番号はハイフンを入れて8文字で入力してください',
            'purchase_address.required' => '住所を入力してください',
        ];
    }
}
