@extends('layouts.main')

@section('title', 'Order List')

@section('content')

<style>
    .orders-wrapper {
        max-width: 1250px;
        margin: auto;
        padding: 35px;
    }

    .page-title {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 25px;
    }

    /* SUMMARY CARDS */
    .summary-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        gap: 20px;
        margin-bottom: 35px;
    }

    .summary-card {
        background: linear-gradient(135deg, #000, #333);
        padding: 25px;
        border-radius: 14px;
        color: white;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }

    .summary-card h2 {
        margin: 0;
        font-size: 36px;
        font-weight: 800;
    }

    .summary-card p {
        margin: 4px 0 0;
        font-size: 14px;
        opacity: .8;
    }

    /* FILTER BAR */
    .filter-bar {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        overflow-x: auto;
    }

    .filter-btn {
        padding: 9px 20px;
        border-radius: 30px;
        background: #fff;
        border: 1px solid #ddd;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        transition: .2s ease;
        white-space: nowrap;
    }

    .filter-btn:hover {
        background: #000;
        color: #fff;
    }

    /* ORDERS TABLE */
    .orders-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .orders-table th {
        background: #111;
        color: white;
        padding: 15px;
        font-size: 15px;
    }

    .orders-table td {
        padding: 14px;
        border-bottom: 1px solid #eee;
        font-size: 14px;
        color: #444;
    }

    .status {
        font-weight: bold;
    }
    .pending { color: orange; }
    .progress { color: blue; }
    .completed { color: green; }
    .cancelled { color: red; }

    .btn-view {
        padding: 8px 16px;
        background: black;
        color: white;
        border-radius: 6px;
        text-decoration: none;
        font-size: 12px;
        transition: .2s;
    }

    .btn-view:hover {
        opacity: 0.8;
    }

</style>

<div class="orders-wrapper">

    <div class="page-title">📋 Order List</div>

    {{-- SUMMARY CARDS --}}
    <div class="summary-cards">

        <div class="summary-card">
            <h2>34</h2>
            <p>Completed Orders</p>
        </div>

        <div class="summary-card">
            <h2>12</h2>
            <p>In Progress</p>
        </div>

        <div class="summary-card">
            <h2>8</h2>
            <p>Pending Orders</p>
        </div>

        <div class="summary-card">
            <h2>$27,400</h2>
            <p>Total Earnings</p>
        </div>

    </div>


    {{-- FILTER BAR --}}
    <div class="filter-bar">
        <button class="filter-btn">All</button>
        <button class="filter-btn">Pending</button>
        <button class="filter-btn">In Progress</button>
        <button class="filter-btn">Completed</button>
        <button class="filter-btn">Cancelled</button>
    </div>


    {{-- ORDERS TABLE --}}
    <table class="orders-table">

        <thead>
            <tr>
                <th>Order ID</th>
                <th>Client</th>
                <th>Project</th>
                <th>Status</th>
                <th>Budget</th>
                <th>Deadline</th>
                <th>Payment</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <td>#ORD-20201</td>
                <td>Tanvir Ahmed</td>
                <td>Living Room Interior</td>
                <td class="status pending">Pending</td>
                <td>$350</td>
                <td>12 Feb 2025</td>
                <td>Unpaid</td>
                <td><a href="#" class="btn-view">View</a></td>
            </tr>

            <tr>
                <td>#ORD-20202</td>
                <td>Jannat Ara</td>
                <td>Bedroom Design</td>
                <td class="status progress">In Progress</td>
                <td>$600</td>
                <td>20 Feb 2025</td>
                <td>Partial</td>
                <td><a href="#" class="btn-view">View</a></td>
            </tr>

            <tr>
                <td>#ORD-20203</td>
                <td>Mehedi Hasan</td>
                <td>Kitchen Remodeling</td>
                <td class="status completed">Completed</td>
                <td>$1,400</td>
                <td>30 Jan 2025</td>
                <td>Paid</td>
                <td><a href="#" class="btn-view">View</a></td>
            </tr>

            <tr>
                <td>#ORD-20204</td>
                <td>Rafiul Islam</td>
                <td>Office Interior</td>
                <td class="status cancelled">Cancelled</td>
                <td>$700</td>
                <td>15 Feb 2025</td>
                <td>Unpaid</td>
                <td><a href="#" class="btn-view">View</a></td>
            </tr>

        </tbody>

    </table>

</div>

@endsection
