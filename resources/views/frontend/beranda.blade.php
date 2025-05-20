@extends('frontend.layouts.template')
@section('title', 'Beranda')
@section('content')
    <style>
        /* Hero Section Styles */
        .hero-section {
            overflow: hidden;
            position: relative;
        }

        .carousel-item {
            height: 550px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .carousel-caption {
            top: 50%;
            transform: translateY(-50%);
            bottom: auto;
            max-width: 700px;
            margin: 0 auto;
        }

        .carousel-caption h2 {
            font-size: 3rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
        }

        .carousel-caption p {
            font-size: 1.2rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
            margin-bottom: 25px;
        }

        .btn-hero {
            background-color: #ff6b6b;
            color: white;
            border-radius: 30px;
            padding: 12px 30px;
            font-weight: 500;
            text-transform: uppercase;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-hero:hover {
            background-color: #ff5252;
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
            color: white;
        }

        .carousel-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 50px;
            height: 50px;
            background-color: rgba(255, 107, 107, 0.7);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.9;
        }

        .carousel-control-prev {
            left: 20px;
        }

        .carousel-control-next {
            right: 20px;
        }

        /* Feature Boxes Styles */
        .feature-section {
            padding: 60px 0;
        }

        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            height: 100%;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: #ff6b6b;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: white;
            font-size: 30px;
            position: relative;
            z-index: 1;
        }

        .feature-card:nth-child(2) .feature-icon {
            background: #339af0;
        }

        .feature-card:nth-child(3) .feature-icon {
            background: #20c997;
        }

        .feature-card h4 {
            font-weight: 600;
            margin-bottom: 15px;
            color: #343a40;
        }

        .feature-card p {
            color: #6c757d;
            font-size: 0.95rem;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: rgba(255, 107, 107, 0.1);
            top: -50px;
            right: -50px;
            z-index: 0;
        }

        /* Product Section Styles */
        .product-section {
            padding: 60px 0;
            background-color: #f8f9fa;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
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

        .btn-cart {
            width: 100%;
            background-color: #ff6b6b;
            color: white;
            border-radius: 30px;
            padding: 10px;
            font-weight: 500;
            text-transform: uppercase;
            transition: all 0.3s ease;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-cart i {
            margin-right: 8px;
        }

        .btn-cart:hover {
            background-color: #ff5252;
            color: white;
        }

        /* Responsive Adjustments */
        @media (max-width: 991.98px) {
            .carousel-item {
                height: 400px;
            }

            .carousel-caption h2 {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 767.98px) {
            .carousel-item {
                height: 350px;
            }

            .carousel-caption h2 {
                font-size: 2rem;
            }

            .carousel-caption p {
                font-size: 1rem;
            }

            .feature-section {
                padding: 40px 0;
            }

            .product-section {
                padding: 40px 0;
            }
        }

        @media (max-width: 575.98px) {
            .carousel-item {
                height: 300px;
            }

            .carousel-caption h2 {
                font-size: 1.8rem;
            }

            .carousel-caption p {
                font-size: 0.9rem;
            }

            .btn-hero {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
        }
    </style>

    <!-- Hero Section with Carousel -->
    <section class="hero-section">
        <div id="heroCarousel" class="carousel slide" data-ride="carousel">
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
            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
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
