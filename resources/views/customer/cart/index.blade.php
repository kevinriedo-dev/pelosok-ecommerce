@extends('layouts-customer.app')

@section('title', 'Shopping Cart - Pelosok')

@section('content')

<div class="container py-5">
    <div class="row mb-4">
        <div class="col">
            <h3 class="fw-bold">Shopping Cart ({{ count($cart) }} items)</h3>
        </div>
    </div>
    
    @if(empty($cart))
        <div class="row">
            <div class="col-12 text-center py-5">
                <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
                <h4>Cart is empty</h4>
                <p class="text-muted mb-4">You haven't added any items to your cart yet.</p>
                <a href="{{ route('shop.index') }}" class="btn btn-primary-custom">
                    <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                </a>
            </div>
        </div>
    @else
        <div class="row">
            <!-- Cart Items Column -->
            <div class="col-lg-8">
                @foreach($cart as $id => $item)
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <!-- Product Image -->
                                <div class="col-md-2">
                                    @if($item['image'])
                                        <img src="{{ asset($item['image']) }}" 
                                             class="img-fluid rounded" 
                                             alt="{{ $item['name'] }}">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                             style="height: 100px;">
                                            <i class="fas fa-image fa-2x text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Product Info -->
                                <div class="col-md-4">
                                    <h6 class="fw-bold mb-1">{{ $item['name'] }}</h6>
                                    <p class="text-muted mb-0 small">
                                        Price: Rp {{ number_format($item['price'], 0, ',', '.') }}
                                    </p>
                                </div>
                                
                                <!-- Quantity Update -->
                                <div class="col-md-3">
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex align-items-center">
                                        @csrf
                                        @method('PATCH')
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-secondary" 
                                                onclick="decrementQuantity({{ $id }})">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" 
                                               class="form-control form-control-sm mx-2 text-center" 
                                               name="quantity" 
                                               id="quantity-{{ $id }}"
                                               value="{{ $item['quantity'] }}" 
                                               min="1"
                                               style="width: 60px;">
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-secondary" 
                                                onclick="incrementQuantity({{ $id }})">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <button type="submit" class="btn btn-sm btn-primary ms-2">
                                            Update
                                        </button>
                                    </form>
                                </div>
                                
                                <!-- Subtotal & Remove -->
                                <div class="col-md-3 text-end">
                                    <p class="fw-bold mb-2" style="color: var(--secondary-color);">
                                        Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                    </p>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Remove this item from cart?')">
                                            <i class="fas fa-trash"></i> Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                <!-- Clear Cart Button -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                    </a>
                    <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-outline-danger"
                                onclick="return confirm('Clear all items from cart?')">
                            <i class="fas fa-trash-alt me-2"></i>Clear Cart
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Summary Column (Match cartpage.blade.php) -->
            <div class="col-lg-4">
                <div class="card shadow-sm" style="background-color: var(--primary-color);">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-4">Summary</h5>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <span>Subtotal ({{ count($cart) }} items)</span>
                            <span class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <span>Shipping</span>
                            <span class="text-muted">Calculated at checkout</span>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold fs-5">Total</span>
                            <span class="fw-bold fs-5" style="color: var(--secondary-color);">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>
                        
                        @auth
                            <a href="{{ route('checkout.index') }}" class="btn btn-primary-custom w-100 btn-lg">
                                <i class="fas fa-credit-card me-2"></i>Proceed to Checkout
                            </a>
                        @else
                            <button type="button" 
                                class="btn btn-primary-custom w-100 btn-lg"
                                onclick="showLoginAlert()">
                            <i class="fas fa-credit-card me-2"></i>Proceed to Checkout
                            </button>
                        
                            <!-- Login Alert Modal -->
                            <div class="modal fade" id="loginModal" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: var(--primary-color);">
                                            <h5 class="modal-title fw-bold">Login Required</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center py-4">
                                            <i class="fas fa-user-lock fa-4x mb-3" style="color: var(--secondary-color);"></i>
                                            <h5 class="mb-3">Please login to continue</h5>
                                            <p class="text-muted">You need to login or create an account to proceed with checkout.</p>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <a href="{{ route('login') }}" class="btn btn-primary-custom">
                                                <i class="fas fa-sign-in-alt me-2"></i>Login
                                            </a>
                                            <a href="{{ route('register') }}" class="btn btn-outline-custom">
                                                <i class="fas fa-user-plus me-2"></i>Register
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endauth
                        
                        <p class="text-center text-muted small mt-3 mb-0">
                            <i class="fas fa-lock me-1"></i>Secure payment
                        </p>
                    </div>
                </div>
                
                <!-- Promo Code (Optional) -->
                <div class="card mt-3 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Have a promo code?</h6>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter code">
                            <button class="btn btn-outline-secondary" type="button">Apply</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
    function incrementQuantity(productId) {
        const input = document.getElementById('quantity-' + productId);
        input.value = parseInt(input.value) + 1;
    }
    
    function decrementQuantity(productId) {
        const input = document.getElementById('quantity-' + productId);
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
    
    function showLoginAlert() {
        const modal = new bootstrap.Modal(document.getElementById('loginModal'));
        modal.show();
    }
</script>
@endpush