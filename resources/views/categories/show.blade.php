@extends('layouts.admin')

@section('title', 'Category Detail')

@section('page-title', 'Category Detail')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item active">{{ $category->name }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $category->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    @if($category->image)
                        <div class="mb-4 text-center">
                            <img src="{{ asset($category->image) }}" 
                                 alt="{{ $category->name }}" 
                                 class="img-fluid rounded"
                                 style="max-height: 400px;">
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Category Name</th>
                            <td>{{ $category->name }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td><code>{{ $category->slug }}</code></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>
                                @if($category->description)
                                    {{ $category->description }}
                                @else
                                    <em class="text-muted">No description</em>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $category->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated</th>
                            <td>{{ $category->updated_at->format('d M Y, H:i') }}</td>
                        </tr>
                    </table>
                </div>

                <div class="card-footer">
                    <form action="{{ route('categories.destroy', $category) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this category? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Delete Category
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection