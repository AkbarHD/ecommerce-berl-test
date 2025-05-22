@extends('frontend.layouts.template')

@section('title', 'Product')

@section('css')
    <style>
        .page-header {
            background-color: #f8f9fa;
            padding: 50px 0;
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-weight: 700;
            margin-bottom: 15px;
        }

        .breadcrumb-item a {
            color: #ff6b6b;
            text-decoration: none;
        }

        /* Filter & Search */
        .filter-section {
            margin-bottom: 40px;
        }

        .search-box {
            position: relative;
            margin-bottom: 20px;
        }

        .search-box input {
            padding-right: 50px;
            border-radius: 30px;
            border: 1px solid #ced4da;
            padding: 12px 20px;
        }

        .search-box button {
            position: absolute;
            right: 5px;
            top: 5px;
            background: #ff6b6b;
            border: none;
            border-radius: 50%;
            width: 42px;
            height: 42px;
            color: white;
        }

        .category-filter {
            border-radius: 10px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .category-filter h4 {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e9ecef;
        }

        .filter-group {
            margin-bottom: 15px;
        }

        .form-check {
            margin-bottom: 10px;
        }

        .form-check-label {
            font-size: 14px;
            cursor: pointer;
        }

        /* Produk */
        .product-section {
            padding: 20px 0 60px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .section-title h2 {
            font-weight: 700;
            color: #343a40;
            display: inline-block;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            width: 70px;
            height: 3px;
            background-color: #ff6b6b;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            transition: all 0.3s ease;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.1);
        }

        .product-category {
            position: absolute;
            top: 15px;
            left: 15px;
            background-color: #ff6b6b;
            color: white;
            padding: 5px 15px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .product-details {
            padding: 20px;
        }

        .product-title {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 10px;
            color: #343a40;
        }

        .product-rating {
            margin-bottom: 10px;
            color: #ffc107;
        }

        .product-price {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .current-price {
            font-weight: 700;
            font-size: 22px;
            color: #ff6b6b;
            margin-right: 12px;
        }

        .old-price {
            font-size: 16px;
            color: #adb5bd;
            text-decoration: line-through;
        }

        .product-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-detail {
            flex: 1;
            border-radius: 30px;
            padding: 8px 15px;
            font-weight: 500;
            font-size: 12px;
            border: 1px solid #ff6b6b;
            background-color: white;
            color: #ff6b6b;
            transition: all 0.3s ease;
        }

        .btn-detail:hover {
            background-color: #ff6b6b;
            color: white;
        }

        .btn-cart {
            flex: 0 0 50px;
            height: 50px;
            background-color: #ff6b6b;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-cart:hover {
            background-color: #ff5252;
            transform: scale(1.1);
        }

        /* Pagination */
        .pagination {
            justify-content: center;
            margin-top: 50px;
        }

        .page-item.active .page-link {
            background-color: #ff6b6b;
            border-color: #ff6b6b;
        }

        .page-link {
            color: #ff6b6b;
            border-radius: 5px;
            margin: 0 5px;
        }

        .page-link:hover {
            color: #ff5252;
        }
    </style>
@endsection

@section('content')
    <div class="page-header">
        <div class="container">
            <h1>Produk Kami</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Produk</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <!-- Filter Sidebar -->
            <div class="col-lg-3">
                <div class="filter-section">
                    <!-- Search Box -->
                    <form method="GET" action="{{ route('products') }}">
                        <div class="search-box">
                            <input type="text" name="search" class="form-control" placeholder="Cari produk..."
                                value="{{ request('search') }}">
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>

                        <!-- Category Filter -->
                        <div class="category-filter">
                            <h4>Kategori Produk</h4>
                            <div class="filter-group">
                                @foreach ($categories as $category)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="category[]"
                                            value="{{ $category->name }}"
                                            {{ is_array(request('category')) && in_array($category->name, request('category')) ? 'checked' : '' }}
                                            id="category-{{ $category->id }}">
                                        <label class="form-check-label" for="category-{{ $category->id }}">
                                            {{ $category->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button class="btn btn-warning mt-3" type="submit">Filter</button>
                       <a href="{{ route('products') }}" class="btn btn-danger mt-3">Refresh</a>
                    </form>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-lg-9">
                <section class="product-section">
                    <div class="row">
                        @forelse ($products as $product)
                            <!-- Sample Product Card -->
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product-card">
                                    <div class="product-image">
                                        <img src="{{ asset($product->gambar) }}" alt="Healthy Bowl">
                                        <span class="product-category">{{ $product->name }}</span>
                                    </div>
                                    <div class="product-details">
                                        <h5 class="product-title">{{ $product->nama_product }}</h5>
                                        <div class="product-rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="product-price">
                                            <span class="current-price">{{ $product->harga }}</span>
                                            <span class="old-price">Rp60.000</span>
                                        </div>
                                        <div class="product-buttons">
                                            <a href="{{ route('products.detail', $product->id) }}" class="btn btn-detail">Detail</a>
                                            <button class="btn btn-cart">
                                                <i class="fas fa-shopping-cart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>Tidak ada produk yang tersedia.</p>
                        @endforelse

                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                       {{ $products->links('pagination::bootstrap-4') }}

                    </div>

                </section>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
