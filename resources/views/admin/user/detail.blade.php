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
    <link rel="stylesheet" href="{{ asset('storage/css/user-detail.css')}}" />
  </head>
  <body>
    @include('admin.userheader')
    <main class="main">
      <div class="detail-wrapper">
        <div class="main-wrapper">
          <div class="h2-wrapper">
            <h2 class="user-h2">ユーザー情報</h2>
            <div class="user-edit__wrapper">
              <a class="link-button" href="{{ route('admin.user.edit',['id' => $user->id]) }}">編集</a>
              <!--<a class="link-button" href="" onclick="return userDelete_confirm(event);">削除</a>-->
            </div>
          </div>
          <div class="user-id">
            <p class="bold">ID</p>
            <div>{{ $user->id }}</div>
          </div>
          <div class="user-fullname">
            <p class="bold">ユーザー名</p>
            <div>{{ $user->name }}</div>
          </div>
          <div class="user-email">
            <p class="bold">メールアドレス</p>
            <div>{{ $user->email }}</div>
          </div>
          <div class="user-admin">
            <p class="bold">管理者権限</p>
            <div>{{ $admin_flag }}</div>
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
        </div>
      </div>
    </main>
    <script src="{{ asset('storage/js/details.js')}}"></script>
  </body>
</html>
