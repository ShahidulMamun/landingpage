<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Category;

class LandingPageController extends Controller
{
    public function index(){
        
        $categories = Category::where('is_active',true)->orderBy('sort_order','ASC')->get();
        return view('landing',compact('categpries'));
    }
}
