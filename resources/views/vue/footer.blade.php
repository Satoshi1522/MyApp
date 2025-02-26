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
    <footer class="footer">
      <div class="footer__container">
        <nav class="footer__site-map">
          <h2>Vue OnlineShop</h2>
          <ul>
            <li><a href="{{ route('vue.vue') }}">ホーム</a></li>
            <li><a href="{{ route('vue.vue') }}#information">実店舗(東京)</a></li>
          </ul>
        </nav>
        <div class="fotter_sns__links">
          <ul>
            <li>
              <img src="{{ asset('storage/common/instagram.png')}}" alt="instagram icon" />
            </li>
            <li><img src="{{ asset('storage/common/twitter.png')}}" alt="twitter icon" /></li>
            <li>
              <img src="{{ asset('storage/common/facebook.png')}}" alt="facebook icon" />
            </li>
          </ul>
        </div>
        <small>©Vue</small>
      </div>
    </footer>
  </body>
</html>
