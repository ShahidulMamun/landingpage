<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Order;


class OrderManageController extends Controller
{
      public function index(Request $request)
    {
        $query = Order::query()->latest();
 
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
 
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }
 
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($qq) use ($search) {
                $qq->where('customer_name', 'like', "%{$search}%")
                   ->orWhere('phone', 'like', "%{$search}%")
                   ->orWhere('id', $search);
            });
        }
 
        $orders = $query->paginate(15)->withQueryString();
 
        $counts = [
            'all'       => Order::count(),
            'pending'   => Order::where('status', 'pending')->count(),
            'confirmed' => Order::where('status', 'confirmed')->count(),
            'shipped'   => Order::where('status', 'shipped')->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];
 
        return view('admin.orders.index', compact('orders', 'counts'));
    }
 
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }
 
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status'         => ['required', Rule::in(Order::STATUSES)],
            'payment_status' => ['required', Rule::in(Order::PAYMENT_STATUSES)],
        ]);
 
        $order->update($validated);
 
        return back()->with('status', 'অর্ডার #' . $order->id . ' আপডেট হয়েছে');
    }
 
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('status', 'অর্ডার ডিলিট হয়েছে');
    }
}
