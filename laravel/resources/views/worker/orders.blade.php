@extends('layouts.main')

@section('title', 'Order List')

@section('content')

<style>
    .orders-wrapper {
        max-width: 1200px;
        margin: auto;
        padding: 30px;
    }

    .summary-cards {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 35px;
    }

    .summary-card {
        background: #fff;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        text-align: center;
    }

    .summary-card h3 {
        font-size: 28px;
        margin-bottom: 5px;
        color: #000;
    }

    .summary-card p {
        color: gray;
        font-size: 14px;
    }

    /* FILTER BAR */
    .filter-bar {
        background: #f8f8f8;
        padding: 12px;
        border-radius: 12px;
        margin-bottom: 20px;
        display: flex;
        gap: 10px;
        overflow-x: auto;
    }

    .filter-btn {
        padding: 8px 16px;
        border-radius: 30px;
        background: #fff;
        border: 1px solid #ddd;
        cursor: pointer;
        font-size: 14px;
        transition: .2s;
    }

    .filter-btn:hover {
        background: #000;
        color: #fff;
    }

    /* TABLE */
    .orders-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    .orders-table th, .orders-table td {
        padding: 14px;
        border-bottom: 1px solid #eee;
        text-align: left;
        font-size: 14px;
    }

    .orders-table th {
        background: #fafafa;
        font-weight: 700;
        font-size: 15px;
    }

    .btn-view {
        background: black;
        color: white;
        padding: 8px 14px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 12px;
    }

    /* STATUS COLORS */
    .status-pending { color: orange; font-weight: 700; }
    .status-progress { color: blue; font-weight: 700; }
    .status-completed { color: green; font-weight: 700; }
    .status-cancelled { color: red; font-weight: 700; }

    @media(max-width:768px){
        .summary-cards {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media(max-width:480px){
        .summary-cards {
            grid-template-columns: 1fr;
        }
    }
</style>


<div class="orders-wrapper">

    {{-- =======================
         TOP SUMMARY CARDS
    =========================--}}
    <div class="summary-cards">

        <div class="summary-card">
            <h3>34</h3>
            <p>Completed Orders</p>
        </div>

        <div class="summary-card">
            <h3>12</h3>
            <p>Active / In Progress</p>
        </div>

        <div class="summary-card">
            <h3>8</h3>
            <p>Pending Orders</p>
        </div>

        <div class="summary-card">
            <h3>$27,400</h3>
            <p>Total Earnings</p>
        </div>

    </div>


    {{-- =======================
          FILTER BAR
    =========================--}}
    <div class="filter-bar">
        <button class="filter-btn">All</button>
        <button class="filter-btn">Pending</button>
        <button class="filter-btn">In Progress</button>
        <button class="filter-btn">Completed</button>
        <button class="filter-btn">Cancelled</button>
    </div>


    {{-- =======================
         ORDERS TABLE
    =========================--}}
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

            <!-- SAMPLE ROW 1 -->
            <tr>
                <td>#ORD-20201</td>
                <td>Tanvir Ahmed</td>
                <td>Living Room Interior</td>

                <td class="status-pending">Pending</td>

                <td>$350</td>
                <td>12 Feb 2025</td>
                <td>Unpaid</td>

                <td><a href="#" class="btn-view">View</a></td>
            </tr>

            <!-- SAMPLE ROW 2 -->
            <tr>
                <td>#ORD-20202</td>
                <td>Jannat Ara</td>
                <td>Bedroom Design</td>

                <td class="status-progress">In Progress</td>

                <td>$600</td>
                <td>20 Feb 2025</td>
                <td>Partial</td>

                <td><a href="#" class="btn-view">View</a></td>
            </tr>

            <!-- SAMPLE ROW 3 -->
            <tr>
                <td>#ORD-20203</td>
                <td>Mehedi Hasan</td>
                <td>Kitchen Remodeling</td>

                <td class="status-completed">Completed</td>

                <td>$1,400</td>
                <td>30 Jan 2025</td>
                <td>Paid</td>

                <td><a href="#" class="btn-view">View</a></td>
            </tr>

            <!-- SAMPLE ROW 4 -->
            <tr>
                <td>#ORD-20204</td>
                <td>Rafiul Islam</td>
                <td>Office Interior</td>

                <td class="status-cancelled">Cancelled</td>

                <td>$700</td>
                <td>15 Feb 2025</td>
                <td>Unpaid</td>

                <td><a href="#" class="btn-view">View</a></td>
            </tr>

        </tbody>

    </table>


</div>

@endsection
