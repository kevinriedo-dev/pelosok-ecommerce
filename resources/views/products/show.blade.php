@extends('layouts.admin')

@section('title', 'Product Detail')

@section('page-title', 'Product Detail')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
    <li class="breadcrumb-item active">{{ $product->name }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $product->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Product Images -->
                    @if($product->images->count() > 0)
                        <div class="mb-4">
                            <div id="productCarousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($product->images as $index => $image)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ asset($image->image_path) }}" 
                                                 class="d-block w-100" 
                                                 alt="{{ $product->name }}"
                                                 style="height: 400px; object-fit: contain; background: #f8f9fa;">
                                        </div>
                                    @endforeach
                                </div>
                                @if($product->images->count() > 1)
                                    <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                @endif
                            </div>
                            
                            <!-- Thumbnails -->
                            @if($product->images->count() > 1)
                                <div class="row mt-3">
                                    @foreach($product->images as $image)
                                        <div class="col-2">
                                            <img src="{{ asset($image->image_path) }}" 
                                                 class="img-thumbnail" 
                                                 style="cursor: pointer; height: 60px; object-fit: cover;">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Product Info -->
                    <h4>Product Information</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Product Name</th>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td><code>{{ $product->slug }}</code></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $product->description }}</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td><strong class="text-success">Rp {{ number_format($product->price, 0, ',', '.') }}</strong></td>
                        </tr>
                        <tr>
                            <th>Stock</th>
                            <td>
                                @if($product->stock > 0)
                                    <span class="badge badge-success">{{ $product->stock }} units</span>
                                @else
                                    <span class="badge badge-danger">Out of Stock</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>
                                <span class="badge badge-info">{{ $product->category->name }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Region</th>
                            <td>
                                <span class="badge badge-warning">{{ $product->region->name }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Material</th>
                            <td>
                                @if($product->material)
                                    {{ $product->material }}
                                @else
                                    <em class="text-muted">Not specified</em>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Size Information</th>
                            <td>
                                @if($product->size_info)
                                    {{ $product->size_info }}
                                @else
                                    <em class="text-muted">Not specified</em>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Care Instructions</th>
                            <td>
                                @if($product->care_instructions)
                                    {{ $product->care_instructions }}
                                @else
                                    <em class="text-muted">Not specified</em>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($product->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-secondary">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $product->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated</th>
                            <td>{{ $product->updated_at->format('d M Y, H:i') }}</td>
                        </tr>
                    </table>
                </div>

                <div class="card-footer">
                    <form action="{{ route('products.destroy', $product) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this product? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Delete Product
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quick Stats</h3>
                </div>
                <div class="card-body">
                    <div class="info-box mb-3 bg-info">
                        <span class="info-box-icon"><i class="fas fa-images"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Images</span>
                            <span class="info-box-number">{{ $product->images->count() }}</span>
                        </div>
                    </div>

                    <div class="info-box mb-3 {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                        <span class="info-box-icon"><i class="fas fa-boxes"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Stock Status</span>
                            <span class="info-box-number">
                                {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                            </span>
                        </div>
                    </div>

                    <div class="info-box {{ $product->is_active ? 'bg-success' : 'bg-secondary' }}">
                        <span class="info-box-icon"><i class="fas fa-toggle-{{ $product->is_active ? 'on' : 'off' }}"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Product Status</span>
                            <span class="info-box-number">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection