@extends('frontend.layouts.template')
@section('title', 'Checkout')

@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/checkout.css') }}">
@endsection

@section('content')
    <div class="page-header">
        <div class="container">
            <h1>Checkout</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="#">Produk</a></li>
                    <li class="breadcrumb-item"><a href="#">Keranjang</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <section class="checkout-section">
            <div class="checkout-title">
                <h2>Informasi Checkout</h2>
            </div>

            <div class="row">
                <!-- Checkout Form -->
                <div class="col-lg-7">
                    <!-- Customer Information -->
                    <div class="form-card">
                        <h4><i class="fas fa-user me-2"></i>Informasi Pelanggan</h4>
                        <form id="checkoutForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label">Nama Depan *</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName" class="form-label">Nama Belakang *</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">No. HP *</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Shipping Address -->
                    <div class="form-card">
                        <h4><i class="fas fa-map-marker-alt me-2"></i>Alamat Pengiriman</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="province" class="form-label">Provinsi *</label>
                                <select class="form-select" id="province" name="province" required>
                                    <option value="">Pilih Provinsi</option>
                                    <option value="jawa-barat">Jawa Barat</option>
                                    <option value="jawa-tengah">Jawa Tengah</option>
                                    <option value="jawa-timur">Jawa Timur</option>
                                    <option value="dki-jakarta">DKI Jakarta</option>
                                    <option value="banten">Banten</option>
                                    <option value="yogyakarta">Yogyakarta</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="form-label">Kota/Kabupaten *</label>
                                <select class="form-select" id="city" name="city" required>
                                    <option value="">Pilih Kota</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="district" class="form-label">Kecamatan *</label>
                                <select class="form-select" id="district" name="district" required>
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="postalCode" class="form-label">Kode Pos *</label>
                                <input type="text" class="form-control" id="postalCode" name="postalCode" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat Lengkap *</label>
                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Masukkan alamat lengkap..."
                                required></textarea>
                        </div>
                    </div>

                    <!-- Shipping Method -->
                    <div class="form-card">
                        <h4><i class="fas fa-truck me-2"></i>Metode Pengiriman</h4>
                        <div class="shipping-options">
                            <div class="shipping-option" data-courier="jne" data-price="15000">
                                <input type="radio" name="shipping" value="jne" id="jne">
                                <div class="shipping-info">
                                    <div>
                                        <div class="courier-name">JNE Regular</div>
                                        <div class="courier-desc">Estimasi 2-3 hari kerja</div>
                                    </div>
                                    <div class="shipping-price">Rp15.000</div>
                                </div>
                            </div>
                            <div class="shipping-option" data-courier="jnt" data-price="12000">
                                <input type="radio" name="shipping" value="jnt" id="jnt">
                                <div class="shipping-info">
                                    <div>
                                        <div class="courier-name">J&T Express</div>
                                        <div class="courier-desc">Estimasi 2-4 hari kerja</div>
                                    </div>
                                    <div class="shipping-price">Rp12.000</div>
                                </div>
                            </div>
                            <div class="shipping-option" data-courier="sicepat" data-price="13000">
                                <input type="radio" name="shipping" value="sicepat" id="sicepat">
                                <div class="shipping-info">
                                    <div>
                                        <div class="courier-name">SiCepat</div>
                                        <div class="courier-desc">Estimasi 1-3 hari kerja</div>
                                    </div>
                                    <div class="shipping-price">Rp13.000</div>
                                </div>
                            </div>
                            <div class="shipping-option" data-courier="pos" data-price="10000">
                                <input type="radio" name="shipping" value="pos" id="pos">
                                <div class="shipping-info">
                                    <div>
                                        <div class="courier-name">Pos Indonesia</div>
                                        <div class="courier-desc">Estimasi 3-5 hari kerja</div>
                                    </div>
                                    <div class="shipping-price">Rp10.000</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-5">
                    <div class="order-summary">
                        <h3 class="summary-title">Ringkasan Pesanan</h3>

                        <!-- Order Items -->
                        <div class="order-item">
                            <div class="item-image">
                                <img src="{{ asset('assets/image/frontend/product-1.jpg') }}" alt="Super Healthy Bowl">
                            </div>
                            <div class="item-details">
                                <div class="item-name">Super Healthy Bowl</div>
                                <div class="item-qty">Qty: 1</div>
                            </div>
                            <div class="item-price">Rp45.000</div>
                        </div>

                        <div class="order-item">
                            <div class="item-image">
                                <img src="{{ asset('assets/image/frontend/product-2.jpg') }}" alt="Fresh Salad">
                            </div>
                            <div class="item-details">
                                <div class="item-name">Fresh Garden Salad</div>
                                <div class="item-qty">Qty: 2</div>
                            </div>
                            <div class="item-price">Rp70.000</div>
                        </div>

                        <div class="order-item">
                            <div class="item-image">
                                <img src="{{ asset('assets/image/frontend/product-3.jpg') }}" alt="Smoothie">
                            </div>
                            <div class="item-details">
                                <div class="item-name">Green Smoothie</div>
                                <div class="item-qty">Qty: 1</div>
                            </div>
                            <div class="item-price">Rp25.000</div>
                        </div>

                        <!-- Summary Calculation -->
                        <div class="summary-item">
                            <span class="summary-label">Subtotal</span>
                            <span class="summary-value" id="subtotal">Rp140.000</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Pengiriman</span>
                            <span class="summary-value" id="shippingCost">Rp0</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Diskon</span>
                            <span class="summary-value">-Rp10.000</span>
                        </div>
                        <hr>
                        <div class="summary-item">
                            <span class="summary-label">Total</span>
                            <span class="grand-total" id="grandTotal">Rp130.000</span>
                        </div>

                        <button class="btn btn-place-order" id="placeOrderBtn" disabled>
                            <i class="fas fa-credit-card me-2"></i> Buat Pesanan
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
@endsection
