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
      <div class="main-wrapper">
        <form id="vue_form" method="post" action="{{ route('admin.item.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="h2-wrapper">
            <h2 class="item-h2">商品登録</h2>
            <div>
              <button id="submit_button" class="link-button" type="submit">登録</button>
              <a href="{{ route('admin.item.list') }}" class="link-cancel">キャンセル</a>
            </div>
          </div>
          <div class="item-id">
            <p>商品ID</p>
            <input type="text" placeholder="自動入力" disabled/>
          </div>
          <div class="item-name">
            <p>商品名</p>
            <input type="text" id="name" name="name" placeholder="商品名を入力" value="{{ old('name') }}">
            @error('name')
            <div style="color: #ff5252;">{{ $message }}</div>
            @enderror
          </div>
          <div class="item-infomation">
            <p>商品説明</p>
            <textarea id="explanation" name="explanation" class="item-infomation__text" placeholder="商品概要を入力" cols="40" rows="10">{{ old('explanation') }}</textarea>
            @error('explanation')
            <div style="color: #ff5252;">{{ $message }}</div>
            @enderror
          </div>
          <div class="item-image__wrapper">
            <p>商品画像</p>
            <div class="item-image">
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
              <img id="preview" class="img-preview" src="#" alt="選択した画像のプレビュー" style="display: none;">
          </div>
          <div class="item-value">
            <p>価格(税抜き)</p>
            <input type="text" id="value" name="value" value="{{ old('value') }}">
            @error('value')
            <div style="color: #ff5252;">{{ $message }}</div>
            @enderror
          </div>
          <div class="item-stock">
            <p>在庫</p>
            <input type="text" id="stock" name="stock" value="{{ old('stock') }}">
            @error('stock')
            <div style="color: #ff5252;">{{ $message }}</div>
            @enderror
          </div>
        </form>
      </div>
    </main>
    <script src="{{ asset('storage/js/item_edit.js')}}"></script>
  </body>
</html>
