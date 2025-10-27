@extends('layouts-customer.app')

@section('title', 'Pelosok - Produk Tradisional Indonesia Berkualitas')

@section('content')

<!-- Hero Section dengan Static Image nusantara.jpg -->
<section class="hero-section">
    <div class="container-fluid p-0">
        <div class="row g-0 align-items-center">
            <div class="col-lg-6 hero-content">
                <div class="hero-text">
                    <p class="hero-subtitle animate-fade-in">WARISAN BUDAYA INDONESIA ASLI</p>
                    <h1 class="hero-title animate-slide-up">
                        Temukan<br>
                        <span class="highlight">Cita Rasa</span><br>
                        Budayamu
                    </h1>
                    <p class="hero-description animate-fade-in-delay">
                        Kenakan keanggunan budaya Indonesia melalui pakaian dan aksesori tradisional 
                        yang dibuat dengan penuh perhatian. Setiap produk menceritakan sejarah.
                    </p>
                    <div class="hero-cta animate-fade-in-delay-2">
                        <a href="{{ route('shop.index') }}" class="btn-primary-elegant">
                            Jelajahi Koleksi
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 hero-image">
                {{-- STATIC IMAGE: nusantara.jpg (Candi Prambanan Sunset) --}}
                <div class="hero-img-wrapper">
                    <img src="{{ asset('images/nusantara.jpg') }}" 
                         class="img-fluid hero-main-img" 
                         alt="Keindahan Nusantara">
                    <div class="hero-overlay"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Categories - SEMUA KATEGORI YANG PUNYA PRODUK -->
<section class="categories-showcase">
    <div class="container py-5">
        <div class="section-header text-center mb-5">
            <p class="section-subtitle">JELAJAHI KOLEKSI KAMI</p>
            <h2 class="section-title">Keanggunan Tradisional</h2>
            <div class="title-underline"></div>
        </div>

        @php
            // Ambil SEMUA kategori yang punya produk
            $categoriesWithProducts = [];
            
            foreach($categories as $category) {
                // Cari produk yang:
                // 1. Punya category_id yang match
                // 2. is_active = true
                // 3. stock > 0
                // 4. Punya primary image
                $productsInCategory = \App\Models\Product::with('primaryImage')
                    ->where('category_id', $category->id)
                    ->where('is_active', true)
                    ->where('stock', '>', 0)
                    ->whereHas('primaryImage')
                    ->first();
                
                if($productsInCategory) {
                    $categoriesWithProducts[] = [
                        'category' => $category,
                        'product' => $productsInCategory
                    ];
                }
            }
            
            // Tentukan layout berdasarkan jumlah kategori
            $categoryCount = count($categoriesWithProducts);
            
            if($categoryCount == 0) {
                $colClass = '';
                $rowClass = '';
            } elseif($categoryCount == 1) {
                $colClass = 'col-lg-6 col-md-8';
                $rowClass = 'justify-content-center';
            } elseif($categoryCount == 2) {
                $colClass = 'col-lg-5 col-md-6';
                $rowClass = 'justify-content-center';
            } else {
                $colClass = 'col-lg-4 col-md-6';
                $rowClass = 'justify-content-center';
            }
        @endphp

        @if($categoryCount > 0)
            <div class="row g-4 {{ $rowClass }}">
                @foreach($categoriesWithProducts as $item)
                    <div class="{{ $colClass }}">
                        <div class="category-card">
                            <a href="{{ route('shop.index') }}?category%5B%5D={{ $item['category']->id }}" class="category-link">
                                <div class="category-image-wrapper">
                                    @if($item['product']->primaryImage)
                                        <img src="{{ asset($item['product']->primaryImage->image_path) }}" 
                                             class="category-image" 
                                             alt="{{ $item['category']->name }}">
                                    @endif
                                    <div class="category-overlay">
                                        <div class="category-info">
                                            <h3 class="category-name">{{ $item['category']->name }}</h3>
                                            <p class="category-description">
                                                {{ $item['category']->description ?? 'Jelajahi Koleksi' }}
                                            </p>
                                            <span class="category-cta">
                                                Lihat Selengkapnya <i class="fas fa-arrow-right ms-2"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-boxes fa-4x text-muted mb-3"></i>
                <h4 class="text-muted mb-3">Belum Ada Produk</h4>
                <p class="text-muted">
                    Silakan tambahkan produk di setiap kategori melalui Admin Panel.<br>
                    Pastikan produk: <strong>Active</strong>, <strong>Stock > 0</strong>, dan <strong>Punya Gambar</strong>.
                </p>
                @if(Auth::check() && Auth::user()->email === 'admin@pelosokecommerce.com')
                    <a href="{{ route('products.create') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-plus me-2"></i>Tambah Produk Sekarang
                    </a>
                @endif
            </div>
        @endif
    </div>
