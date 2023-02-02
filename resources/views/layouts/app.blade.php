<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/js/app.js')
</head>
<body>
    <div id="app">
        @if (session()->get('errors') !== null)
        <div class="notifications-wrapper js-popup errors">
            <div class="notification-content">{{ session()->get('errors') }}</div>
            <button class="js-close-popup">
                <figure>
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 320 512">
                        <path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/>
                    </svg>
                </figure>
            </button>
        </div>
        @endif
        @if (session()->get('success') !== null)
        <div class="notifications-wrapper js-popup success">
            <div class="notification-content">{{ session()->get('success') }}</div>
            <button class="js-close-popup">
                <figure>
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 320 512">
                        <path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/>
                    </svg>
                </figure>
            </button>
        </div>
        @endif
        <header>
            <nav>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    @auth
                        <li><a href="{{ route('tubes') }}">Tubes</a></li>
                        <li><a href="#">SemiConductors</a></li>
                        <li><a href="{{ route('logout') }}">Logout</a></li>
                    @endauth
                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                    @endguest
                </ul>
                @auth
                    <div class="avatar">
                        <a class="profile-link" href="{{ route('users.profile') }}">
                            <img class="profile-picture" src="/images/default.png" alt="">
                        </a>
                    </div>
                @endauth
            </nav>
        </header>
        @yield('content')
        <footer>
            <span>&copy; <a href="https://antoinelrk.com" target="_blank">Antoine LRK</a> • 2015 - 2023 @auth @if(auth()->user()->is_admin) • <a href="{{ route('dashboard') }}">Administration</a> @endif @endauth</span>
        </footer>
    </div>
</body>
</html>