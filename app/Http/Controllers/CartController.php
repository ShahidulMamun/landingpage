<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CartController extends Controller
{
    private const DELIVERY_CHARGES = [
        'dhaka'         => 80,
        'outside_dhaka' => 120,
    ];

    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity'   => ['nullable', 'integer', 'min:1', 'max:20'],
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $qty = $validated['quantity'] ?? 1;

        $cart = session('cart', []);
        $cart[$product->id] = ($cart[$product->id] ?? 0) + $qty;

        // স্টকের বেশি অ্যাড করা যাবে না
        if ($product->stock > 0) {
            $cart[$product->id] = min($cart[$product->id], $product->stock);
        }

        session(['cart' => $cart]);

        return response()->json([
            'message'    => $product->name . ' কার্টে যোগ হয়েছে',
            'cart_count' => array_sum($cart),
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer'],
            'quantity'   => ['required', 'integer', 'min:1', 'max:20'],
        ]);

        $cart = session('cart', []);

        if (isset($cart[$validated['product_id']])) {
            $cart[$validated['product_id']] = $validated['quantity'];
            session(['cart' => $cart]);
        }

        return $this->cartResponse();
    }

    public function remove(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer'],
        ]);

        $cart = session('cart', []);
        unset($cart[$validated['product_id']]);
        session(['cart' => $cart]);

        return $this->cartResponse();
    }

    public function index()
    {
        return $this->cartResponse();
    }

    private function cartResponse()
    {
        $cart = session('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->where('is_active', true)->get();

        $items = $products->map(function ($product) use ($cart) {
            $qty = $cart[$product->id];
            return [
                'product_id' => $product->id,
                'name'       => $product->name,
                'price'      => $product->price,
                'image'      => $product->image ? asset('storage/' . $product->image) : null,
                'quantity'   => $qty,
                'subtotal'   => $product->price * $qty,
            ];
        })->values();

        return response()->json([
            'items'      => $items,
            'subtotal'   => $items->sum('subtotal'),
            'cart_count' => $items->sum('quantity'),
        ]);
    }

    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'customer_name'  => ['required', 'string', 'max:255'],
            'phone'          => ['required', 'regex:/^01[3-9][0-9]{8}$/'],
            'address'        => ['required', 'string', 'max:1000'],
            'delivery_area'  => ['required', Rule::in(array_keys(self::DELIVERY_CHARGES))],
            'payment_method' => ['required', Rule::in(['cod', 'bkash'])],
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return response()->json(['message' => 'কার্ট খালি'], 422);
        }

        $products = Product::whereIn('id', array_keys($cart))->where('is_active', true)->get();

        if ($products->isEmpty()) {
            return response()->json(['message' => 'কার্টের প্রোডাক্টগুলো আর available নেই'], 422);
        }

        $deliveryCharge = self::DELIVERY_CHARGES[$validated['delivery_area']];
        $orderIds = [];

     
        $groupId = $products->count() > 1 ? (string) Str::uuid() : null;

        foreach ($products as $i => $product) {
            $qty = $cart[$product->id];

            $order = Order::create([
                'order_group_id'  => $groupId,
                'product_id'      => $product->id,
                'product_name'    => $product->name,
                'unit_price'      => $product->price,
                'quantity'        => $qty,
                'delivery_area'   => $validated['delivery_area'],
                'delivery_charge' => $i === 0 ? $deliveryCharge : 0,
                'total_price'     => ($product->price * $qty) + ($i === 0 ? $deliveryCharge : 0),
                'customer_name'   => $validated['customer_name'],
                'phone'           => $validated['phone'],
                'address'         => $validated['address'],
                'payment_method'  => $validated['payment_method'],
                'payment_status'  => 'unpaid',
                'status'          => 'pending',
            ]);

            $orderIds[] = $order->id;
        }

        session()->forget('cart');

        return response()->json([
            'message'   => 'অর্ডার সফলভাবে সাবমিট হয়েছে',
            'order_ids' => $orderIds,
        ]);
    }
}