@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')

<h1 style="margin-bottom: 20px;">Dashboard Overview</h1>

<div class="grid">

    <div class="card">
        <h1>{{ $totalUsers }}</h1>
        <p>Total Users</p>
    </div>

    <div class="card">
        <h1>{{ $totalClients }}</h1>
        <p>Total Clients</p>
    </div>

    <div class="card">
        <h1>{{ $totalWorkers }}</h1>
        <p>Total Workers</p>
    </div>

    <div class="card">
        <h1>{{ $totalOrders }}</h1>
        <p>Total Orders</p>
    </div>

    <div class="card">
        <h1>{{ $completedOrders }}</h1>
        <p>Completed Orders</p>
    </div>

    <div class="card">
        <h1>{{ $pendingOrders }}</h1>
        <p>Pending Orders</p>
    </div>

    <div class="card">
        <h1>${{ number_format($totalRevenue, 2) }}</h1>
        <p>Total Revenue</p>
    </div>

</div>

<br><br>

<div class="card" style="padding: 30px;">
    <h3>Monthly Revenue Chart</h3>
    <canvas id="revenueChart" height="120"></canvas>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const labels = {!! json_encode($monthly->pluck('month')) !!};
const data = {!! json_encode($monthly->pluck('total')) !!};

new Chart(document.getElementById('revenueChart'), {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Revenue',
            data: data,
            borderColor: '#111',
            backgroundColor: 'rgba(0,0,0,0.1)',
            fill: true
        }]
    },
    options: { responsive:true }
});
</script>

@endsection
