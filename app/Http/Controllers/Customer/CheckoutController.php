<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Show checkout page (require auth)
     */
    public function index()
    {
        // Check if cart is empty
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }
        
        // Calculate total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('customer.checkout.index', compact('cart', 'total'));
    }
    
    /**
     * Process checkout (placeholder)
     */
    public function process(Request $request)
    {
        // Validate shipping info
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
        ]);
        
        // TODO: Create order in database
        // TODO: Process payment
        // TODO: Send email confirmation
        
        // For now, just clear cart and show success
        session()->forget('cart');
        
        return redirect()->route('home')->with('success', 'Order placed successfully! (Demo mode - no actual payment processed)');
    }
}