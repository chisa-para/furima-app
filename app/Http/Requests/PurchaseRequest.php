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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'comment_detail' => ['required', 'max:255'],
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
