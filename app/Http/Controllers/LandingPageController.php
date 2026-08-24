<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Review;

class LandingPageController extends Controller
{
    public function index(){
        
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get();
 
        $products = Product::where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();
 
        $reviews = Review::approved()->latest()->take(3)->get();

        return view('landing',compact('categories','products','reviews'));
    }
}
