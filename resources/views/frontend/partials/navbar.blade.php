{{-- css --}}
<link rel="stylesheet" href="{{ asset('frontend/css/navbar.css') }}">
{{-- html --}}
<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('home') }}">Fresh<span>Feast</span></a>

        <!-- Hamburger Menu for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu Items -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('product') }}">Produk</a>
                </li>
            </ul>

            <!-- Conditional Login/User Info -->
            <div class="ms-auto d-flex align-items-center">
                <!-- Cart Icon (only visible when logged in) -->

                <!-- jika belum login -->
                @guest
                    <a href="{{ route('login') }}" class="btn btn-login">Login</a>
                @endguest
                @auth
                    <!-- jika sudah login -->
                    <div class="dropdown user-dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-circle mr-2"></i>
                            <span class="user-name">{{ auth()->user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('homeadmin') }}">
                                <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </a>
                        </div>
                    </div>

                    <div class="cart-icon-wrapper">
                        <a href="#" class="cart-icon position-relative mr-3">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                            <span class="cart-badge position-absolute badge rounded-pill bg-danger">3</span>
                        </a>
                    </div>
                @endauth


            </div>
        </div>
</nav>
