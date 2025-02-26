<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width = device-width, initial-scale=1, user-scalable=yes"/>
    <title>Vue</title>
    <link rel="stylesheet" href="{{ asset('storage/css/reset.css')}}" />
    <link rel="stylesheet" href="{{ asset('storage/css/vue.css')}}" />
    <link rel="stylesheet" href="{{ asset('storage/css/users-list.css')}}" />
  </head>
  <body>
    @include('admin.userheader')
    <main class="main">
      <div class="main-wrapper">
        <div class="h2-wrapper">
          <h2 class="users-h2">ユーザーリスト</h2>
          <a class="link-button" href="{{ route('admin.user.register') }}">新規登録</a>
        </div>
        <table class="users-list">
          <tr class="users-cell__empty">
            <td></td>
          </tr>
          <tr class="users-cell__id">
            <td>ID</td>
          </tr>
          <tr class="users-cell__name">
            <td>ユーザー名</td>
          </tr>
          <tr class="users-cell__email">
            <td>メールアドレス</td>
          </tr>
          <tr class="users-cell__admin">
            <td>管理者権限</td>
          </tr>
          <tr class="users-cell__regist">
            <td>登録日時</td>
          </tr>
          <tr class="users-cell__update">
            <td>更新日時</td>
          </tr>
        </table>
        @foreach($users as $user)
        <ul class="confirm-users">
          <li>
            <table class="confirm-users__list">
              <tr class="confirm-cell__empty">
                <td><a href="{{ route('admin.user.detail',['id' => $user->id]) }}">詳細</a></td>
              </tr>
              <tr class="confirm-cell__id">
                <td>{{ $user->id }}</td>
              </tr>
              <tr class="confirm-cell__name">
                <td>{{ $user->name }}</td>
              </tr>
              <tr class="confirm-cell__email">
                <td>{{ $user->email }}</td>
              </tr>
              <tr class="confirm-cell__admin">
                <td>
                  @if($user->admin_flag == true)
                  あり
                  @else
                  なし
                  @endif
                </td>
              </tr>
              <tr class="confirm-cell__regist">
                <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
              </tr>
              <tr class="confirm-cell__update">
                <td>{{ $user->updated_at->format('Y-m-d H:i') }}</td>
              </tr>
            </table>
          </li>
        </ul>
        @endforeach
      </div>
    </main>
  </body>
</html>
