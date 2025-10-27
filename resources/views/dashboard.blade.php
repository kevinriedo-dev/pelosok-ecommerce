@extends('layouts.admin')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="row">
        <!-- Info Box 1 -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>
                        <!-- Info Box 1 - Products -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $stats['products'] }}</h3>
                                    <p>Total Products</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-box"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Info Box 2 - Categories -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $stats['categories'] }}</h3>
                                    <p>Categories</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-tags"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Info Box 3 - Regions -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $stats['regions'] }}</h3>
                                    <p>Regions</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-map-marked-alt"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Info Box 4 - Orders -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $stats['orders'] }}</h3>
                                    <p>Orders</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                    </h3>
                    <p>Total Products</p>
                </div>
                <div class="icon">
                    <i class="fas fa-box"></i>
                </div>
            </div>
        </div>

        <!-- Info Box 2 -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>0</h3>
                    <p>Categories</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tags"></i>
                </div>
            </div>
        </div>

        <!-- Info Box 3 -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>0</h3>
                    <p>Regions</p>
                </div>
                <div class="icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
            </div>
        </div>

        <!-- Info Box 4 -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>0</h3>
                    <p>Orders</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Card -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Selamat Datang di Pelosok Admin Panel! 👋</h3>
                </div>
                <div class="card-body">
                    <p>Halo, <strong>{{ Auth::user()->name }}</strong>!</p>
                    <p>Ini adalah admin panel untuk mengelola e-commerce <strong>Pelosok</strong> - platform jual beli pakaian dan aksesoris tradisional Indonesia.</p>
                    
                    <div class="alert alert-info mt-3">
                        <h5><i class="icon fas fa-info"></i> Quick Start Guide:</h5>
                        <ol class="mb-0">
                            <li>Tambahkan <strong>Regions</strong> (daerah asal produk) - Coming soon!</li>
                            <li>Tambahkan <strong>Categories</strong> (jenis produk) - Coming soon!</li>
                            <li>Tambahkan <strong>Products</strong> (produk yang dijual) - Coming soon!</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection