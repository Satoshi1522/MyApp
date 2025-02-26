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
          <form id="vue_form" method="post" action="{{ route('admin.item.update', ['id' => $item->id]) }}" enctype="multipart/form-data">
          @csrf
            <div class="h2-wrapper">
              <h2 class="item-h2">編集画面</h2>
              <div class="item-edit__wrapper">
                <button id="submit_button" type="submit" class="link-button">更新</button>
                <a href="{{ route('admin.item.detail',['id' => $item->id]) }}" class="link-cancel">キャンセル</a>
              </div>
            </div>
            <div class="item-id">
              <p class="bold">商品ID</p>
              <div>{{ $item->id }}</div>
            </div>
            <div class="item-name">
              <p class="bold">商品名</p>
              <input type="text" name="name" placeholder="商品名を入力" value="{{ old(('name'),$item->name) }}"/>
              @error('name')
              <div style="color: #ff5252;">{{ $message }}</div>
              @enderror
            </div>
            <div class="item-infomation">
              <p class="bold">商品説明</p>
              <textarea id="explanation" name="explanation" class="item-infomation__text" placeholder="商品概要を入力" cols="40" rows="10">{{ old(('explanation'),$item->explanation) }}</textarea>
              @error('explanation')
              <div style="color: #ff5252;">{{ $message }}</div>
              @enderror
            </div>
            <div class="item-image__wrapper">
              <p class="bold">商品画像</p>
              <div class="item-image">
                <img id="preview" src="{{ asset('storage/img/' .$item->image) }}" />
              </div>
              <label class="imageupload">
                <span class="image-span">
                  参照
                  <input id="fileInput" type="file" name="image" style="display: none" accept="image/*"/>
                </span>
              </label>
              @error('image')
              <div style="color: #ff5252;">{{ $message }}</div>
              @enderror
            </div>
            <div class="item-value">
              <p class="bold">価格(税抜き)</p>
              <input type="text" name="value" value="{{ old(('value'),$item->value) }}"/>
              @error('value')
              <div style="color: #ff5252;">{{ $message }}</div>
              @enderror
            </div>
            <div class="item-stock">
              <p class="bold">在庫</p>
              <input type="text" name="stock" value="{{ old(('stock'),$item->stock) }}"/>
              @error('stock')
              <div style="color: #ff5252;">{{ $message }}</div>
              @enderror
            </div>
            <div class="sale-status">
              <p class="bold">販売ステータス</p>
              <select name="status">
                <option value='0' @if($item->status == false) selected @endif @if(old('status')=='0') selected @endif>入荷待ち</option>
                <option value='1' @if($item->status == true) selected @endif @if(old('status')=='1') selected @endif>販売中</option>
              </select>
            </div>
            <div class="timestamp">
              <div class="create-time">
                <p class="bold">作成日時</p>
                <div>{{ $item->created_at->format('Y-m-d H:i') }}</div>
              </div>
              <div class="update-time">
                <p class="bold">更新日時</p>
                <div>{{ $item->updated_at->format('Y-m-d H:i') }}</div>
              </div>
            </div>
          </div>
        </form>
          <div class="comment-wrapper">
            <textarea name="" class="comment-box" disabled></textarea>
            <div class="comment-button">
              <div>
                <button class="cancel-button" disabled>キャンセル</button>
              </div>
              <div>
                <button class="submit-button" disabled>書き込む</button>
              </div>
            </div>
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
    <script src="{{ asset('storage/js/item_edit.js')}}"></script>
  </body>
</html>
