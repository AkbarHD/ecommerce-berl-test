@extends('frontend.layouts.template')

@section('title', 'Keranjang')

@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/keranjang.css') }}">
@endsection

@section('content')
    <div class="page-header">
        <div class="container">
            <h1>Keranjang Belanja</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product') }}">Produk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <section class="cart-section">
            <div class="cart-title">
                <h2>Keranjang Belanja <span>(3 item)</span></h2>
            </div>

            <div class="row">
                <!-- Cart Items -->
                <div class="col-lg-8">
                    <div class="cart-table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="10%"></th>
                                    <th scope="col" width="35%">Produk</th>
                                    <th scope="col" width="15%" class="text-center">Harga</th>
                                    <th scope="col" width="20%" class="text-center">Jumlah</th>
                                    <th scope="col" width="15%" class="text-center">Total</th>
                                    <th scope="col" width="5%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Item 1 -->
                                <tr>
                                    <td data-label="Gambar">
                                        <div class="product-image-small">
                                            <img src="{{ asset('assets/image/frontend/product-1.jpg') }}"
                                                alt="Healthy Bowl">
                                        </div>
                                    </td>
                                    <td data-label="Produk">
                                        <div class="product-name">Super Healthy Bowl</div>
                                        <div class="product-category-small">Makanan</div>
                                    </td>
                                    <td data-label="Harga" class="text-center">
                                        <span class="price-amount">Rp45.000</span>
                                    </td>
                                    <td data-label="Jumlah" class="text-center">
                                        <div class="quantity-control">
                                            <button class="quantity-decrease">-</button>
                                            <input type="text" value="1" class="quantity-input">
                                            <button class="quantity-increase">+</button>
                                        </div>
                                    </td>
                                    <td data-label="Total" class="text-center">
                                        <span class="price-amount">Rp45.000</span>
                                    </td>
                                    <td>
                                        <i class="fas fa-trash remove-item"></i>
                                    </td>
                                </tr>

                                <!-- Item 2 -->
                                <tr>
                                    <td data-label="Gambar">
                                        <div class="product-image-small">
                                            <img src="{{ asset('assets/image/frontend/product-2.jpg') }}" alt="Coffee">
                                        </div>
                                    </td>
                                    <td data-label="Produk">
                                        <div class="product-name">Premium Coffee</div>
                                        <div class="product-category-small">Minuman</div>
                                    </td>
                                    <td data-label="Harga" class="text-center">
                                        <span class="price-amount">Rp30.000</span>
                                    </td>
                                    <td data-label="Jumlah" class="text-center">
                                        <div class="quantity-control">
                                            <button class="quantity-decrease">-</button>
                                            <input type="text" value="2" class="quantity-input">
                                            <button class="quantity-increase">+</button>
                                        </div>
                                    </td>
                                    <td data-label="Total" class="text-center">
                                        <span class="price-amount">Rp60.000</span>
                                    </td>
                                    <td>
                                        <i class="fas fa-trash remove-item"></i>
                                    </td>
                                </tr>

                                <!-- Item 3 -->
                                <tr>
                                    <td data-label="Gambar">
                                        <div class="product-image-small">
                                            <img src="{{ asset('assets/image/frontend/product-3.jpg') }}" alt="Fruit Salad">
                                        </div>
                                    </td>
                                    <td data-label="Produk">
                                        <div class="product-name">Fresh Fruit Salad</div>
                                        <div class="product-category-small">Desert</div>
                                    </td>
                                    <td data-label="Harga" class="text-center">
                                        <span class="price-amount">Rp25.000</span>
                                    </td>
                                    <td data-label="Jumlah" class="text-center">
                                        <div class="quantity-control">
                                            <button class="quantity-decrease">-</button>
                                            <input type="text" value="1" class="quantity-input">
                                            <button class="quantity-increase">+</button>
                                        </div>
                                    </td>
                                    <td data-label="Total" class="text-center">
                                        <span class="price-amount">Rp25.000</span>
                                    </td>
                                    <td>
                                        <i class="fas fa-trash remove-item"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <a href="{{ route('product') }}" class="continue-shopping">
                        <i class="fas fa-arrow-left"></i> Lanjutkan Belanja
                    </a>
                </div>

                <!-- Cart Summary -->
                <div class="col-lg-4">
                    <div class="cart-summary">
                        <h3 class="summary-title">Ringkasan Belanja</h3>
                        <div class="summary-item">
                            <span class="summary-label">Subtotal</span>
                            <span class="summary-value">Rp130.000</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Pengiriman</span>
                            <span class="summary-value">Rp15.000</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Diskon</span>
                            <span class="summary-value">-Rp10.000</span>
                        </div>
                        <hr>
                        <div class="summary-item">
                            <span class="summary-label">Total</span>
                            <span class="grand-total">Rp135.000</span>
                        </div>
                        <button class="btn btn-checkout">
                            <i class="fas fa-lock me-2"></i> Checkout Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
@endsection
