<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Order;
use App\Models\Admin\Product;

class DashboardController extends Controller
{
    public function index()
    {
          $stats = [
            'total_products'   => Product::count(),
            'total_categories' => Category::count(),
            'total_orders'     => Order::count(),
            'pending_orders'   => Order::where('status', 'pending')->count(),
            'low_stock'        => Product::where('stock', '<=', 5)->count(),
            'revenue'          => Order::whereIn('status', ['confirmed', 'shipped', 'delivered'])->sum('total_price'),
            'unpaid_amount'    => Order::where('payment_status', 'unpaid')->sum('total_price'),
        ];
 
        $paymentCounts = [
            'unpaid'   => Order::where('payment_status', 'unpaid')->count(),
            'paid'     => Order::where('payment_status', 'paid')->count(),
            'refunded' => Order::where('payment_status', 'refunded')->count(),
        ];
 
        $recentOrders = Order::latest()->take(8)->get();
 
        return view('admin.dashboard', compact('stats', 'recentOrders', 'paymentCounts'));
    }
}