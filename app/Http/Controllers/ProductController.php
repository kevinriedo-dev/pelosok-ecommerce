<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Region;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of products
     */
    public function index()
    {
        $products = Product::with(['region', 'category', 'primaryImage'])
            ->latest()
            ->paginate(10);
        
        return view('products.index', compact('products'));
    }

    /**
     * Show form to create new product
     */
    public function create()
    {
        $regions = Region::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        
        return view('products.create', compact('regions', 'categories'));
    }

    /**
     * Store new product in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:products,name',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'region_id' => 'required|exists:regions,id',
            'category_id' => 'required|exists:categories,id',
            'material' => 'nullable|max:255',
            'size_info' => 'nullable',
            'care_instructions' => 'nullable',
            'is_active' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Start database transaction
        DB::beginTransaction();
        try {
            // Create product
            $product = Product::create($validated);

            // Handle multiple images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $imageName = time() . '_' . $index . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images/products'), $imageName);
                    
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => 'images/products/' . $imageName,
                        'is_primary' => $index === 0, // First image is primary
                        'order' => $index
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('products.index')
                ->with('success', 'Product created successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error creating product: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display single product
     */
    public function show(Product $product)
    {
        $product->load(['region', 'category', 'images']);
        return view('products.show', compact('product'));
    }

    /**
     * Show form to edit product
     */
    public function edit(Product $product)
    {
        $regions = Region::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $product->load('images');
        
        return view('products.edit', compact('product', 'regions', 'categories'));
    }

    /**
     * Update product in database
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:products,name,' . $product->id,
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'region_id' => 'required|exists:regions,id',
            'category_id' => 'required|exists:categories,id',
            'material' => 'nullable|max:255',
            'size_info' => 'nullable',
            'care_instructions' => 'nullable',
            'is_active' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        DB::beginTransaction();
        try {
            // Update product
            $product->update($validated);

            // Handle new images
            if ($request->hasFile('images')) {
                $existingImagesCount = $product->images()->count();
                
                foreach ($request->file('images') as $index => $image) {
                    $imageName = time() . '_' . ($existingImagesCount + $index) . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images/products'), $imageName);
                    
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => 'images/products/' . $imageName,
                        'is_primary' => false,
                        'order' => $existingImagesCount + $index
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('products.index')
                ->with('success', 'Product updated successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error updating product: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Delete product from database
     */
    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try {
            // Delete all product images from storage
            foreach ($product->images as $image) {
                if (file_exists(public_path($image->image_path))) {
                    unlink(public_path($image->image_path));
                }
            }

            // Delete product (images akan auto-delete karena cascade)
            $product->delete();

            DB::commit();
            return redirect()->route('products.index')
                ->with('success', 'Product deleted successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error deleting product: ' . $e->getMessage());
        }
    }

    /**
     * Delete single product image
     */
    public function deleteImage($imageId)
    {
        $image = ProductImage::findOrFail($imageId);
        
        // Delete file
        if (file_exists(public_path($image->image_path))) {
            unlink(public_path($image->image_path));
        }
        
        // Delete from database
        $image->delete();
        
        return back()->with('success', 'Image deleted successfully!');
    }
}