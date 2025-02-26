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
  </head>
  <body>
    <header class="header">
      <h1 id="top"><a href="{{ route('vue.vue') }}">Vue OnlineShop</a></h1>
      <div id="nav-drawer">
        <input id="nav-input" class="none" type="checkbox" />
        <label id="nav-open" for="nav-input"><span> </span></label>
        <label id="nav-close" class="none" for="nav-input"></label>
        <nav id="nav-content" class="header__navigation">
          <div class="nav-drawer__title none"><a href="{{ route('vue.vue') }}">Vue OnlineShop</a></div>
          <ul>
            <li><a href="{{ route('vue.vue') }}#information">実店舗(東京)</a></li>
            <li><a href="{{ route('vue.cart') }}">カート</a></li>
          </ul>
        </nav>
      </div>
    </header>
  </body>
</html>
