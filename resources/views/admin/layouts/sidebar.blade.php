<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar custom-sidebar">
        <a class="sidebar-brand" href="{{ route('homeadmin') }}">
            <span class="align-middle">
                {{-- {{ Auth::user()->nameclub }}.com --}}
                {{ Auth::user()->name }}
            </span>
        </a>
        <ul class="sidebar-nav">
            {{-- Dashboard --}}
            <li class="sidebar-item {{ request()->routeIs('homeadmin') ? 'active' : '' }}">
                <a href="{{ route('homeadmin') }}" class="sidebar-link">
                    <i class="fa-solid fa-book-open"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>

            {{-- Kondisi berdasarkan level pengguna --}}
            @if (Auth::check() && Auth::user()->role === 1)
                {{-- Sidebar untuk Admin --}}
                <li class="sidebar-item {{ request()->routeIs('category.index') ? 'active' : '' }}">
                    <a href="{{ route('category.index') }}" class="sidebar-link">
                        <i class="fas fa-th-large"></i>
                        <span class="align-middle">Category</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('product.index') ? 'active' : '' }}">
                    <a href="{{ route('product.index') }}" class="sidebar-link">
                        <i class="fas fa-box-open"></i>
                        <span class="align-middle">Product</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('setting_harga.index') ? 'active' : '' }}">
                    <a href="{{ route('setting_harga.index') }}" class="sidebar-link">
                        <i class="fas fa-tags"></i>
                        <span class="align-middle">Setting Harga</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('transaksi.in') ? 'active' : '' }}">
                    <a href="{{ route('transaksi.in') }}" class="sidebar-link">
                        <i class="fas fa-receipt"></i>
                        <span class="align-middle">Order Masuk</span>
                    </a>
                </li>
            @elseif (Auth::check() && Auth::user()->role === 2)
            @endif
        </ul>



    </div>
</nav>
