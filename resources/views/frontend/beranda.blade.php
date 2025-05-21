@extends('frontend.layouts.template')

@section('title', 'Beranda')

@section('css')
<link rel="stylesheet" href="{{ asset('frontend/css/beranda.css') }}">
@endsection

@section('content')
    <!-- Hero Section with Carousel -->
    <section class="hero-section">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#heroCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#heroCarousel" data-slide-to="1"></li>
                <li data-target="#heroCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active"
                    style="background-image: url('{{ asset('assets/image/frontend/carousel-1-1.jpg') }}')">
                    <div class="carousel-overlay"></div>
                    <div class="carousel-caption">
                        <h2>Makanan Sehat & Lezat</h2>
                        <p>Nikmati berbagai pilihan makanan dan minuman berkualitas tinggi dengan bahan-bahan segar
                            pilihan untuk memenuhi kebutuhan gizi harian Anda.</p>
                        <a href="#" class="btn btn-hero">Pesan Sekarang</a>
                    </div>
                </div>
                <div class="carousel-item"
                    style="background-image: url('{{ asset('assets/image/frontend/carousel-1.jpg') }}')">
                    <div class="carousel-overlay"></div>
                    <div class="carousel-caption">
                        <h2>Minuman Menyegarkan</h2>
                        <p>Dari jus buah segar hingga kopi premium, semua minuman kami dibuat dengan bahan berkualitas
                            untuk menyegarkan hari Anda.</p>
                        <a href="#" class="btn btn-hero">Lihat Menu</a>
                    </div>
                </div>
                <div class="carousel-item"
                    style="background-image: url('{{ asset('assets/image/frontend/carousel-3.jpg') }}')">
                    <div class="carousel-overlay"></div>
                    <div class="carousel-caption">
                        <h2>Hidangan Penutup Istimewa</h2>
                        <p>Manjakan diri Anda dengan berbagai pilihan dessert lezat yang dibuat dengan cinta oleh chef
                            berpengalaman kami.</p>
                        <a href="#" class="btn btn-hero">Coba Sekarang</a>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </section>

    <!-- Feature Boxes Section -->
    <section class="feature-section">
        <div class="container">
            <div class="row">
                <!-- Feature 1: Free Shipping -->
                <div class="col-md-4">
                    <div class="card feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h4>Gratis Ongkir</h4>
                        <p>Nikmati gratis biaya pengiriman untuk setiap pembelian di atas Rp100.000 ke seluruh wilayah
                            Indonesia.</p>
                    </div>
                </div>

                <!-- Feature 2: Quality Guarantee -->
                <div class="col-md-4">
                    <div class="card feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-medal"></i>
                        </div>
                        <h4>Kualitas Terjamin</h4>
                        <p>Semua produk kami menggunakan bahan berkualitas tinggi dan diproses dengan standar kebersihan
                            yang ketat.</p>
                    </div>
                </div>

                <!-- Feature 3: Customer Support -->
                <div class="col-md-4">
                    <div class="card feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h4>Layanan 24/7</h4>
                        <p>Tim customer service kami siap membantu Anda 24 jam sehari, 7 hari seminggu untuk pengalaman
                            belanja terbaik.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="product-section">
        <div class="container">
            <div class="section-title">
                <h2>Produk Unggulan</h2>
            </div>

            <div class="row">
                <!-- Sample Product Card -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="https://source.unsplash.com/400x300/?healthy-food" alt="Healthy Bowl">
                            <span class="product-category">Makanan Sehat</span>
                        </div>
                        <div class="product-details">
                            <h5 class="product-title">Super Healthy Bowl</h5>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="product-price">
                                <span class="current-price">Rp45.000</span>
                                <span class="old-price">Rp60.000</span>
                            </div>
                            <button class="btn btn-cart">
                                <i class="fas fa-shopping-cart"></i> Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Duplicate product cards for display (in reality, you would loop through your products) -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="https://source.unsplash.com/400x300/?smoothie" alt="Smoothie">
                            <span class="product-category">Minuman</span>
                        </div>
                        <div class="product-details">
                            <h5 class="product-title">Berry Blast Smoothie</h5>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="product-price">
                                <span class="current-price">Rp30.000</span>
                                <span class="old-price">Rp38.000</span>
                            </div>
                            <button class="btn btn-cart">
                                <i class="fas fa-shopping-cart"></i> Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="https://source.unsplash.com/400x300/?salad" alt="Salad">
                            <span class="product-category">Makanan Sehat</span>
                        </div>
                        <div class="product-details">
                            <h5 class="product-title">Fresh Garden Salad</h5>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="product-price">
                                <span class="current-price">Rp35.000</span>
                                <span class="old-price">Rp42.000</span>
                            </div>
                            <button class="btn btn-cart">
                                <i class="fas fa-shopping-cart"></i> Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="https://source.unsplash.com/400x300/?coffee" alt="Coffee">
                            <span class="product-category">Minuman</span>
                        </div>
                        <div class="product-details">
                            <h5 class="product-title">Premium Arabica Coffee</h5>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="product-price">
                                <span class="current-price">Rp25.000</span>
                                <span class="old-price">Rp32.000</span>
                            </div>
                            <button class="btn btn-cart">
                                <i class="fas fa-shopping-cart"></i> Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
@endsection
