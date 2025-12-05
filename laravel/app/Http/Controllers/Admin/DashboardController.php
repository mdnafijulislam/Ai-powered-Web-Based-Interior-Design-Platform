<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User, App\Models\Order;
use DB;

class DashboardController extends Controller {
    public function index() {
        $totalUsers = User::count();
        $totalClients = User::where('role','client')->count();
        $totalWorkers = User::where('role','worker')->count();
        $totalOrders = Order::count();
        $completedOrders = Order::where('status','completed')->count();
        $pendingOrders = Order::where('status','pending')->count();
        $totalRevenue = Order::where('paid',true)->sum('price');

        $monthly = Order::where('paid',true)
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, SUM(price) as total")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers','totalClients','totalWorkers','totalOrders',
            'completedOrders','pendingOrders','totalRevenue','monthly'
        ));
    }
}
