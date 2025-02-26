<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest {
  public function rules()
  {
    return [
      'phone_number' => 'required|numeric',
      'email'=> 'required|email|max:30',
      'lastname'=> 'required|string|max:20',
      'lastname_furigana' => 'required|string|max:20',
      'name' => 'required|string|max:20',
      'name_furigana' => 'required|string|max:20',
      'company'=> 'nullable|string|max:40',
      'postcode' => 'required|string|numeric|digits:7',
      'prefectures'=> 'required|string|max:8',
      'town' => 'required|string|max:40',
      'building' => 'nullable|string|max:40',
      'payment'=> 'required',
    ];
  }
  public function messages() {
    return [
      'phone_number.required' => '電話番号は必須です。',
      'phone_number.numeric' => '正しい番号を入力してください。',
      'email.required' => 'メールアドレスは必須です。',
      'email.email' => '正しいメールアドレスを入力してください。',
      'email.max:30' => 'メールアドレスが長すぎます。',
      'lastname.required' => '苗字は必須です。',
      'lastname.max:20' => '入力が長すぎます。',
      'lastname_furigana.required' => 'フリガナは必須です。',
      'lastname_furigana.max:20' => '入力が長すぎます。',
      'name.required' => '名前は必須です。',
      'name.max:20' => '入力が長すぎます。',
      'name_furigana.required' => 'フリガナは必須です。',
      'name_furigana.max:20' => '入力が長すぎます。',
      'company.max:40' => '入力が長すぎます。',
      'postcode.required' => '郵便番号は必須です。',
      'postcode.numeric' => '正しい郵便番号を入力してください。',
      'postcode.digits:7' => '正しい郵便番号を入力してください。',
      'prefectures.required' => '住所を入力してください。',
      'prefectures.max:8' => '正しい住所を入力してください。',
      'town.required' => '住所を入力してください。',
      'town.max:40' => '入力が長すぎます。',
      'building.max:40' => '入力が長すぎます。',
      'payment.required' => '支払い方法を選択してください',
    ];
  }
}
