<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'comment_detail' => ['required', 'max:255'],
        ];
    }

    public function messages()
    {
        return[
            'comment_detail.required' => 'コメントを入力してください',
            'comment_detail.max' => 'コメントは255文字以内で入力してください',
        ];
    }
}
