<?php

namespace App\Http\Controllers;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
       
     $faqs = Faq::where('is_active', true)->orderBy('sort_order')->get();
     return view('faq', compact('faqs'));
 
    }
}