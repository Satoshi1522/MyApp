<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width = device-width, initial-scale=1, user-scalable=yes" />
  <title>Vue</title>
  <link rel="stylesheet" href="{{ asset('storage/css/reset.css') }}" />
  <link rel="stylesheet" href="{{ asset('storage/css/vue.css') }}" />
  <link rel="stylesheet" href="{{ asset('storage/css/item-detail.css') }}" />
</head>

<body>
  @include('admin.userheader')
  <main class="main">
    <div class="detail-wrapper">
      <div class="main-wrapper">
        <form method="post" action="{{ route('admin.user.update', ['id' => $user->id]) }}">
          @csrf
          <div class="h2-wrapper">
            <h2 class="item-h2">編集画面</h2>
            <div class="item-edit__wrapper">
              <button class="link-button">更新</button>
              <a href="{{ route('admin.user.detail', ['id' => $user->id]) }}" class="link-cancel">キャンセル</a>
            </div>
          </div>
          <div class="user-id">
            <p class="bold">ID</p>
            <div>{{ $user->id }}</div>
          </div>
          <div class="user-fullname">
            <p class="bold">ユーザー名</p>
            <input type="text" name="name" placeholder="ユーザー名を入力"
              value="{{ old('name', $user->name) }}" />
            @error('name')
              <div style="color: #ff5252;">{{ $message }}</div>
            @enderror
          </div>
          <div class="user-email">
            <p class="bold">メールアドレス</p>
            <input type="text" name="email" placeholder="メールアドレスを入力"
              value="{{ old('email', $user->email) }}" />
          </div>
          <div class="user-password">
            <p class="bold">パスワード</p>
            <input type="password" name="password" placeholder="変更する場合入力"/>
          </div>
          @error('password')
            <div style="color: #ff5252;">{{ $message }}</div>
          @enderror
          <div class="user-admin">
            <p class="bold">管理者権限</p>
            <select name="admin_flag">
              <option value='0' @if ($user->admin_flag == false) selected @endif
              @if (old('admin_flag') == '0') selected @endif>なし</option>
              <option value='1' @if ($user->admin_flag == true) selected @endif
              @if (old('admin_flag') == '1') selected @endif>あり</option>
            </select>
          </div>
          <div class="timestamp">
            <div class="create-time">
              <p class="bold">作成日時</p>
              <div>{{ $user->created_at->format('Y-m-d H:i') }}</div>
            </div>
            <div class="update-time">
              <p class="bold">更新日時</p>
              <div>{{ $user->updated_at->format('Y-m-d H:i') }}</div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>
</body>

</html>
