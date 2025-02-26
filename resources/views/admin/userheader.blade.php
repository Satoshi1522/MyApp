<!DOCTYPE html>
<link rel="stylesheet" href="{{ asset('storage/css/admin.css')}}" />
  <header>
    @php
    $login_user = Auth::user();
    @endphp
    <div class="user-name__wrapper">
      <p class="user-name">{{ $login_user->name }}</p>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a class="logout-button" onclick="event.preventDefault(); this.closest('form').submit();">ログアウト</a>
    </form>
    </div>
    <div class="admin-header">
      <div class="admin-header__links">
        <h1><a href="{{ route('admin.admin') }}">Vueオンラインショップ</a></h1>
        <ul class="admin-nav">
          <li><a href="{{ route('admin.order.list') }}">注文リスト</a></li>
          <li><a href="{{ route('admin.order.sending') }}">発送済みリスト</a></li>
          <li><a href="{{ route('admin.order.canceled') }}">キャンセルリスト</a></li>
          @if($login_user->admin_flag == true)<li><a href="{{ route('admin.item.list') }}">商品リスト</a></li> @endif
          @if($login_user->admin_flag == true)<li><a href="{{ route('admin.user.list') }}">ユーザーリスト</a></li>@endif
        </ul>
      </div>
      <form action="{{ route('admin.user.search') }}" method="get" class="search-form">
        @csrf
        <label>
          <input type="text" name="keyword" class="client-search" placeholder="ユーザー検索"/>
        </label>
        <button type="submit" class="client-search__button">検索</button>
      </form>
    </div>
  </header>