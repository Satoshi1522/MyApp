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
    @include('admin.itemheader')
    <main class="main">
      <div class="detail-wrapper">
        <div class="main-wrapper">
          <div class="h2-wrapper">
            <h2 class="item-h2">商品詳細</h2>
            <div class="item-edit__wrapper">
              <a class="link-button" href="{{ route('admin.item.edit',['id' => $item->id]) }}">編集</a>
              <a class="link-button" href="{{ route('admin.item.delete',['id' => $item->id]) }}" onclick="return delete_confirm(event);">削除</a>
            </div>
          </div>
          <div class="item-id">
            <p class="bold">商品ID</p>
            <div>{{ $item->id }}</div>
          </div>
          <div class="item-name">
            <p class="bold">商品名</p>
            <div>{{ $item->name }}</div>
          </div>
          <div class="item-infomation">
            <p class="bold">商品説明</p>
            <div>{{ $item->explanation }}</div>
          </div>
          <div class="item-image__wrapper">
            <p class="bold">商品画像</p>
            <div class="item-image">
              <img src="{{ asset('storage/img/' .$item->image) }}" />
            </div>
          </div>
          <div class="item-value">
            <p class="bold">価格(税抜き)</p>
            <div>{{ number_format($item->value) }}円</div>
          </div>
          <div class="item-stock">
            <p class="bold">在庫</p>
            <div>{{ number_format($item->stock) }}個</div>
          </div>
          <div class="sale-status">
            <p class="bold">販売ステータス</p>
            <div>{{ $status }}</div>
          </div>
          <div class="timestamp">
            <div class="create-time">
              <p class="bold">作成日時</p>
              <div>{{ $item->created_at }}</div>
            </div>
            <div class="update-time">
              <p class="bold">更新日時</p>
              <div>{{ $item->updated_at }}</div>
            </div>
          </div>
        </div>
        <div class="comment-wrapper">
          <form id="vue_form" method="post" action="{{ route('admin.item.comment.store', ['id' => $item->id]) }}">
            @csrf
            <textarea name="content" class="comment-box"></textarea>
            <div class="comment-button">
              <div>
                <button class="cancel-button" type="reset">キャンセル</button>
              </div>
              <div>
                <button id="submit_button" class="submit-button" type="submit">書き込む</button>
              </div>
            </div>
          </form>
          <div class="comment-vew">
            <ul class="comment-list">
              @foreach ($comments as $comment)
                <li>
                  <div class="comment-vew__wrapper">
                    <p class="comment-num">{{ $loop->remaining+1 }}</p>
                    <p class="comment-user__name">{{ $comment->user->name }}</p>
                    <p class="comment-datatime">{{ $comment->created_at->format('Y-m-d H:i') }}</p>
                  </div>
                  <div class="comment-content">
                    <p>{{ $comment->content }}</p>
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </main>
    <script src="{{ asset('storage/js/details.js')}}" defer></script>
  </body>
</html>
