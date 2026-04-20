<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'profile_image' => ['image','mimes:jpeg,png'],
            'user_name' => ['required', 'max:20'],
            'post_code' => ['required', 'size:8'],
            'address' => ['required'],
        ];
    }

    public function messages()
    {
        return[
            'profile_image.image' => '画像形式のものをアップロードしてください',
            'profile_image.mimes' => '画像は拡張子がjpegもしくはpngのものを登録してください',
            'user_name.required' => 'お名前を入力してください',
            'user_name.max' => 'お名前は20文字以内で入力してください',
            'post_code.required' => '郵便番号を入力してください',
            'post_code.size' => '郵便番号はハイフンを入れて8文字で入力してください',
            'address.required' => '住所を入力してください',
        ];
    }
}
