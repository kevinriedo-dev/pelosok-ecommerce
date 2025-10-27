@extends('layouts.admin')

@section('title', 'Edit Product')

@section('page-title', 'Edit Product')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Product Information</h3>
                    </div>
                    <div class="card-body">
                        <!-- Name -->
                        <div class="form-group">
                            <label for="name">Product Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $product->name) }}"
                                   required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="5"
                                      required>{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Material -->
                        <div class="form-group">
                            <label for="material">Material/Bahan</label>
                            <input type="text" 
                                   class="form-control @error('material') is-invalid @enderror" 
                                   id="material" 
                                   name="material" 
                                   value="{{ old('material', $product->material) }}">
                            @error('material')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Size Info -->
                        <div class="form-group">
                            <label for="size_info">Size Information</label>
                            <textarea class="form-control @error('size_info') is-invalid @enderror" 
                                      id="size_info" 
                                      name="size_info" 
                                      rows="2">{{ old('size_info', $product->size_info) }}</textarea>
                            @error('size_info')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Care Instructions -->
                        <div class="form-group">
                            <label for="care_instructions">Care Instructions</label>
                            <textarea class="form-control @error('care_instructions') is-invalid @enderror" 
                                      id="care_instructions" 
                                      name="care_instructions" 
                                      rows="3">{{ old('care_instructions', $product->care_instructions) }}</textarea>
                            @error('care_instructions')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Existing Images -->
                @if($product->images->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Current Images</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($product->images as $image)
                                <div class="col-md-3 mb-3">
                                    <div class="position-relative">
                                        <img src="{{ asset($image->image_path) }}" 
                                             class="img-thumbnail" 
                                             style="width: 100%; height: 150px; object-fit: cover;">
                                        @if($image->is_primary)
                                            <span class="badge badge-primary position-absolute" style="top: 5px; left: 5px;">Primary</span>
                                        @endif
                                        <form action="{{ route('products.images.delete', $image->id) }}" 
                                              method="POST" 
                                              class="mt-2"
                                              onsubmit="return confirm('Delete this image?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm btn-block">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Add New Images -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add New Images</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="images">Upload Images (Multiple)</label>
                            <div class="custom-file">
                                <input type="file" 
                                       class="custom-file-input @error('images.*') is-invalid @enderror" 
                                       id="images" 
                                       name="images[]"
                                       accept="image/*"
                                       multiple
                                       onchange="previewImages(event)">
                                <label class="custom-file-label" for="images">Choose files</label>
                                @error('images.*')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <small class="form-text text-muted">Max size: 2MB per image</small>
                            
                            <!-- Image Previews -->
                            <div class="row mt-3" id="imagePreviews"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-4">
                <!-- Pricing & Stock -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pricing & Stock</h3>
                    </div>
                    <div class="card-body">
                        <!-- Price -->
                        <div class="form-group">
                            <label for="price">Price (Rp) <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control @error('price') is-invalid @enderror" 
                                   id="price" 
                                   name="price" 
                                   value="{{ old('price', $product->price) }}"
                                   min="0"
                                   step="0.01"
                                   required>
                            @error('price')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Stock -->
                        <div class="form-group">
                            <label for="stock">Stock <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control @error('stock') is-invalid @enderror" 
                                   id="stock" 
                                   name="stock" 
                                   value="{{ old('stock', $product->stock) }}"
                                   min="0"
                                   required>
                            @error('stock')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Category & Region -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Classification</h3>
                    </div>
                    <div class="card-body">
                        <!-- Category -->
                        <div class="form-group">
                            <label for="category_id">Category <span class="text-danger">*</span></label>
                            <select class="form-control @error('category_id') is-invalid @enderror" 
                                    id="category_id" 
                                    name="category_id"
                                    required>
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Region -->
                        <div class="form-group">
                            <label for="region_id">Region <span class="text-danger">*</span></label>
                            <select class="form-control @error('region_id') is-invalid @enderror" 
                                    id="region_id" 
                                    name="region_id"
                                    required>
                                <option value="">-- Select Region --</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}" 
                                            {{ old('region_id', $product->region_id) == $region->id ? 'selected' : '' }}>
                                        {{ $region->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('region_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Status</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" 
                                       class="custom-control-input" 
                                       id="is_active" 
                                       name="is_active"
                                       value="1"
                                       {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">
                                    Product Active
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="card">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save"></i> Update Product
                        </button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary btn-block">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    function previewImages(event) {
        const previews = document.getElementById('imagePreviews');
        previews.innerHTML = '';
        
        const files = event.target.files;
        const label = document.querySelector('.custom-file-label');
        label.textContent = files.length + ' file(s) selected';
        
        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-md-4 mb-2';
                col.innerHTML = `
                    <div class="position-relative">
                        <img src="${e.target.result}" class="img-thumbnail" style="width: 100%; height: 150px; object-fit: cover;">
                    </div>
                `;
                previews.appendChild(col);
            };
            reader.readAsDataURL(files[i]);
        }
    }
</script>
@endpush