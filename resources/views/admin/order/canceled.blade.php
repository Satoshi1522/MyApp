<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width = device-width, initial-scale=1, user-scalable=yes"/>
    <title>Vue</title>
    <link rel="stylesheet" href="{{ asset('storage/css/reset.css')}}" />
    <link rel="stylesheet" href="{{ asset('storage/css/vue.css')}}" />
    <link rel="stylesheet" href="{{ asset('storage/css/order-list.css')}}" />
  </head>
  <body>
    @include('admin.orderheader')
    <main class="main">
      <div class="main-wrapper">
        <div class="h2-wrapper">
          <h2 class="order-h2">キャンセル済みリスト</h2>
        </div>
        <table class="order-list">
          <tr class="order-cell__empty">
            <td></td>
          </tr>
          <tr class="order-cell__orderid">
            <td>顧客ID</td>
          </tr>
          <tr class="order-cell__itemsid">
            <td>注文ID</td>
          </tr>
          <tr class="order-cell__name">
            <td>氏名</td>
          </tr>
          <tr class="order-cell__phone">
            <td>電話番号</td>
          </tr>
          <tr class="order-cell__status">
            <td>発送状況</td>
          </tr>
          <tr class="order-cell__cancel">
            <td>キャンセル</td>
          </tr>
          <tr class="order-cell__regist">
            <td>登録日時</td>
          </tr>
          <tr class="order-cell__update">
            <td>更新日時</td>
          </tr>
        </table>
        <ul class="client-orders">
          @foreach($clients as $client)
            <li>
              <table class="client-order__list">
                <tr class="client-cell__empty">
                  <td><a href="{{ route('admin.order.detail',['id' => $client->id])}}">詳細</a></td>
                </tr>
                <tr class="client-cell__orderid">
                  <td>{{ $client->id }}</td>
                </tr>
                <tr class="client-cell__itemsid">
                  <td>{{ $client->orders->id }}</td>
                </tr>
                <tr class="client-cell__name">
                  <td>{{ $client->lastname }}{{ $client->name }}</td>
                </tr>
                <tr class="client-cell__phone">
                  <td>{{ $client->phone_number }}</td>
                </tr>
                <tr class="client-cell__status">
                  <td>
                    @if($client->orders->status == true)
                    発送済み
                    @else
                    未発送
                    @endif</td>
                </tr>
                <tr class="client-cell__cancel">
                  <td>
                    @if($client->orders->cancel_flag == true)
                    キャンセル
                    @endif
                  </td>
                </tr>
                <tr class="client-cell__regist">
                  <td>{{ $client->orders->created_at->format('Y-m-d H:i') }}</td>
                </tr>
                <tr class="client-cell__update">
                  <td>{{ $client->orders->updated_at->format('Y-m-d H:i') }}</td>
                </tr>
              </table>
            </li>
          @endforeach
        </ul>
      </div>
    </main>
  </body>
</html>