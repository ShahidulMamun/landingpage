<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create()
    {
        $products = Product::where('is_active', true)->orderBy('name')->get(['id', 'name']);
        return view('reviews.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id'    => ['nullable', 'exists:products,id'],
            'customer_name' => ['required', 'string', 'max:255'],
            'city'          => ['nullable', 'string', 'max:100'],
            'rating'        => ['required', 'integer', 'min:1', 'max:5'],
            'comment'       => ['required', 'string', 'max:2000'],
        ]);

        $validated['status'] = 'pending'; // অ্যাডমিন অ্যাপ্রুভ না করা পর্যন্ত পাবলিকলি দেখাবে না

        Review::create($validated);

        return response()->json([
            'message' => 'রিভিউ জমা দেওয়ার জন্য ধন্যবাদ! অ্যাপ্রুভ হলে সাইটে দেখা যাবে।',
        ]);
    }
}