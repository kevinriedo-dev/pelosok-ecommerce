@extends('layouts.admin')

@section('title', 'Region Detail')

@section('page-title', 'Region Detail')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('regions.index') }}">Regions</a></li>
    <li class="breadcrumb-item active">{{ $region->name }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $region->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('regions.edit', $region) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('regions.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    @if($region->image)
                        <div class="mb-4 text-center">
                            <img src="{{ asset($region->image) }}" 
                                 alt="{{ $region->name }}" 
                                 class="img-fluid rounded"
                                 style="max-height: 400px;">
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Region Name</th>
                            <td>{{ $region->name }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td><code>{{ $region->slug }}</code></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>
                                @if($region->description)
                                    {{ $region->description }}
                                @else
                                    <em class="text-muted">No description</em>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $region->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated</th>
                            <td>{{ $region->updated_at->format('d M Y, H:i') }}</td>
                        </tr>
                    </table>
                </div>

                <div class="card-footer">
                    <form action="{{ route('regions.destroy', $region) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this region? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Delete Region
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection