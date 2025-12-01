<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // ============================
    // LIST PAGE (with search/filter)
    // ============================
    public function index(Request $request)
    {
        $query = Order::query()->where('worker_id', Auth::id());

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($q2) use ($q) {
                $q2->where('order_key', 'like', "%$q%")
                    ->orWhere('client_name', 'like', "%$q%")
                    ->orWhere('project_title', 'like', "%$q%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(10)->withQueryString();

        $stats = [
            'completed' => Order::where('status', 'completed')->count(),
            'in_progress' => Order::where('status', 'in_progress')->count(),
            'pending' => Order::where('status', 'pending')->count(),
            'earnings' => Order::where('payment_status', 'paid')->sum('budget')
        ];

        return view('worker.orders', compact('orders', 'stats'));
    }

    // ============================
    // ORDER DETAILS PAGE
    // ============================
    public function show(Order $order)
    {
        $order->load('messages');
        return view('worker.order-show', compact('order'));
    }

    // ============================
    // SEND MESSAGE + UPLOAD FILE
    // ============================
    public function message(Request $request, Order $order)
    {
        $request->validate([
            'message' => 'nullable|string',
            'attachment' => 'nullable|mimes:png,jpg,jpeg,pdf,zip|max:5120',
        ]);

        $filePath = null;
        if ($request->hasFile('attachment')) {

            $name = time() . '_' . Str::random(6) . '.' . $request->attachment->extension();

            $folder = public_path('uploads/orders/' . $order->id);
            if (!file_exists($folder)) mkdir($folder, 0775, true);

            $request->attachment->move($folder, $name);

            $filePath = 'uploads/orders/' . $order->id . '/' . $name;
        }

        OrderMessage::create([
            'order_id' => $order->id,
            'sender' => Auth::user()->name,
            'message' => $request->message,
            'attachment' => $filePath
        ]);

        return back();
    }

    // ============================
    // UPDATE PROGRESS BAR (0–100)
    // ============================
    public function updateProgress(Request $request, Order $order)
    {
        $order->progress = $request->progress;
        $order->save();

        return back()->with('success', 'Progress updated.');
    }

    // ============================
    // UPLOAD DELIVERABLES
    // ============================
    public function uploadDeliverable(Request $request, Order $order)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,pdf,zip|max:10000'
        ]);

        $name = time() . '_' . Str::random(6) . '.' . $request->file->extension();

        $folder = public_path('uploads/deliverables/' . $order->id);
        if (!file_exists($folder)) mkdir($folder, 0775, true);

        $request->file->move($folder, $name);

        $deliverables = $order->deliverables ?? [];
        $deliverables[] = 'uploads/deliverables/' . $order->id . '/' . $name;

        $order->deliverables = $deliverables;
        $order->save();

        return back()->with('success', 'File uploaded.');
    }
}
