<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aesthetica')</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>

    <!-- ================= NAVBAR ================= -->
    <nav class="navbar">
        <div class="container">

            <!-- Logo -->
            <div class="logo">
                <a href="{{ route('home') }}">Aesthetica</a>
            </div>

            <!-- NAV MENU -->
            <ul class="nav-menu">

                <!-- Always show -->
                <li><a href="{{ route('home') }}">Home</a></li>
               <li><a href="{{ url('/#about') }}">About</a></li>
               <li><a href="{{ url('/#contact') }}">Contact</a></li>


                <!-- GUEST MENU -->
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endguest

                <!-- AUTH MENU -->
                @auth

                    @if(Auth::user()->role === 'client')
                        <li><a href="{{ route('client.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('client.profile') }}">Profile</a></li>
                    @endif

                    @if(Auth::user()->role === 'worker')
                        <li><a href="{{ route('worker.portfolio') }}">My Portfolio</a></li>
                    @endif

                    <li><a href="{{ route('logout') }}">Logout</a></li>

                @endauth

            </ul>

        </div>
    </nav>


    <!-- ================= MAIN CONTENT ================= -->
    <div class="content">
        @yield('content')
    </div>


    <!-- ================= FOOTER ================= -->
    <footer class="footer">
        <p>© {{ date('Y') }} Aesthetica. All Rights Reserved.</p>
    </footer>


    <!-- JS -->
    <script src="{{ asset('assets/js/script.js') }}"></script>

</body>
</html>
