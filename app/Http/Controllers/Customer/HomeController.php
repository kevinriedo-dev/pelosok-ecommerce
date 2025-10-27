<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Region;

class HomeController extends Controller
{
    public function index()
    {
        // Featured products (latest 8)
        $featuredProducts = Product::with(['region', 'category', 'primaryImage'])
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->latest()
            ->take(8)
            ->get();
        
        // All categories for display
        $categories = Category::orderBy('name')->get();
        
        // All regions for display
        $regions = Region::orderBy('name')->get();
        
        return view('customer.home', compact('featuredProducts', 'categories', 'regions'));
    }
}