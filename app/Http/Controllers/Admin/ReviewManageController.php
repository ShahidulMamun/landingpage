<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewManageController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Review::with('product')->latest();
 
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
 
        $reviews = $query->paginate(15)->withQueryString();
 
        $counts = [
            'all'      => Review::count(),
            'pending'  => Review::where('status', 'pending')->count(),
            'approved' => Review::where('status', 'approved')->count(),
            'rejected' => Review::where('status', 'rejected')->count(),
        ];
 
        return view('admin.reviews.index', compact('reviews', 'counts'));
    }
 
    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['pending', 'approved', 'rejected'])],
        ]);
 
        $review->update($validated);
 
        return back()->with('status', 'রিভিউ #' . $review->id . ' আপডেট হয়েছে');
    }
 
    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('status', 'রিভিউ ডিলিট হয়েছে');
    }
}
