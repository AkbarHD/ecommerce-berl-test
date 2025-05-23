@extends('frontend.layouts.template')
@section('title', 'Detail Product')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/detail_product.css') }}">
@endsection
@section('content')
    <div class="container mt-4 mb-5">
        <!-- Back Button -->
        <div class="mb-3">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- Product Detail -->
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6">
                <div class="product-detail-image">
                    <img src="{{ asset($product->gambar) }}" alt="{{ $product->nama_product }}" class="img-fluid rounded">
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-md-6">
                <div class="product-info">
                    <span class="badge bg-primary mb-2">{{ $product->name }}</span>
                    <h1 class="product-title">{{ $product->nama_product }}</h1>

                    <div class="product-rating mb-3">
                        <div class="stars">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <span class="ms-2 text-muted">(4.8) 25 Reviews</span>
                    </div>

                    <div class="product-price mb-4">
                        <h3 class="text-danger mb-0">Rp {{ number_format($product->harga, 0, ',', '.') }}</h3>
                        <small class="text-muted"><del>Rp
                                {{ number_format($product->harga * 1.2, 0, ',', '.') }}</del></small>
                    </div>

                    <div class="product-description mb-4">
                        <h5>Deskripsi:</h5>
                        <p>{!! $product->keterangan !!}</p>
                    </div>

                    <div class="product-actions">
                        <button class="btn btn-danger btn-lg me-2 add-to-cart" data-id="{{ $product->id }}"
                            data-price="{{ $product->harga }}">
                            <i class="fas fa-shopping-cart"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script>
        $(document).ready(function() {
            // add to card
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
