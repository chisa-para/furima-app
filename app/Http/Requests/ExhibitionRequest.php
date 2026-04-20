<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
            'item_image' => ['required','image','mimes:jpeg,png'],
            'item_name' => ['required'],
            'item_price' => ['required', 'numeric','min:0'],
            'item_detail' => ['required','max:255'],
            'category_id' => ['required'],
            'condition_id' => ['required'],
        ];
    }

    public function messages()
    {
        return[
            'item_image.required' => '商品画像を登録してください',
            'item_image.image' => '画像形式のものをアップロードしてください',
            'item_image.mimes' => '画像は拡張子がjpegもしくはpngのものを登録してください',
            'item_name.required' => '商品名を入力してください',
            'item_price.required' => '商品価格を入力してください',
            'item_price.numeric' => '商品価格は数値で入力してください',
            'item_price.min' => '商品価格は0以上の数値で入力してください',
            'item_detail.required' => '商品説明を入力してください',
            'item_detail.max' => '商品説明は255文字以内で入力してください',
            'category_id.required' => 'カテゴリーを選択してください',
            'condition_id.required' => '商品の状態を選択してください',
        ];
    }
}
