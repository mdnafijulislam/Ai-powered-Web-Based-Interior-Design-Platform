@extends('layouts.main')

@section('title', 'Order List')

@section('content')

<style>
/* ================================
   PRO LEVEL DASHBOARD DESIGN
================================ */

.orders-wrapper {
    max-width: 1350px;
    margin: auto;
    padding: 40px 30px;
}

/* PAGE TITLE */
.page-title {
    font-size: 34px;
    font-weight: 700;
    margin-bottom: 25px;
    text-align: center;
    background: linear-gradient(90deg, #000, #555);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* SUMMARY CARDS */
.summary-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 22px;
    margin-bottom: 40px;
}

.summary-card {
    background: white;
    padding: 28px;
    border-radius: 18px;
    text-align: center;
    box-shadow: 0 5px 18px rgba(0,0,0,0.08);
    transition: .25s ease;
}

.summary-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

.summary-card h3 {
    font-size: 34px;
    margin-bottom: 5px;
    font-weight: 700;
}

.summary-card p {
    color: #666;
    font-size: 15px;
}

/* FILTER BUTTONS */
.filter-bar {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 25px;
}

.filter-btn {
    padding: 10px 20px;
    border-radius: 25px;
    border: none;
    cursor: pointer;
    font-size: 15px;
    background: #f2f2f2;
    transition: .25s ease;
}

.filter-btn:hover {
    background: black;
    color: white;
}

/* TABLE STYLING */
.orders-table-container {
    background: white;
    padding: 25px;
    border-radius: 18px;
    box-shadow: 0 5px 18px rgba(0,0,0,0.08);
}

.orders-table {
    width: 100%;
    border-collapse: collapse;
}

.orders-table th {
    padding: 14px;
    font-size: 15px;
    background: #fafafa;
    border-bottom: 2px solid #eee;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.orders-table td {
    padding: 16px;
    border-bottom: 1px solid #f0f0f0;
    font-size: 15px;
}

/* STATUS COLORS */
.status-pending { color: #ff9800; font-weight: 700; }
.status-progress { color: #0066ff; font-weight: 700; }
.status-completed { color: #27a844; font-weight: 700; }
.status-cancelled { color: #e62828; font-weight: 700; }

/* VIEW BUTTON */
.btn-view {
    background: black;
    color: white;
    padding: 8px 18px;
    border-radius: 8px;
    font-size: 13px;
    text-decoration: none;
    transition: .25s ease;
}

.btn-view:hover {
    background: #2a2a2a;
}
</style>




<div class="orders-wrapper">

    <h2 class="page-title">📦 Worker Order Management</h2>

    {{-- TOP SUMMARY CARDS --}}
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


    {{-- FILTER BUTTONS --}}
    <div class="filter-bar">
        <button class="filter-btn">All</button>
        <button class="filter-btn">Pending</button>
        <button class="filter-btn">In Progress</button>
        <button class="filter-btn">Completed</button>
        <button class="filter-btn">Cancelled</button>
    </div>


    {{-- TABLE --}}
    <div class="orders-table-container">
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
                    <td class="status-pending">Pending</td>
                    <td>$350</td>
                    <td>12 Feb 2025</td>
                    <td>Unpaid</td>
                    <td><a href="#" class="btn-view">View</a></td>
                </tr>

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

</div>

@endsection
