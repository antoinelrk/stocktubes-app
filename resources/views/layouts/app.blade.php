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
                            <img class="profile-picture" src="/storage/avatars/default.jpg" alt="">
                        </a>
                    </div>
                @endauth
            </nav>
        </header>
        @yield('content')
        <footer>
            <span>&copy; <a href="https://antoinelrk.com" target="_blank">Antoine LRK</a> • 2015 - 2023</span>
        </footer>
    </div>
</body>
</html>