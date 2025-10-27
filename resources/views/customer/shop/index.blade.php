@extends('layouts-customer.app')

@section('title', 'Shop - All Products')

@section('content')

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Filter (Match mainpage.blade.php) -->
        <div class="col-md-3 col-lg-2 bg-light p-4 sidebar-filter" id="filterSidebar">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">ALL COLLECTION</h5>
                <button class="btn btn-sm btn-link d-md-none" onclick="toggleSidebar()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <!-- Category Filter -->
            <div class="mb-4">
                <h6 class="fw-bold mb-3">
                    <i class="fas fa-tags me-2"></i>Category
                </h6>
                <form method="GET" action="{{ route('shop.index') }}" id="filterForm">
                    @foreach($categories as $cat)
                        <div class="form-check mb-2">
                            <input class="form-check-input filter-checkbox" 
                                   type="checkbox" 
                                   name="category[]" 
                                   value="{{ $cat->id }}"
                                   id="cat{{ $cat->id }}"
                                   {{ in_array($cat->id, request()->get('category', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="cat{{ $cat->id }}">
                                {{ $cat->name }}
                            </label>
                        </div>
                    @endforeach
                </form>
            </div>
            
            <!-- Region Filter -->
            <div class="mb-4">
                <h6 class="fw-bold mb-3">
                    <i class="fas fa-map-marker-alt me-2"></i>Region
                </h6>
                @foreach($regions as $reg)
                    <div class="form-check mb-2">
                        <input class="form-check-input filter-checkbox" 
                               type="checkbox" 
                               name="region[]" 
                               value="{{ $reg->id }}"
                               id="reg{{ $reg->id }}"
                               {{ in_array($reg->id, request()->get('region', [])) ? 'checked' : '' }}
                               form="filterForm">
                        <label class="form-check-label" for="reg{{ $reg->id }}">
                            {{ $reg->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            
            <!-- Price Filter -->
            <div class="mb-4">
                <h6 class="fw-bold mb-3">
                    <i class="fas fa-money-bill me-2"></i>Price Range
                </h6>
                <div class="form-check mb-2">
                    <input class="form-check-input filter-checkbox" 
                           type="radio" 
                           name="price_range" 
                           value="0-1000000"
                           id="price1"
                           {{ request()->get('price_range') === '0-1000000' ? 'checked' : '' }}
                           form="filterForm">
                    <label class="form-check-label" for="price1">
                        Under Rp 1.000.000
                    </label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input filter-checkbox" 
                           type="radio" 
                           name="price_range" 
                           value="1000000-1500000"
                           id="price2"
                           {{ request()->get('price_range') === '1000000-1500000' ? 'checked' : '' }}
                           form="filterForm">
                    <label class="form-check-label" for="price2">
                        Rp 1.000.000 - Rp 1.500.000
                    </label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input filter-checkbox" 
                           type="radio" 
                           name="price_range" 
                           value="1500000-2000000"
                           id="price3"
                           {{ request()->get('price_range') === '1500000-2000000' ? 'checked' : '' }}
                           form="filterForm">
                    <label class="form-check-label" for="price3">
                        Rp 1.500.000 - Rp 2.000.000
                    </label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input filter-checkbox" 
                           type="radio" 
                           name="price_range" 
                           value="2000000-999999999"
                           id="price4"
                           {{ request()->get('price_range') === '2000000-999999999' ? 'checked' : '' }}
                           form="filterForm">
                    <label class="form-check-label" for="price4">
                        Above Rp 2.000.000
                    </label>
                </div>
            </div>
            
            <!-- Clear Filters -->
            <a href="{{ route('shop.index') }}" class="btn btn-sm btn-outline-secondary w-100">
                Clear Filters
            </a>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4">
            <!-- Search & Sort Bar -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h3 class="fw-bold">New Arrival</h3>
                    <p class="text-muted">{{ $products->total() }} products found</p>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end gap-2">
                        <!-- Mobile Filter Toggle -->
                        <button class="btn btn-outline-secondary d-md-none" onclick="toggleSidebar()">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        
                        <!-- Search -->
                        <form method="GET" action="{{ route('shop.index') }}" class="d-flex gap-2">
                            <input type="text" 
                                   class="form-control" 
                                   name="search" 
                                   placeholder="Search products..." 
                                   value="{{ request()->get('search') }}">
                            <button type="submit" class="btn btn-outline-custom">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                        
                        <!-- Sort -->
                        <select class="form-select" style="width: 200px;" onchange="this.form.submit()" form="filterForm" name="sort">
                            <option value="latest" {{ request()->get('sort') === 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="price_asc" {{ request()->get('sort') === 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request()->get('sort') === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="name" {{ request()->get('sort') === 'name' ? 'selected' : '' }}>Name: A-Z</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Products Grid (Match card design dari mainpage.blade.php) -->
            @if($products->count() > 0)
                <div class="row g-4">
                    @foreach($products as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card product-card h-100 shadow-sm">
                                <div class="position-relative">
                                    @if($product->primaryImage)
                                        <img src="{{ asset($product->primaryImage->image_path) }}" 
                                             class="card-img-top" 
                                             alt="{{ $product->name }}">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                                            <i class="fas fa-image fa-3x text-muted"></i>
                                        </div>
                                    @endif
                                    
                                    <!-- Region Badge -->
                                    <span class="badge position-absolute top-0 start-0 m-2" 
                                          style="background-color: var(--primary-color); color: var(--text-dark);">
                                        {{ $product->region->name }}
                                    </span>
                                </div>
                                
                                <div class="card-body">
                                    <h6 class="card-title fw-bold mb-2">{{ $product->name }}</h6>
                                    <p class="card-text text-muted small">
                                        {{ Str::limit($product->description, 60) }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold" style="color: var(--secondary-color);">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </span>
                                        <a href="{{ route('shop.show', $product->slug) }}" 
                                           class="btn btn-sm btn-outline-secondary">
                                            Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-5">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
                    <h4>No products found</h4>
                    <p class="text-muted">Try adjusting your filters or search</p>
                    <a href="{{ route('shop.index') }}" class="btn btn-outline-custom">Clear Filters</a>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .sidebar-filter {
        position: sticky;
        top: 80px;
        height: calc(100vh - 100px);
        overflow-y: auto;
    }
    
    @media (max-width: 768px) {
        .sidebar-filter {
            position: fixed;
            left: -100%;
            top: 0;
            height: 100vh;
            z-index: 1050;
            transition: left 0.3s;
        }
        
        .sidebar-filter.show {
            left: 0;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Auto submit filter form when checkbox changed
    document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    });
    
    // Mobile sidebar toggle
    function toggleSidebar() {
        document.getElementById('filterSidebar').classList.toggle('show');
    }
</script>
@endpush