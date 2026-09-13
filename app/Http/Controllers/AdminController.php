<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;

class AdminController extends Controller
{
    public function index()
    {
        if (!session('admin_id')) {
            return redirect('/admin/login');
        }

        $admin = Admin::find(session('admin_id'));

        if (!$admin) {
            session()->forget('admin_id');
            return redirect('/admin/login');
        }

        $ordersCount = Order::count();
        $productsCount = Product::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalSales = Order::where('status', '!=', 'cancelled')->sum('total');
        $totalProfit = \App\Models\OrderItem::whereHas('order', function ($q) { $q->where('status', '!=', 'cancelled'); })->selectRaw('COALESCE(SUM((price - cost_price) * quantity), 0) as profit')->value('profit');
        $inventoryValue = Product::selectRaw("COALESCE(SUM(cost_price * stock), 0) as value")->value("value");
        $topProducts = OrderItem::whereHas("order", function ($q) { $q->where("status", "!=", "cancelled"); })->selectRaw("product_id, SUM(quantity) as total_quantity, SUM(price * quantity) as total_sales, SUM((price - cost_price) * quantity) as total_profit")->groupBy("product_id")->orderByDesc("total_quantity")->with("product")->take(5)->get();
        $todaySales = Order::where("status", "!=", "cancelled")->whereDate("created_at", today())->sum("total");
        $todayProfit = OrderItem::whereHas("order", function ($q) { $q->where("status", "!=", "cancelled")->whereDate("created_at", today()); })->selectRaw("COALESCE(SUM((price - cost_price) * quantity), 0) as profit")->value("profit");
        $weekSales = Order::where("status", "!=", "cancelled")->whereBetween("created_at", [now()->startOfWeek(), now()->endOfWeek()])->sum("total");
        $weekProfit = OrderItem::whereHas("order", function ($q) { $q->where("status", "!=", "cancelled")->whereBetween("created_at", [now()->startOfWeek(), now()->endOfWeek()]); })->selectRaw("COALESCE(SUM((price - cost_price) * quantity), 0) as profit")->value("profit");
        $monthSales = Order::where("status", "!=", "cancelled")->whereMonth("created_at", now()->month)->whereYear("created_at", now()->year)->sum("total");
        $monthProfit = OrderItem::whereHas("order", function ($q) { $q->where("status", "!=", "cancelled")->whereMonth("created_at", now()->month)->whereYear("created_at", now()->year); })->selectRaw("COALESCE(SUM((price - cost_price) * quantity), 0) as profit")->value("profit");
        $yearSales = Order::where("status", "!=", "cancelled")->whereYear("created_at", now()->year)->sum("total");
        $yearProfit = OrderItem::whereHas("order", function ($q) { $q->where("status", "!=", "cancelled")->whereYear("created_at", now()->year); })->selectRaw("COALESCE(SUM((price - cost_price) * quantity), 0) as profit")->value("profit");
        $monthlySales = Order::where("status", "!=", "cancelled")->whereYear("created_at", now()->year)->selectRaw("CAST(strftime('%m', created_at) AS INTEGER) as month, SUM(total) as total")->groupBy("month")->orderBy("month")->pluck("total", "month");
        $monthlyProfit = OrderItem::whereHas("order", function ($q) { $q->where("status", "!=", "cancelled")->whereYear("created_at", now()->year); })->selectRaw("CAST(strftime('%m', created_at) AS INTEGER) as month, SUM((price - cost_price) * quantity) as total")->groupBy("month")->orderBy("month")->pluck("total", "month");
        $lowStockProducts = Product::where('stock', '<=', 3)->orderBy('stock')->get();

        $latestOrders = Order::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'admin',
            'ordersCount',
            'productsCount',
            'pendingOrders',
            'totalSales',
            'totalProfit', 'inventoryValue', 'todaySales', 'todayProfit', 'weekSales', 'weekProfit', 'monthSales', 'monthProfit', 'yearSales', 'yearProfit', 'monthlySales', 'monthlyProfit',
            'latestOrders',
            'lowStockProducts', 'topProducts'
        ));
    }
}
