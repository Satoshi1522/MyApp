<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
public function rules()
  {
    return [
      'name' => 'required|string|max:20',
      'email' => 'required|regex:/^[a-zA-Z0-9_.+-]+@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}$/|max:200',
      'password' => 'string',
    ];
  }
  public function messages() {
    return [
      'name.required' => 'ユーザー名は必須です。',
      'name.max:20' => 'ユーザー名は40文字までです。',
      'email.required' => 'メールアドレスは必須です。',
      'email.regex' => '正しいメールアドレスを入力してください。',
    ];
  }
}