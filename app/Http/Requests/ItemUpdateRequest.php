<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemUpdateRequest extends FormRequest
{    public function rules()
  {
    return [
      'name' => 'required|string|max:40',
      'explanation' => 'required|string|max:200',
      'image' => 'nullable|file|max:5120',
      'value'=> 'required|regex:/^[0-9]+$/i',
      'stock'=> 'required|regex:/^[0-9]+$/i',
    ];
  }
  public function messages() {
    return [
      'name.required' => '商品名は必須です。',
      'name.max:40' => '商品名は40文字までです。',
      'explanation.required' => '商品説明を入力してください。',
      'explanation.max:200' => '200字以内で入力してください。',
      'image.max:5120' => '上限サイズは5MBです。',
      'value.required'=> '価格を入力してください。',
      'value.regex'=> '数値が不正です。',
      'stock.required'=> '在庫を入力してください。',
      'stock.regex'=> '数値が不正です。',
    ];
  }
}