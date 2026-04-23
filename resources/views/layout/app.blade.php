<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECHフリマアプリ</title>
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-logo-group">
                <a href="/" class="header-logo-link">
                    <img src="{{ asset('images/COACHTECHヘッダーロゴ.png') }}" alt="COACHTECH" class="logo-image">
                </a>
            </div>
            @if(!Request::is('login','register'))
            <div class="header__search">
                <form action="{{ route('items') }}" class="search-form" method="get">
                    <input name="keyword" type="text" class="search-input" placeholder="何をお探しですか？">
                </form>
            </div>
            <div class="header__navi">
                <div class="header__navi-list">
                    <ul class="header__navi-ul">
                        @auth
                        <li class="header__navi-item">
                            <form action="/logout" method="POST">
                                @csrf
                                <button class="header__navi--logout" type="submit">ログアウト</button>
                            </form>
                        </li>
                        @else
                        <li class="header__navi-item"><a href="/login" class="header__navi--login">ログイン</a></li>
                        @endauth
                        <li class="header__navi-item"><a href="/mypage" class="header__navi--mypage">マイページ</a></li>
                        <li class="header__navi-item"><a href="/sell" class="header__navi--sell">出品</a></li>
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>