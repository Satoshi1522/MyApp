<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width = device-width, initial-scale=1, user-scalable=yes"
    />
    <title>Vue</title>
    <link rel="stylesheet" href="{{ asset('storage/css/reset.css')}}" />
    <link rel="stylesheet" href="{{ asset('storage/css/vue.css')}}" />
    <link rel="stylesheet" href="{{ asset('storage/css/item-detail.css')}}" />
  </head>
  <body>
    @include('admin.userheader')
    <main class="main">
      <div class="main-wrapper">
        <form method="post" action="{{ route('admin.user.store') }}">
          @csrf
          <div class="h2-wrapper">
            <h2 class="item-h2">ユーザー登録</h2>
            <div>
              <button class="link-button">登録</button>
              <a href="{{ route('admin.user.list') }}" class="link-cancel">キャンセル</a>
            </div>
          </div>
          <div class="item-id">
            <p>ID</p>
            <input type="text" placeholder="自動入力" disabled/>
          </div>
          <div class="item-name">
            <p>ユーザー名</p>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
            @error('name')
            <div style="color: #ff5252;">{{ $message }}</div>
            @enderror
          </div>
          <div class="item-name">
            <p>メールアドレス</p>
            <input type="text" id="email" name="email" value="{{ old('email') }}">
            @error('email')
            <div style="color: #ff5252;">{{ $message }}</div>
            @enderror
          </div>
          <div class="item-name">
            <p>パスワード</p>
            <input type="password" id="password" name="password" value="{{ old('password') }}">
            @error('password')
            <div style="color: #ff5252;">{{ $message }}</div>
            @enderror
          </div>
        </form>
      </div>
    </main>
  </body>
</html>
