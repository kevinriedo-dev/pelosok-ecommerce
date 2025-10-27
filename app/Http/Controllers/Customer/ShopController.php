<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['region', 'category', 'primaryImage'])
            ->where('is_active', true)
            ->where('stock', '>', 0);
        
        // Filter by category - SIMPLIFIED VERSION
        if ($request->has('category')) {
            $categories = $request->input('category');
            
            // Convert to array if single value
            if (!is_array($categories)) {
                $categories = [$categories];
            }
            
            // Remove empty values
            $categories = array_filter($categories);
            
            if (!empty($categories)) {
                $query->whereIn('category_id', $categories);
            }
        }
        
        // Filter by region - SIMPLIFIED VERSION
        if ($request->has('region')) {
            $regions = $request->input('region');
            
            // Convert to array if single value
            if (!is_array($regions)) {
                $regions = [$regions];
            }
            
            // Remove empty values
            $regions = array_filter($regions);
            
            if (!empty($regions)) {
                $query->whereIn('region_id', $regions);
            }
        }
        
        // Filter by price range
        if ($request->filled('price_range')) {
            $range = explode('-', $request->price_range);
            if (count($range) === 2) {
                $query->whereBetween('price', [(int)$range[0], (int)$range[1]]);
            }
        }
        
        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        // Sort
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            default:
                $query->latest();
        }
        
        // Paginate
        $products = $query->paginate(12);
        
        // Append filters to pagination
        $appendData = $request->only(['category', 'region', 'price_range', 'search', 'sort']);
        $products->appends($appendData);
        
        // For filter dropdowns
        $categories = Category::orderBy('name')->get();
        $regions = Region::orderBy('name')->get();
        
        return view('customer.shop.index', compact('products', 'categories', 'regions'));
    }
    
    public function show($slug)
    {
        $product = Product::with(['region', 'category', 'images'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        
        // Related products (same category, different product)
        $relatedProducts = Product::with(['primaryImage'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->take(4)
            ->get();
        
        return view('customer.shop.show', compact('product', 'relatedProducts'));
    }
}