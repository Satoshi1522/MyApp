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
    <link rel="stylesheet" href="{{ asset('storage/css/complete.css')}}" />
  </head>
  <body>
    @include('vue.header')
    <main class="main">
      <section class="section-complete">
        <div class="main-wrapper">
          <h2>注文が確定しました！</h2>
          <p class="complete-text">発送されましたらメールが届きますのでご確認ください。</p>
          <p class="complete-caution">※銀行振込の方は、振込の確認が取れ次第の発送となります。<br>登録アドレスまで振込先の情報をお送りいたしますのでご確認ください。</p>
        </div>
      </section>
    </main>
    @include('vue.footer')
  </body>
</html>