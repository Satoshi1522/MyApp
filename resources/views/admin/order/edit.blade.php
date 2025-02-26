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
    <link rel="stylesheet" href="{{ asset('storage/css/order-detail.css')}}" />
  </head>
  <body>
    @include('admin.orderheader')
    <main class="main">
      <div class="detail-wrapper">
        <div class="main-wrapper">
          <form method="post" action="{{ route('admin.order.update', ['id' => $client->id]) }}">
            @csrf
            <div class="h2-wrapper">
              <h2 class="order-h2">注文詳細</h2>
              <div>
                <button class="link-button" type="submit">更新</button>
                <a href="{{ route('admin.order.detail', ['id' => $client->id]) }}" class="link-cancel">キャンセル</a>
              </div>
            </div>
            <div class="order-infomation">
              <div class="order-id">
                <p class="bold">注文ID</p>
                <div>{{ $client->id }}</div>
              </div>
              <div class="merchandise-id">
                <p class="bold">注文商品ID</p>
                <div>{{ $client->orders->id }}</div>
              </div>
            </div>
            <div class="client-infomation">
              <div class="name">
                <p class="bold">氏名</p>
                <div>
                  <input type="text" name="lastname" placeholder="姓" value="{{ old(('lastname'),$client->lastname) }}">
                  @error('lastname')
                  <div style="color: #ff5252;">{{ $message }}</div>
                  @enderror
                  <input type="text" name="name" placeholder="名" value="{{ old(('name'),$client->name) }}">
                  @error('name')
                  <div style="color: #ff5252;">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="name">
                <p class="bold">カナ</p>
                <div>
                  <input type="text" name="lastname_furigana" placeholder="姓(カナ)" value="{{ old(('lastname_furigana'),$client->lastname_furigana) }}">
                  @error('lastname_furigana')
                  <div style="color: #ff5252;">{{ $message }}</div>
                  @enderror
                  <input type="text" name="name_furigana" placeholder="名(カナ)" value="{{ old(('name_furigana'),$client->name_furigana) }}">
                  @error('name_furigana')
                  <div style="color: #ff5252;">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="client-infomation">
              <div class="name">
                <p class="bold">会社名</p>
                <input type="text" name="company" placeholder="会社名があれば入力" value="{{ old(('company'),$client->company) }}">
                @error('company')
                <div style="color: #ff5252;">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="client-infomation">
              <div class="phone-number">
                <p class="bold">電話番号</p>
                <div>
                  <input type="text" name="phone_number" placeholder="電話番号" value="{{ old(('phone_number'),$client->phone_number) }}">
                  @error('phone_number')
                  <div style="color: #ff5252;">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="mail-address">
                <p class="bold">メールアドレス</p>
                <div>
                  <input type="text" name="email" placeholder="メールアドレス" value="{{ old(('email'),$client->email) }}">
                  @error('email')
                  <div style="color: #ff5252;">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="address-infomation">
              <div class="post-code">
                <p class="bold">郵便番号</p>
                <div>
                  <input type="text" name="postcode" placeholder="郵便番号" value="{{ old(('postcode'),$client->postcode) }}">
                  @error('postcode')
                  <div style="color: #ff5252;">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="address">
                <p class="bold">住所</p>
                <div>
                  <div>
                    <input type="text" name="prefectures" placeholder="県名" value="{{ old(('prefectures'),$client->prefectures) }}">
                    @error('prefectures')
                    <div style="color: #ff5252;">{{ $message }}</div>
                    @enderror
                  </div>
                  <div>
                    <input type="text" name="town" placeholder="住所" value="{{ old(('town'),$client->town) }}">
                    @error('town')
                    <div style="color: #ff5252;">{{ $message }}</div>
                    @enderror
                  </div>
                  <div>
                    <input type="text" name="building" placeholder="建物名、部屋番号があれば入力" value="{{ old(('building'),$client->building) }}">
                    @error('building')
                    <div style="color: #ff5252;">{{ $message }}</div>
                    @enderror
                </div>
                </div>
              </div>
            </div>
          </form>
          <div class="order-breakdown">
            <p class="bold">注文商品内容</p>
            <div class="order-breakdown__list">
              <p>商品名</p>
              <p>個数</p>
              <p>小計</p>
            </div>
            <ul class="ordered-items">
              @foreach ($client->orders->orderItems as $items)
              <li class="orderitem-list">
                <div class="orderitem-list__child">
                  {{ $items->item->name }}
                </div>
                <div class="orderitem-list__child">
                  {{ number_format($items->quantity) }}個
                </div>
                <div class="orderitem-list__child">
                  {{ number_format($items->subtotal)}}円
                </div>
              </li>
              <div class="item-image">
                <img src="{{ asset('storage/img/' .$items->item->image) }}" />
              </div>
              @endforeach
            </ul>
          </div>
          <div class="order-value">
            <div class="total-value">
              <p class="bold">合計金額</p>
              {{ number_format($client->orders->total_amount)}}円
            </div>
          </div>
          <div class="pay-infomation">
            <div class="payment">
              <p class="bold">支払い方法</p>
              <div>{{ $payment }}</div>
            </div>
          </div>
          <div class="shipping-information">
            <div class="shipping-status">
              <p class="bold">配送ステータス</p>
              <div>{{ $status }}</div>
            </div>
            <div class="cancel-flag">
              <p class="bold">キャンセルフラグ</p>
              <div>{{ $cancel_flag }}</div>
            </div>
          </div>
          <div class="timestamp">
            <div class="create-time">
              <p class="bold">作成日時</p>
              <div>{{ $client->created_at->format('Y-m-d H:i') }}</div>
            </div>
            <div class="update-time">
              <p class="bold">更新日時</p>
              <div>{{ $client->updated_at->format('Y-m-d H:i') }}</div>
            </div>
          </div>
          @if ($client->orders->false)
          <form id="vue_form" method="post" action="{{ route('admin.order.delivery', ['id' => $order->id]) }}">
            @csrf
            <button id="submit_button" class="link-button" type="submit" onclick="return delivery_confirm()">発送を確定する</button>
          </form>
          @endif
        </div>
        <div class="comment-wrapper">
          <form id="vue_form" method="post" action="{{ route('admin.order.comment.store', ['id' => $order->id]) }}">
            @csrf
            <textarea name="content" class="comment-box" disabled></textarea>
            <div class="comment-button">
              <div>
                <button class="cancel-button" type="reset" disabled>キャンセル</button>
              </div>
              <div>
                <button id="submit_button" class="submit-button" type="submit" disabled>書き込む</button>
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
  </body>
</html>