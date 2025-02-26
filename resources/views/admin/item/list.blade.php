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
    <link rel="stylesheet" href="{{ asset('storage/css/item-list.css')}}" />
  </head>
  <body>
    @include('admin.itemheader')
    <main class="main">
      <div class="main-wrapper">
        <div class="h2-wrapper">
          <h2 class="items-h2">商品リスト</h2>
          <a class="link-button" href="{{ route('admin.item.register') }}">新規登録</a>
        </div>
        <table class="items-list">
          <tr class="items-cell__empty">
            <td></td>
          </tr>
          <tr class="items-cell__id">
            <td>商品ID</td>
          </tr>
          <tr class="items-cell__name">
            <td>商品名</td>
          </tr>
          <tr class="items-cell__stock">
            <td>在庫</td>
          </tr>
          <tr class="items-cell__status">
            <td>販売ステータス</td>
          </tr>
          <tr class="items-cell__regist">
            <td>登録日時</td>
          </tr>
          <tr class="items-cell__update">
            <td>更新日時</td>
          </tr>
        </table>
        @foreach($items as $item)
        <ul class="confirm-items">
          <li>
            <table class="confirm-items__list">
              <tr class="confirm-cell__empty">
                <td><a href="{{ route('admin.item.detail',['id' => $item->id]) }}">詳細</a></td>
              </tr>
              <tr class="confirm-cell__id">
                <td>{{ $item->id }}</td>
              </tr>
              <tr class="confirm-cell__name">
                <td>{{ $item->name }}</td>
              </tr>
              <tr class="confirm-cell__stock">
                <td>{{ number_format($item->stock) }}</td>
              </tr>
              <tr class="confirm-cell__status">
                <td>
                  @if($item->status === 1)
                  販売中
                  @else
                  入荷待ち
                  @endif
                </td>
              </tr>
              <tr class="confirm-cell__regist">
                <td>{{ $item->created_at->format('Y-m-d H:i') }}</td>
              </tr>
              <tr class="confirm-cell__update">
                <td>{{ $item->updated_at->format('Y-m-d H:i') }}</td>
              </tr>
            </table>
          </li>
        </ul>
        @endforeach
      </div>
    </main>
  </body>
</html>
