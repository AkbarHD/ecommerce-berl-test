@extends('frontend.layouts.template')

@section('title', 'Beranda')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/beranda.css') }}">
@endsection

@section('content')
    <!-- Hero Section with Carousel -->
    <section class="hero-section">
        <div class="owl-carousel hero-carousel">
            <div class="carousel-slide"
                style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),
        url('{{ asset('assets/image/frontend/carousel-1-1.jpg') }}') center/cover no-repeat;">
                <div class="carousel-overlay"></div>
                <div class="carousel-caption">
                    <h2>Makanan Sehat & Lezat</h2>
                    <p>Nikmati berbagai pilihan makanan dan minuman berkualitas tinggi dengan bahan-bahan segar pilihan
                        untuk memenuhi kebutuhan gizi harian Anda.</p>
                    <a href="#" class="btn btn-hero">Pesan Sekarang</a>
                </div>
            </div>
            <div class="carousel-slide"
                style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),
        url('{{ asset('assets/image/frontend/carousel-1.jpg') }}') center/cover no-repeat;">
                <div class="carousel-overlay"></div>
                <div class="carousel-caption">
                    <h2>Minuman Menyegarkan</h2>
                    <p>Dari jus buah segar hingga kopi premium, semua minuman kami dibuat dengan bahan berkualitas untuk
                        menyegarkan hari Anda.</p>
                    <a href="#" class="btn btn-hero">Lihat Menu</a>
                </div>
            </div>
            <div class="carousel-slide"
                style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),
        url('{{ asset('assets/image/frontend/carousel-2.jpg') }}') center/cover no-repeat;">
                <div class="carousel-overlay"></div>
                <div class="carousel-caption">
                    <h2>Hidangan Penutup Istimewa</h2>
                    <p>Manjakan diri Anda dengan berbagai pilihan dessert lezat yang dibuat dengan cinta oleh chef
                        berpengalaman kami.</p>
                    <a href="#" class="btn btn-hero">Coba Sekarang</a>
                </div>
            </div>
        </div>
        <div class="carousel-nav-container">
            <button class="custom-prev-btn"><i class="fas fa-arrow-left"></i></button>
            <button class="custom-next-btn"><i class="fas fa-arrow-right"></i></button>
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
                <h2>Produk Kami</h2>
            </div>

            <div class="row">
                @forelse ($products as $product)
                    <!-- Sample Product Card -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
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

            <div class="d-flex justify-content-center">
                <a href="{{ route('products') }}" class="btn btn-hero">Lihat Semua Produk</a>
            </div>
        </div>
    </section>

    {{-- call to action --}}
    <section class="cta-section" style="background-image: url('{{ asset('assets/image/frontend/cta.jpg') }}')">
        <div class="cta-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="cta-content">
                        <h2>Nikmati Pengalaman Kuliner Terbaik</h2>
                        <p>Dapatkan diskon 15% untuk pemesanan pertama Anda melalui aplikasi kami. Unduh sekarang dan
                            rasakan kenikmatan hidangan berkualitas premium dengan harga terjangkau!</p>
                        <div class="cta-buttons">
                            <a href="#" class="btn btn-primary cta-btn-main">Pesan Sekarang</a>
                            <a href="#" class="btn btn-outline cta-btn-secondary">Pelajari Menu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            var heroCarousel = $(".hero-carousel");

            heroCarousel.owlCarousel({
                items: 1,
                loop: true,
                nav: false,
                dots: true,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                smartSpeed: 1000,
                animateOut: 'fadeOut'
            });

            // Custom Navigation
            $(".custom-next-btn").click(function() {
                heroCarousel.trigger('next.owl.carousel');
            });

            $(".custom-prev-btn").click(function() {
                heroCarousel.trigger('prev.owl.carousel');
            });
        });
    </script>
@endsection
