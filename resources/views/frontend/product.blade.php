@extends('frontend.layouts.template')

@section('title', 'Product')

@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/product.css') }}">
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

                        <div class="filter-buttons ">
                            <button class="btn-filter btn-filter-primary" type="submit">
                                Filter
                            </button>
                            <a href="{{ route('products') }}" class="btn-filter btn-filter-secondary">
                                Reset
                            </a>
                        </div>
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
                                            <span
                                                class="current-price">Rp{{ number_format($product->harga, 0, ',', '.') }}</span>
                                            <span class="old-price">Rp60.000</span>
                                        </div>
                                        <div class="product-buttons">
                                            <a href="{{ route('products.detail', $product->id) }}"
                                                class="btn btn-detail">Detail</a>
                                            <button class="btn btn-cart add-to-cart" data-id="{{ $product->id }}"
                                                data-price="{{ $product->harga }}">
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
    <script>
        $(document).ready(function() {
            $('.add-to-cart').on('click', function() {
                let productId = $(this).data('id');
                let price = $(this).data('price');
                let qty = 1;

                $.ajax({
                    url: "{{ route('cart.add') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: productId,
                        price: price,
                        qty: qty
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Produk ditambahkan ke keranjang.',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        updateCartCount();
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: 'Gagal menambahkan produk. Silakan login terlebih dahulu.',
                        });
                    }
                });
            });

            function updateCartCount() {
                $.ajax({
                    url: "{{ route('cart.count') }}",
                    method: "GET",
                    success: function(response) {
                        const count = response.count;
                        let badge = $('.cart-badge');

                        if (count > 0) {
                            if (badge.length) {
                                badge.text(count);
                            } else {
                                $('.cart-icon').append(
                                    `<span class="cart-badge position-absolute badge rounded-pill bg-danger">${count}</span>`
                                );
                            }
                        } else {
                            badge.remove();
                        }
                    }
                });
            }
        });
    </script>
@endsection
