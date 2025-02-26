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
    <link rel="stylesheet" href="{{ asset('storage/css/cart.css')}}" />
  </head>
  <body>
    @include('vue.header')
    <main class="main">
      <div class="main-wrapper">
        <section class="section-cart">
          <h2>カートに入っている商品</h2>
          @if (empty($cart))
            <p>カートは空です。</p>
          @else
          <div class="cart-info">
            <p class="cart-item__name">商品</p>
            <p class="cart-item__quantity">数量</p>
            <p class="cart-total__value">価格</p>
          </div>
          <ul class="item-list__wrapper">
            @foreach ($cart as $id => $item)
              <li class="item-list">
                <div class="items-info">
                  <div class="items-wrraper">
                    <div class="items-image">
                      <img src="{{ asset('storage/img/' .$item['image']) }}" />
                    </div>
                    <div class="items-detail">
                      <p class="items-title">{{ $item['name'] }}</p>
                      <span class="items-value">￥{{ number_format($item['value']) }}</span>
                    </div>
                  </div>
                  <div class="items-quantity">
                    <span>{{ $item['quantity'] }}</span>
                  </div>
                  <div class="items-value">
                    <span>￥{{ number_format($item['subtotal'] )}}</span>
                  </div>
                  <form id="vue_form" action="{{ route('vue.cart.remove') }}" method="post">
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $id }}">
                    <button id="submit_button" type="submit">削除</button>
                  </form>
                </div>
              </li>
            @endforeach
          </ul>
          @endif
          @if (!empty($cart))
            <div class="total">
              <p class="total-text">合計</p>
              <p class="total-value">￥{{ number_format($total) }}</p>
            </div>
            <div class="purchase-button">
              <button type="button" onclick="location.href='{{ route('vue.checkout') }}'">購入手続きに進む</button>
            </div>
            @foreach(session('errors',[]) as $error)
            <div style="color: #ff5252;">{{ $error }}</div>
            @endforeach
          @endif
        </section>
      </div>
    </main>
    @include('vue.footer')
    <script src="{{ asset('storage/js/front.js')}}"></script>
  </body>
</html>