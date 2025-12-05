<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Aesthetica')</title>

    <!-- CSRF Token for AJAX (REQUIRED for Chat System) -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        /* Chat page styling */
        body.chat-page {
            background: #f5f5f5;
            min-height: 100vh;
        }
        .content {
            padding-bottom: 40px;
        }
    </style>
</head>

<body class="@yield('body-class')">

    <!-- ================= NAVBAR ================= -->
    <nav class="navbar">
        <div class="container">

            <!-- Logo -->
            <div class="logo">
                <a href="{{ route('home') }}">Aesthetica</a>
            </div>

            <!-- NAV MENU -->
            <ul class="nav-menu">

                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>

                @auth

                    {{-- CLIENT MENU --}}
                    @if(Auth::user()->role === 'client')
                        <li><a href="{{ route('client.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('client.bookings') }}">Bookings</a></li>
                        <li><a href="{{ route('client.profile') }}">Profile</a></li>
                    @endif

                    {{-- WORKER MENU --}}
                    @if(Auth::user()->role === 'worker')
                        <li><a href="{{ route('worker.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('worker.bookings') }}">Bookings</a></li>
                        <li><a href="{{ route('worker.profile') }}">Profile</a></li>
                    @endif

                    {{-- Logout --}}
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


    <!-- ================= GLOBAL CSRF AUTO-INJECT FOR FETCH ================= -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const csrf = document.querySelector('meta[name="csrf-token"]').content;

            // override window.fetch globally
            const originalFetch = window.fetch;
            window.fetch = function (url, options = {}) {
                options.headers = options.headers || {};
                options.headers['X-CSRF-TOKEN'] = csrf;
                options.headers['X-Requested-With'] = "XMLHttpRequest";
                return originalFetch(url, options);
            };
        });
    </script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/script.js') }}"></script>

</body>
</html>
