<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id'     => ['required', 'integer'],
            'product_name'   => ['required', 'string', 'max:255'],
            'unit_price'     => ['required', 'integer', 'min:0'],
            'quantity'       => ['required', 'integer', 'min:1', 'max:20'],
            'customer_name'  => ['required', 'string', 'max:255'],
            'phone'          => ['required', 'regex:/^01[3-9][0-9]{8}$/'],
            'address'        => ['required', 'string', 'max:1000'],
            'payment_method' => ['required', Rule::in(['cod', 'bkash'])],
        ]);

        $order = Order::create([
            ...$validated,
            'total_price' => $validated['unit_price'] * $validated['quantity'],
            'status'      => 'pending',
        ]);
        
        // Notification::route('...')->notify(new OrderPlaced($order));

        return response()->json([
            'message' => 'Order placed successfully',
            'order_id' => $order->id,
        ]);
    }
}