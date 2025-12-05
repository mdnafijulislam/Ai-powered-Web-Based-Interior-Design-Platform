<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f6fa;
        }

        .admin-wrapper {
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            background: #111;
            color: #fff;
            height: 100vh;
            padding: 20px 0;
            position: fixed;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #ddd;
            text-decoration: none;
            margin-bottom: 5px;
            transition: 0.2s;
        }
        .sidebar a:hover {
            background: #333;
            color: #fff;
        }

        /* Content */
        .content-area {
            margin-left: 240px;
            padding: 25px;
            width: calc(100% - 240px);
        }

        .topbar {
            background: #fff;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 18px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
        }
        .card h1 {
            margin: 0;
            font-size: 34px;
        }
        .card p {
            margin: 0;
            margin-top: 6px;
            color: #666;
        }
    </style>

    @yield('head')
</head>

<body>

<div class="admin-wrapper">

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.users.index') }}">Users</a>
        <a href="{{ route('admin.orders.index') }}">Orders</a>
        <a href="{{ route('admin.reviews.index') }}">Reviews</a>
        <a href="{{ route('admin.payouts.index') }}">Payouts</a>
        <a href="{{ route('admin.tickets.index') }}">Support Tickets</a>
        <a href="{{ route('logout') }}">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content-area">
        <div class="topbar">Welcome, Admin 👑</div>

        @yield('content')
    </div>

</div>

@yield('scripts')
</body>
</html>