</section>

<!-- New Arrivals -->
<section class="new-arrivals-section">
    <div class="container py-5">
        <div class="row align-items-center mb-5">
            <div class="col-md-8">
                <p class="section-subtitle">KOLEKSI TERBARU</p>
                <h2 class="section-title mb-0">Produk Baru</h2>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('shop.index') }}" class="btn-text-elegant">
                    Lihat Semua Produk <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>

        @if($featuredProducts->count() > 0)
            <div class="row g-4">
                @foreach($featuredProducts->take(4) as $product)
                    <div class="col-lg-3 col-md-6">
                        <div class="product-card-elegant">
                            <a href="{{ route('shop.show', $product->slug) }}" class="product-link">
                                <div class="product-image-wrapper">
                                    @if($product->primaryImage)
                                        <img src="{{ asset($product->primaryImage->image_path) }}" 
                                             class="product-image" 
                                             alt="{{ $product->name }}">
                                    @else
                                        <div class="product-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                    
                                    @if($product->stock <= 5 && $product->stock > 0)
                                        <span class="product-badge limited">Stok Terbatas</span>
                                    @endif
                                </div>
                                <div class="product-info">
                                    <p class="product-region">{{ $product->region->name }}</p>
                                    <h4 class="product-name">{{ $product->name }}</h4>
                                    <p class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
                <p class="text-muted">Belum ada produk. Silakan tambahkan di Admin Panel.</p>
            </div>
        @endif
    </div>
</section>

<!-- About Section -->
<section class="about-section">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="about-image-grid">
                    @foreach($featuredProducts->take(4) as $index => $product)
                        @if($product->primaryImage)
                            <div class="about-img-item about-img-{{ $index + 1 }}">
                                <img src="{{ asset($product->primaryImage->image_path) }}" 
                                     alt="{{ $product->name }}">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-content">
                    <p class="section-subtitle">TENTANG KAMI</p>
                    <h2 class="section-title mb-4">Melestarikan Warisan,<br>Menciptakan Keunggulan</h2>
                    <p class="about-text">
                        Pelosok berdedikasi untuk merayakan kekayaan budaya Indonesia melalui 
                        produk tradisional yang autentik. Setiap produk dalam koleksi kami dipilih 
                        dan dibuat dengan cermat oleh pengrajin terampil, memastikan kualitas dan keaslian budaya.
                    </p>
                    <p class="about-text">
                        Kami percaya pada fashion berkelanjutan yang menghormati warisan budaya sambil 
                        mendukung komunitas lokal. Ketika Anda memilih Pelosok, Anda tidak hanya membeli 
                        produk—Anda melestarikan warisan.
                    </p>
                    <a href="{{ route('shop.index') }}" class="btn-secondary-elegant mt-4">
                        Jelajahi Cerita Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Banner -->
<section class="cta-banner">
    <div class="container">
        <div class="cta-content text-center">
            <h2 class="cta-title">Temukan Identitas Budaya Anda</h2>
            <p class="cta-text">
                Ekspresikan diri Anda melalui pakaian tradisional Indonesia yang autentik
            </p>
            <a href="{{ route('shop.index') }}" class="btn-white-elegant">
                Mulai Belanja <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.hero-section {
    min-height: 100vh;
    position: relative;
    overflow: hidden;
}

.hero-content {
    padding: 4rem 6%;
    display: flex;
    align-items: center;
    min-height: 100vh;
}

.hero-text {
    max-width: 600px;
}

.hero-subtitle {
    font-size: 0.85rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--secondary-color);
    font-weight: 600;
    margin-bottom: 1.5rem;
}

.hero-title {
    font-size: 4.5rem;
    font-weight: 700;
    line-height: 1.1;
    color: var(--text-dark);
    margin-bottom: 2rem;
}

.hero-title .highlight {
    color: var(--secondary-color);
}

.hero-description {
    font-size: 1.1rem;
    line-height: 1.8;
    color: var(--text-muted);
    margin-bottom: 3rem;
}

.hero-image {
    height: 100vh;
}

.hero-img-wrapper {
    height: 100%;
    position: relative;
    overflow: hidden;
}

.hero-main-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to right, rgba(0,0,0,0.3), transparent);
}

.btn-primary-elegant {
    display: inline-block;
    padding: 1rem 3rem;
    background-color: var(--secondary-color);
    color: white;
    font-weight: 600;
    text-decoration: none;
    border-radius: 50px;
    transition: all 0.4s ease;
    box-shadow: 0 4px 15px rgba(139, 115, 85, 0.2);
}

.btn-primary-elegant:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 25px rgba(139, 115, 85, 0.3);
    color: white;
}

