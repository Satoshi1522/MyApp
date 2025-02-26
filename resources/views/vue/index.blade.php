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
    <link rel="stylesheet" href="{{ asset('storage/css/index.css')}}" />
  </head>
  <body>
    @include('vue.header')
    <main class="main">
      <div class="top-wrapper">
        <section class="section-top" id="top">
          <div class="section-top__image">
            <img src="{{ asset('storage/common/29216653_m.jpg')}}" />
          </div>
        </section>
      </div>
      <div class="main-wrapper">
        <section class="section-items" id="item">
          <h2>ITEMS</h2>
          <ul>
            @foreach ($items as $item)
            @php
            $tax_value = floor($item->value * 1.1)
            @endphp
            <li>
              <label>
                <a href="{{ route('vue.item',['id' => $item->id]) }}">
                  <div class="section-items__item">
                    <img src="{{ asset('storage/img/' .$item->image) }}" />
                  </div>
                  <div class="section-items__description">
                    <div class="stock-error">
                      <p class="items-name">{{ $item->name }}</p>
                      @if ($item->stock == '0')
                      <p class="error">現在在庫切れ</p>
                      @endif
                    </div>
                    <p id="items-value" class="items-value">￥{{ number_format($tax_value) }}[税込]</p>
                  </div>
                </a>
              </label>
            </li>
            @endforeach
          </ul>
        </section>
        <section class="section-information" id="information">
          <h2 id="infomation">店舗情報</h2>
          <div class="information-content">
            <div class="section-information__map">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3240.490064942213!2d139.71287809999998!3d35.689556200000006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188ce9b44d6fc7%3A0x47253a8b40523da5!2z44CSMTYwLTAwMjIg5p2x5Lqs6YO95paw5a6_5Yy65paw5a6_77yR5LiB55uu77yR77yZ4oiS77yR77yRIOOCteODs-ODouODvOODq-OCr-ODrOOCueODiA!5e0!3m2!1sja!2sjp!4v1715534820918!5m2!1sja!2sjp"
                allowfullscreen=""
              ></iframe>
            </div>
            <div class="infomation-text">
              <h3>株式会社Vueteck</h3>
              <ul>
                <li>〒160-0022 東京都新宿区新宿1-19-10 サンモールクレスト5F</li>
                <li>営業時間：10:00～19:00</li>
                <li>電話番号　03-6380-0698</li>
                <li>定休日：日祝</li>
              </ul>
            </div>
          </div>
        </section>
        <section class="section-news" id="news">
          <h2>ニュース</h2>
          <ol>
            <li>
              <div class="section-news_category">商品の追加</div>
              <h3>商品が3点追加されました。</h3>
              <time datetime="2025-01-10">2025/01/10</time>
            </li>
            <li>
              <div class="section-news_category">サイト開設</div>
              <h3>オンラインショップをオープンしました。</h3>
              <time datetime="2025-01-01">2025/01/01</time>
            </li>
          </ol>
        </section>
      </div>
    </main>
    @include('vue.footer')
  </body>
</html>
