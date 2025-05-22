@extends('frontend.layouts.template')
@section('title', 'Detail Product')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/detail_product.css') }}">
@endsection
@section('content')
    <div class="container mt-4">
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
                        <p>{{ $product->keterangan }}</p>
                    </div>

                    <div class="product-quantity mb-4">
                        <label class="form-label">Jumlah:</label>
                        <div class="input-group" style="width: 150px;">
                            <button class="btn btn-outline-secondary" type="button" id="minus-btn">-</button>
                            <input type="number" class="form-control text-center" id="quantity" value="1"
                                min="1">
                            <button class="btn btn-outline-secondary" type="button" id="plus-btn">+</button>
                        </div>
                    </div>

                    <div class="product-actions">
                        <button class="btn btn-danger btn-lg me-2" id="add-to-cart">
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
            // Quantity controls
            $('#plus-btn').click(function() {
                var qty = parseInt($('#quantity').val());
                $('#quantity').val(qty + 1);
            });

            $('#minus-btn').click(function() {
                var qty = parseInt($('#quantity').val());
                if (qty > 1) {
                    $('#quantity').val(qty - 1);
                }
            });
        });
    </script>

@endsection