.categories-showcase {
    background-color: #fafafa;
}

.section-header {
    margin-bottom: 4rem;
}

.section-subtitle {
    font-size: 0.8rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--secondary-color);
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text-dark);
}

.title-underline {
    width: 60px;
    height: 3px;
    background-color: var(--secondary-color);
    margin: 0 auto;
}

.category-card {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: all 0.4s ease;
}

.category-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.15);
}

.category-link {
    display: block;
    text-decoration: none;
    color: inherit;
}

.category-image-wrapper {
    position: relative;
    padding-bottom: 120%;
    overflow: hidden;
}

.category-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.category-card:hover .category-image {
    transform: scale(1.1);
}

.category-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.85));
    display: flex;
    align-items: flex-end;
    padding: 2rem;
    transition: all 0.4s ease;
}

.category-card:hover .category-overlay {
    background: linear-gradient(to bottom, transparent 20%, rgba(0,0,0,0.9));
}

.category-info {
    color: white;
}

.category-name {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.category-description {
    font-size: 0.95rem;
    margin-bottom: 1rem;
    opacity: 0.9;
}

.category-cta {
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.4s ease;
}

.category-card:hover .category-cta {
    opacity: 1;
    transform: translateY(0);
}

.new-arrivals-section {
    padding: 5rem 0;
}

.btn-text-elegant {
    color: var(--text-dark);
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-text-elegant:hover {
    color: var(--secondary-color);
}

.product-card-elegant {
    transition: all 0.3s ease;
    background: white;
    border-radius: 8px;
    overflow: hidden;
}

.product-card-elegant:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

.product-link {
    display: block;
    text-decoration: none;
    color: inherit;
}

.product-image-wrapper {
    position: relative;
    padding-bottom: 125%;
    overflow: hidden;
    background: #f8f8f8;
}

.product-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.product-card-elegant:hover .product-image {
    transform: scale(1.05);
}

.product-placeholder {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ccc;
    font-size: 3rem;
}

.product-badge.limited {
    position: absolute;
    top: 1rem;
    right: 1rem;
    padding: 0.4rem 1rem;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    background-color: #ff6b6b;
    color: white;
    border-radius: 20px;
}

.product-info {
    padding: 1.5rem;
}

.product-region {
    font-size: 0.85rem;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 0.5rem;
}

.product-name {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.75rem;
}

.product-price {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--secondary-color);
    margin: 0;
}

.about-section {
    background: white;
    padding: 5rem 0;
}

.about-image-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(2, 250px);
    gap: 1rem;
}

.about-img-item {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.about-img-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.about-img-item:hover img {
    transform: scale(1.1);
}

.about-img-1 {
    grid-row: 1 / 3;
}

.about-content {
    padding-left: 3rem;
}

.about-text {
    font-size: 1.05rem;
    line-height: 1.8;
    color: var(--text-muted);
    margin-bottom: 1.5rem;
}

.btn-secondary-elegant {
    display: inline-block;
    padding: 1rem 2.5rem;
    background-color: transparent;
    border: 2px solid var(--secondary-color);
    color: var(--secondary-color);
    font-weight: 600;
    text-decoration: none;
    border-radius: 50px;
    transition: all 0.3s ease;
}

.btn-secondary-elegant:hover {
    background-color: var(--secondary-color);
    color: white;
}

.cta-banner {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    padding: 5rem 0;
    margin: 0;
}

.cta-content {
    color: white;
}

.cta-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.cta-text {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    opacity: 0.95;
}

.btn-white-elegant {
    display: inline-block;
    padding: 1rem 3rem;
    background-color: white;
    color: var(--secondary-color);
    font-weight: 600;
    text-decoration: none;
    border-radius: 50px;
    transition: all 0.3s ease;
}

.btn-white-elegant:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 25px rgba(0,0,0,0.2);
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fadeIn 0.8s ease forwards;
}

.animate-fade-in-delay {
    animation: fadeIn 0.8s ease 0.2s forwards;
    opacity: 0;
}

.animate-fade-in-delay-2 {
    animation: fadeIn 0.8s ease 0.4s forwards;
    opacity: 0;
}

.animate-slide-up {
    animation: fadeIn 1s ease 0.1s forwards;
    opacity: 0;
}

@media (max-width: 992px) {
    .hero-title {
        font-size: 3rem;
    }
    
    .hero-content {
        padding: 3rem 5%;
        min-height: auto;
    }
    
    .hero-image {
        height: 500px;
    }
    
    .about-content {
        padding-left: 0;
        margin-top: 2rem;
    }
    
    .cta-title {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .category-name {
        font-size: 1.4rem;
    }
}
</style>
@endpush