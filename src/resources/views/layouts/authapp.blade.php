<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/authcommon.css') }}">
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <a class="header__logo" href="/">FashionablyLate</a>
                <nav>
                    <ul class="header-nav">
                        @if (request()->is('login'))
                        <li class="header-nav__item">
                            <a class="header-nav__btn" href="/register" style="text-decoration: none; display: flex; align-items: center; justify-content: center;">
                                register
                            </a>
                        </li>
                        @endif
                        @if (request()->is('register'))
                        <li class="header-nav__item">
                             <a class="header-nav__btn" href="/login" style="text-decoration: none; display: flex; align-items: center; justify-content: center;">
                                login
                            </a>
                        </li>
                        @endif
                        @if (request()->is('admin'))
                        <li class="header-nav__item">
                            <form action="/logout" method="post">
                                @csrf
                                <button class="header-nav__btn" type="submid">logout</button>
                            </form>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
    
</body>
</html>