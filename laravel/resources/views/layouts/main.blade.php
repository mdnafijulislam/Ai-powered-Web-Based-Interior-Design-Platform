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
        <div class="logo">Aesthetica</div>

        <ul class="nav-links">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        </ul>
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
