@extends('layouts-customer.app')

@section('title', $product->name . ' - Pelosok')

@section('content')

<div class="container-fluid py-5">
    <div class="row">
        <!-- Product Images Column -->
        <div class="col-lg-7">
            <div class="container">
                <!-- Main Image -->
                <div class="row mb-3">
                    <div class="col-12 text-center">
                        @if($product->images->count() > 0)
                            <img src="{{ asset($product->images->first()->image_path) }}" 
                                 class="img-fluid rounded shadow"
                                 id="mainImage"
                                 style="max-height: 600px; object-fit: contain;"
                                 alt="{{ $product->name }}">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                 style="height: 600px;">
                                <i class="fas fa-image fa-5x text-muted"></i>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Thumbnail Images -->
                @if($product->images->count() > 1)
                    <div class="row justify-content-center">
                        @foreach($product->images as $image)
                            <div class="col-2">
                                <img src="{{ asset($image->image_path) }}" 
                                     class="img-thumbnail thumbnail-img" 
                                     style="cursor: pointer; height: 80px; object-fit: cover;"
                                     onclick="changeMainImage('{{ asset($image->image_path) }}')"
                                     alt="{{ $product->name }}">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Product Info Column -->
        <div class="col-lg-5">
            <div class="container py-4">
                <!-- Product Name -->
                <div class="row mb-3">
                    <h1 class="fw-bold" style="color: var(--text-dark);">
                        {{ $product->name }}
                    </h1>
                </div>
                
                <!-- Category & Region Badges -->
                <div class="row mb-3">
                    <div class="col">
                        <span class="badge me-2" style="background-color: var(--primary-color); color: var(--text-dark); font-size: 0.9rem;">
                            <i class="fas fa-tag me-1"></i>{{ $product->category->name }}
                        </span>
                        <span class="badge" style="background-color: var(--secondary-color); color: white; font-size: 0.9rem;">
                            <i class="fas fa-map-marker-alt me-1"></i>{{ $product->region->name }}
                        </span>
                    </div>
                </div>
                
                <!-- Description -->
                <div class="row mb-4">
                    <p style="color: var(--text-muted); line-height: 1.8;">
                        {{ $product->description }}
                    </p>
                </div>
                
                <!-- Material (if exists) -->
                @if($product->material)
                    <div class="row mb-3">
                        <div class="col">
                            <strong>Material:</strong> {{ $product->material }}
                        </div>
                    </div>
                @endif
                
                <!-- Size Info (if exists) -->
                @if($product->size_info)
                    <div class="row mb-4">
                        <div class="col">
                            <h6 class="fw-bold mb-2">Available Sizes:</h6>
                            <p class="text-muted">{{ $product->size_info }}</p>
                        </div>
                    </div>
                @endif
                
                <!-- Care Instructions (if exists) -->
                @if($product->care_instructions)
                    <div class="row mb-4">
                        <div class="col">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Care Instructions:</strong><br>
                                {{ $product->care_instructions }}
                            </div>
                        </div>
                    </div>
                @endif
                
                <!-- Price -->
                <div class="row mb-4">
                    <div class="col">
                        <h3 class="fw-bold" style="color: var(--secondary-color);">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </h3>
                    </div>
                </div>
                
                <!-- Stock Status -->
                <div class="row mb-4">
                    <div class="col">
                        @if($product->stock > 0)
                            <span class="badge bg-success">
                                <i class="fas fa-check-circle me-1"></i>In Stock ({{ $product->stock }} available)
                            </span>
                        @else
                            <span class="badge bg-danger">
                                <i class="fas fa-times-circle me-1"></i>Out of Stock
                            </span>
                        @endif
                    </div>
                </div>
                
                <!-- Add to Cart Form -->
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Quantity:</label>
                            <input type="number" 
                                   class="form-control" 
                                   name="quantity" 
                                   value="1" 
                                   min="1" 
                                   max="{{ $product->stock }}"
                                   {{ $product->stock < 1 ? 'disabled' : '' }}>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col">
                            @if($product->stock > 0)
                                <button type="submit" class="btn btn-primary-custom btn-lg w-100 mb-2">
                                    <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                </button>
                                <a href="{{ route('cart.index') }}" class="btn btn-outline-custom btn-lg w-100">
                                    <i class="fas fa-shopping-bag me-2"></i>View Cart
                                </a>
                            @else
                                <button type="button" class="btn btn-secondary btn-lg w-100" disabled>
                                    Out of Stock
                                </button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Related Products Section (Match "You Might Also Like" dari itempage.blade.php) -->
@if($relatedProducts->count() > 0)
    <div class="container py-5">
        <div class="text-center mb-5">
            <h3 class="fw-bold">You Might Also Like</h3>
        </div>
        
        <div class="row g-4 justify-content-center">
            @foreach($relatedProducts as $related)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card product-card h-100 shadow-sm">
                        @if($related->primaryImage)
                            <img src="{{ asset($related->primaryImage->image_path) }}" 
                                 class="card-img-top" 
                                 alt="{{ $related->name }}">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                                <i class="fas fa-image fa-3x text-muted"></i>
                            </div>
                        @endif
                        
                        <div class="card-body">
                            <h6 class="card-title fw-bold mb-2">{{ $related->name }}</h6>
                            <p class="card-text text-muted small mb-2">
                                {{ $related->region->name }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold" style="color: var(--secondary-color);">
                                    Rp {{ number_format($related->price, 0, ',', '.') }}
                                </span>
                                <a href="{{ route('shop.show', $related->slug) }}" 
                                   class="btn btn-sm btn-outline-secondary">
                                    Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('shop.index') }}" class="text-decoration-none" style="color: var(--text-muted);">
                Find More... <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
@endif

@endsection

@push('scripts')
<script>
    // Change main image when clicking thumbnail
    function changeMainImage(imageSrc) {
        document.getElementById('mainImage').src = imageSrc;
        
        // Highlight active thumbnail
        document.querySelectorAll('.thumbnail-img').forEach(img => {
            img.style.border = '2px solid transparent';
        });
        event.target.style.border = '2px solid var(--secondary-color)';
    }
</script>
@endpush