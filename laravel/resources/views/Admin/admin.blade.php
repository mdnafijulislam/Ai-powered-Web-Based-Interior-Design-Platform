<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','Admin Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style> /* basic admin CSS for demo */ body{font-family:Arial,Helvetica,sans-serif;} .sidebar{width:220px;position:fixed;left:0;top:0;bottom:0;background:#111;color:#fff;padding:20px} .main{margin-left:240px;padding:30px}</style>
    @yield('head')
</head>
<body>
    <div class="sidebar">
        <h2>Aesthetica Admin</h2>
        <ul>
            <li><a href="{{ route('admin.dashboard') }}" style="color:#fff">Overview</a></li>
            <li><a href="{{ route('admin.users.index') }}" style="color:#fff">Users</a></li>
            <li><a href="{{ route('admin.orders.index') }}" style="color:#fff">Orders</a></li>
            <li><a href="{{ route('admin.reviews.index') }}" style="color:#fff">Reviews</a></li>
            <li><a href="{{ route('admin.payouts.index') }}" style="color:#fff">Payouts</a></li>
        </ul>
    </div>

    <div class="main">
        @yield('content')
    </div>

    <script src="{{ asset('assets/js/script.js') }}"></script>
    @yield('scripts')
</body>
</html>
