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
    <link rel="stylesheet" href="{{ asset('storage/css/item.css')}}" />
  </head>
  <body>
    @include('vue.header')
    <main class="main">
      <div class="main-wrapper">
        <section class="section-introduction">
          <form id="vue_form" action="{{ route('vue.cart.add') }}" method="post">
            @csrf
            <div class="introduction-wrapper">
              <div class="items-image">
                <img src="{{ asset('storage/img/' .$item->image) }}">
                <input type="hidden" name="image" value="{{ $item->image }}">
              </div>
              <div class="items-wrapper">
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <h2 class="items-title">{{ $item->name }}</h2>
                <input type="hidden" name="name" value="{{ $item->name }}">
                <span class="items-value">￥{{ number_format($tax_value) }}</span><span class="tax-value">(税込)</span>
                <input type="hidden" name="value" value="{{ $tax_value }}">
                <p class="items-stock">在庫数：{{ number_format($item->stock) }}</p>
                <p>数量</p>
                <div class="items-quantity">
                  <input type="number" name="quantity" value="1" max="10" min="1">
                </div>
                <div class="section-introduction__cart-link">
                  @if ($item->stock == '0')
                  <button class="button_disabled"type="submit" disabled>在庫切れ</button>
                  @else
                  <button id="submit_button" type="submit">カートに入れる</button>
                  @endif
                </div>
                <div class="items-description">
                  <p>{{ $item->explanation }}</p>
                </div>
              </div>
            </div>
          </form>
        </section>
      </div>
    </main>
    @include('vue.footer')
    <script src="{{ asset('storage/js/front.js')}}"></script>
  </body>
</html>
