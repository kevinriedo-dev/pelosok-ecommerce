@extends('layouts.admin')

@section('title', 'Regions')

@section('page-title', 'Regions Management')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Regions</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Regions</h3>
                    <div class="card-tools">
                        <a href="{{ route('regions.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add New Region
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    @if($regions->count() > 0)
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="10%">Image</th>
                                    <th width="25%">Name</th>
                                    <th width="40%">Description</th>
                                    <th width="20%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($regions as $index => $region)
                                    <tr>
                                        <td>{{ $regions->firstItem() + $index }}</td>
                                        <td>
                                            @if($region->image)
                                                <img src="{{ asset($region->image) }}" alt="{{ $region->name }}" 
                                                     class="img-thumbnail" style="max-width: 60px;">
                                            @else
                                                <span class="badge badge-secondary">No Image</span>
                                            @endif
                                        </td>
                                        <td>{{ $region->name }}</td>
                                        <td>{{ Str::limit($region->description, 100) }}</td>
                                        <td>
                                            <a href="{{ route('regions.show', $region) }}" 
                                               class="btn btn-info btn-sm"
                                               title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('regions.edit', $region) }}" 
                                               class="btn btn-warning btn-sm"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('regions.destroy', $region) }}" 
                                                  method="POST" 
                                                  style="display: inline-block;"
                                                  onsubmit="return confirm('Are you sure you want to delete this region?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div class="mt-3">
                            {{ $regions->links() }}
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> No regions found. 
                            <a href="{{ route('regions.create') }}">Add your first region</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection