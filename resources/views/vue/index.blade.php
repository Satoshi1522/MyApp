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
                      <p class="error">入荷待ち</p>
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
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3240.5732085635327!2d139.71100547625866!3d35.68750952962837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188cea2f4009f9%3A0x36a1c52078eedab!2z44CSMTYwLTAwMjIg5p2x5Lqs6YO95paw5a6_5Yy65paw5a6_77yR5LiB55uu77yR4oiS77yRIOODr-OCs-ODvOW-oeiLkeODk-ODqw!5e0!3m2!1sja!2sjp!4v1740828469173!5m2!1sja!2sjp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="infomation-text">
              <h3>株式会社Vue</h3>
              <ul>
                <li>〒111-111 東京都新宿区新宿１丁目１００−１００ 日本ビル</li>
                <li>営業時間：10:00～19:00</li>
                <li>電話番号　0120-0000-0000</li>
                <li>定休日：土日祝</li>
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
