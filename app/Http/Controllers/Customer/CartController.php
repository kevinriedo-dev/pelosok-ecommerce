<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = $this->calculateTotal($cart);
        
        return view('customer.cart.index', compact('cart', 'total'));
    }
    
    public function add(Request $request, $productId)
{
    $product = Product::findOrFail($productId);
    
    $quantity = $request->get('quantity', 1);
    
    // Check stock
    if ($product->stock < $quantity) {
        return back()->with('error', 'Insufficient stock. Only ' . $product->stock . ' available.');
    }
    
    $cart = session()->get('cart', []);
    
    // If product already in cart, increment quantity
    if (isset($cart[$productId])) {
        $newQuantity = $cart[$productId]['quantity'] + $quantity;
        
        if ($newQuantity > $product->stock) {
            return back()->with('error', 'Cannot add more. Maximum stock is ' . $product->stock);
        }
        
        $cart[$productId]['quantity'] = $newQuantity;
    } else {
        // Add new product to cart
        $cart[$productId] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $quantity,
            'image' => $product->primaryImage ? $product->primaryImage->image_path : null,
            'slug' => $product->slug
        ];
    }
    
    session()->put('cart', $cart);
    
    return back()->with('success', 'Product added to cart!');
    }
    
    public function update(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            $product = Product::find($productId);
            $quantity = $request->quantity;
            
            if ($quantity > $product->stock) {
                return back()->with('error', 'Quantity exceeds available stock');
            }
            
            if ($quantity > 0) {
                $cart[$productId]['quantity'] = $quantity;
            } else {
                unset($cart[$productId]);
            }
            
            session()->put('cart', $cart);
        }
        
        return back()->with('success', 'Cart updated!');
    }
    
    public function remove($productId)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }
        
        return back()->with('success', 'Product removed from cart!');
    }
    
    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Cart cleared!');
    }
    
    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}