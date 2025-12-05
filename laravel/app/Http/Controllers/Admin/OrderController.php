<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order, App\Models\User;

class OrderController extends Controller {
    public function index(){ $orders = Order::latest()->paginate(20); return view('admin.orders.index', compact('orders')); }
    public function show(Order $order){ return view('admin.orders.show', compact('order')); }
    public function edit(Order $order){ $workers = User::where('role','worker')->get(); return view('admin.orders.edit', compact('order','workers')); }
    public function update(Request $r, Order $order){
        $data = $r->validate(['worker_id'=>'nullable|exists:users,id','status'=>'required']);
        $order->update($data);
        return redirect()->route('admin.orders.show',$order)->with('success','Order updated');
    }
    public function destroy(Order $order){ $order->delete(); return back()->with('success','Deleted'); }
    public function create(){}
    public function store(Request $r){}
}
