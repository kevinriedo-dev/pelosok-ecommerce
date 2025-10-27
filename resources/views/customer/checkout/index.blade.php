@extends('layouts-customer.app')

@section('title', 'Checkout - Pelosok')

@section('content')

<div class="container py-5">
    <h3 class="fw-bold mb-4">Checkout</h3>
    
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        
        <div class="row">
            <!-- Shipping Information Column -->
            <div class="col-lg-7">
                <div class="card shadow-sm mb-4">
                    <div class="card-header" style="background-color: var(--primary-color);">
                        <h5 class="mb-0 fw-bold">Shipping Information</h5>
                    </div>
                    <div class="card-body">
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', auth()->user()->name) }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input type="tel" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone') }}" 
                                   placeholder="08123456789"
                                   required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Address -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" 
                                      name="address" 
                                      rows="3" 
                                      placeholder="Street address, apartment, suite, etc."
                                      required>{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row">
                            <!-- City -->
                            <div class="col-md-4 mb-3">
                                <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('city') is-invalid @enderror" 
                                       id="city" 
                                       name="city" 
                                       value="{{ old('city') }}" 
                                       required>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Province -->
                            <div class="col-md-4 mb-3">
                                <label for="province" class="form-label">Province <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('province') is-invalid @enderror" 
                                       id="province" 
                                       name="province" 
                                       value="{{ old('province') }}" 
                                       required>
                                @error('province')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Postal Code -->
                            <div class="col-md-4 mb-3">
                                <label for="postal_code" class="form-label">Postal Code <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('postal_code') is-invalid @enderror" 
                                       id="postal_code" 
                                       name="postal_code" 
                                       value="{{ old('postal_code') }}" 
                                       placeholder="12345"
                                       required>
                                @error('postal_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Payment Method (Placeholder) -->
                <div class="card shadow-sm">
                    <div class="card-header" style="background-color: var(--primary-color);">
                        <h5 class="mb-0 fw-bold">Payment Method</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            Payment integration coming soon. This is demo mode.
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Order Summary Column -->
            <div class="col-lg-5">
                <div class="card shadow-sm" style="background-color: var(--primary-color);">
                    <div class="card-header" style="background-color: var(--secondary-color); color: white;">
                        <h5 class="mb-0 fw-bold">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <!-- Cart Items -->
                        <div class="mb-3" style="max-height: 300px; overflow-y: auto;">
                            @foreach($cart as $item)
                                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                    <div>
                                        <h6 class="mb-0 small">{{ $item['name'] }}</h6>
                                        <small class="text-muted">Qty: {{ $item['quantity'] }}</small>
                                    </div>
                                    <span class="fw-bold">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>
                        
                        <hr>
                        
                        <!-- Subtotal -->
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal ({{ count($cart) }} items)</span>
                            <span class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        
                        <!-- Shipping -->
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span class="text-muted">Free</span>
                        </div>
                        
                        <hr>
                        
                        <!-- Total -->
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold fs-5">Total</span>
                            <span class="fw-bold fs-5" style="color: var(--secondary-color);">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>
                        
                        <!-- Place Order Button -->
                        <button type="submit" class="btn btn-primary-custom w-100 btn-lg mb-2">
                            <i class="fas fa-check-circle me-2"></i>Place Order
                        </button>
                        
                        <p class="text-center text-muted small mb-0">
                            <i class="fas fa-lock me-1"></i>Secure checkout
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection