<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width = device-width, initial-scale=1, user-scalable=yes"
    />
    <title>Vue</title>
    <link rel="stylesheet" href="{{ asset('storage/css/reset.css')}}" />
    <link rel="stylesheet" href="{{ asset('storage/css/vue.css')}}" />
    <link rel="stylesheet" href="{{ asset('storage/css/login.css')}}" />
  </head>
  <body>
    <div class="login">
        <div class="login-screen">
          <div class="app-title">
            <h1>管理者ログイン</h1>
          </div>
          <form method="post" action="{{ route('login') }}">
            @csrf
            <div class="login-form">
              <div class="control-group">
                <input type="email" id="email" name="email" placeholder="メールアドレス" :value="old('email')">
                <label class="login-field-icon fui-user" for="login-name"></label>
                <x-input-error :messages="$errors->get('email')" style="color: #ff5252;"/>
              </div>
              <div class="control-group">
                <input type="password" name="password" class="login-field" placeholder="パスワード" id="login-pass">
                <label class="login-field-icon fui-lock" for="login-pass"></label>
                <x-input-error :messages="$errors->get('password')" style="color: #ff5252;"/>
              </div>
              <button class="btn btn-primary btn-large btn-block" type="submit">ログイン</button>
            </div>
          </form>
        </div>
      </div>
  </body>
</html>