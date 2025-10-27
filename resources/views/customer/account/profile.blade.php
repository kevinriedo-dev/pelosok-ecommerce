@extends('layouts-customer.app')

@section('title', 'My Profile')

@section('content')
<div class="container py-5">
    <h3 class="fw-bold mb-4">My Profile</h3>
    
    <div class="card" style="max-width: 600px;">
        <div class="card-header" style="background-color: var(--primary-color);">
            <h5 class="mb-0">Account Information</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>Name:</strong> {{ Auth::user()->name }}
            </div>
            <div class="mb-3">
                <strong>Email:</strong> {{ Auth::user()->email }}
            </div>
            <div class="mb-3">
                <strong>Member Since:</strong> {{ Auth::user()->created_at->format('d M Y') }}
            </div>
        </div>
    </div>
</div>
@endsection