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
    <link rel="stylesheet" href="{{ asset('storage/css/checkout.css')}}" />
  </head>
  <body>
    @include('vue.header')
    <main class="main">
      <div class="cart-wrapper">
        <div class="purchase-wrap">
          <form id="vue_form" method="post" action="{{ route('vue.checkout.submit') }}">
            @csrf
            <ul class="purchase-items">
              @foreach ($cart as $item)
                <li class="purchase-items__info">
                  <div class="items-wrap">
                    <div class="items-img">
                      <image src="{{ asset('storage/img/' .$item['image']) }}">
                    </div>
                    <p class="item-name">{{ $item['name'] }}</p>
                    <p class="item-quantity">{{ number_format($item['quantity']) }}個</p>
                  </div>
                  <span class="item-value">￥{{ number_format($item['subtotal']) }}</span>
                </li>
              @endforeach
            </ul>
            <div class="total-amount">
              <span>合計</span>
              <span>￥{{ number_format($total) }}</span>
              <input type="hidden" name="total_amount" value="{{ $total }}">
            </div>
          </div>
          <div class="customer-form">
            <h2>連絡先</h2>
              <div class="phonenumber-wrap">
                <input class="input-text" type="text" name="phone_number" placeholder="電話番号を入力" value="{{ old('phone_number') }}">
                @error('name')
                  <div style="color: #ff5252;">{{ $message }}</div>
                @enderror
              </div>
              <div class="mail-wrap">
                <input class="input-text" type="text" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
                @error('email')
                  <div style="color: #ff5252;">{{ $message }}</div>
                @enderror
              </div>
            <h2>配達</h2>
            <div class="name-wrap">
              <div class="surname-wrap">
                <input class="input-half" type="text" name="lastname" placeholder="姓" value="{{ old('lastname') }}">
                @error('lastname')
                  <div style="color: #ff5252;">{{ $message }}</div>
                @enderror
              </div>
              <div class="givenname-wrap">
                <input class="input-half" type="text" name="name" placeholder="名" value="{{ old('name') }}">
                @error('name')
                  <div style="color: #ff5252;">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="name-wrap">
              <div class="surname-wrap">
                <input class="input-half" type="text" name="lastname_furigana" placeholder="姓(カナ)" value="{{ old('lastname_furigana') }}">
                @error('lastname_furigana')
                  <div style="color: #ff5252;">{{ $message }}</div>
                @enderror
              </div>
              <div class="givenname-wrap">
                <input class="input-half" type="text" name="name_furigana" placeholder="名(カナ)" value="{{ old('name_furigana') }}">
                @error('name_furigana')
                  <div style="color: #ff5252;">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="company-wrap">
              <input class="input-text" type="text" name="company" placeholder="会社名(任意)" value="{{ old('company') }}">
              @error('company')
                <div style="color: #ff5252;">{{ $message }}</div>
              @enderror
            </div>
            <div class="post-wrap">
              <div class="postcode-wrap">
                <input class="input-half" type="text" name="postcode" placeholder="郵便番号(ハイフン無し)" value="{{ old('postcode') }}">
                @error('postcode')
                  <div style="color: #ff5252;">{{ $message }}</div>
                @enderror
              </div>
              <div class="prefectures-wrap">
                <input class="input-half" type="text" name="prefectures" placeholder="都道府県" value="{{ old('prefectures') }}">
                @error('prefectures')
                  <div style="color: #ff5252;">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div>
              <div class="town-wrap">
                <input class="input-text" type="text" name="town" placeholder="市区町村" value="{{ old('town') }}">
                @error('town')
                  <div style="color: #ff5252;">{{ $message }}</div>
                @enderror
              </div>
              <div class="building-wrap">
                <input class="input-text" type="text" name="building" placeholder="建物名・部屋番号" value="{{ old('building') }}">
                @error('building')
                  <div style="color: #ff5252;">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="payment">
              <h2>支払い方法</h2>
              <div class="payment-select">
                <div class="input-select">
                  <label><input type="radio" name="payment" value="0">銀行振込</label>
                </div>
                <div class="input-select">
                  <label><input type="radio" name="payment" value="1">代引き</label>
                </div>
                @error('payment')
                  <div style="color: #ff5252;">{{ $message }}</div>
                @enderror
              </div>
              <button id="submit_button" class="purchase-confirm" type="submit">今すぐ支払う</button>
            </div>
          </form>
        </div>
      </div>
    </main>
    @include('vue.footer')
    <script src="{{ asset('storage/js/front.js')}}"></script>
  </body>
</html>
