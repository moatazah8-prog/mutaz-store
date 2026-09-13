<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'تم تحديث حالة الطلب بنجاح');
    }
}
