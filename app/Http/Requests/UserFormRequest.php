<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
{
  public function rules()
  {
    return [
      'name' => 'required|string|unique:users,name|max:20',
      'email' => 'required|regex:/^[a-zA-Z0-9_.+-]+@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}$/|unique:users,email|max:200',
      'password' => 'required|string',
    ];
  }
  public function messages() {
    return [
      'name.required' => 'ユーザー名は必須です。',
      'name.max:20' => 'ユーザー名は40文字までです。',
      'name.unique' => 'そのユーザー名は既に使われています。',
      'email.required' => 'メールアドレスは必須です。',
      'email.regex' => '正しいメールアドレスを入力してください。',
      'email.unique' => 'そのメールアドレスは既に使われています。',
      'password.required' => 'パスワードは必須です。',
    ];
  }
}
