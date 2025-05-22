@extends('frontend.layouts.template')
@section('title', 'Transaksi')

@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/transaksi.css') }}">
@endsection

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>Daftar Transaksi</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="#">Akun</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <section class="transaction-section">
            <!-- Filter Section -->
            <div class="filter-section">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2>Riwayat Pesanan Anda</h2>
                    </div>
                    <div class="col-md-6">
                        <div class="filter-controls">
                            <select class="form-select" id="statusFilter">
                                <option value="">Semua Status</option>
                                <option value="pending">Menunggu Pembayaran</option>
                                <option value="paid">Sudah Dibayar</option>
                                <option value="processing">Diproses</option>
                                <option value="shipped">Dikirim</option>
                                <option value="delivered">Selesai</option>
                                <option value="cancelled">Dibatalkan</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaction List -->
            <div class="transaction-list">
                <!-- Transaction Item 1 -->
                <div class="transaction-card" data-status="pending">
                    <div class="transaction-header">
                        <div class="transaction-info">
                            <div class="transaction-id">
                                <i class="fas fa-receipt me-2"></i>
                                <strong>INV-2024-001</strong>
                            </div>
                            <div class="transaction-date">
                                <i class="fas fa-calendar me-1"></i>
                                22 Mei 2025
                            </div>
                        </div>
                        <div class="transaction-status">
                            <span class="status-badge status-pending">Menunggu Pembayaran</span>
                        </div>
                    </div>

                    <div class="transaction-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <!-- Order Items -->
                                <div class="order-items">
                                    <div class="order-item">
                                        <div class="item-image">
                                            <img src="{{ asset('assets/image/frontend/product-1.jpg') }}"
                                                alt="Super Healthy Bowl">
                                        </div>
                                        <div class="item-details">
                                            <div class="item-name">Super Healthy Bowl</div>
                                            <div class="item-variant">Ukuran: Medium</div>
                                            <div class="item-qty">Qty: 2</div>
                                        </div>
                                        <div class="item-price">Rp90.000</div>
                                    </div>

                                    <div class="order-item">
                                        <div class="item-image">
                                            <img src="{{ asset('assets/image/frontend/product-2.jpg') }}" alt="Green Salad">
                                        </div>
                                        <div class="item-details">
                                            <div class="item-name">Fresh Green Salad</div>
                                            <div class="item-variant">Extra Dressing</div>
                                            <div class="item-qty">Qty: 1</div>
                                        </div>
                                        <div class="item-price">Rp35.000</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <!-- Order Summary -->
                                <div class="order-summary-mini">
                                    <div class="summary-item">
                                        <span class="summary-label">Subtotal</span>
                                        <span class="summary-value">Rp125.000</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="summary-label">Ongkir (JNE)</span>
                                        <span class="summary-value">Rp15.000</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="summary-label">Diskon</span>
                                        <span class="summary-value">-Rp10.000</span>
                                    </div>
                                    <hr>
                                    <div class="summary-item total">
                                        <span class="summary-label">Total</span>
                                        <span class="grand-total">Rp130.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="transaction-footer">
                        <div class="shipping-info">
                            <div class="shipping-address">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                <span>Dikirim ke: John Doe, Jakarta Selatan</span>
                            </div>
                        </div>
                        <div class="transaction-actions">
                            <button class="btn btn-outline-secondary btn-sm" onclick="viewDetail('INV-2024-001')">
                                <i class="fas fa-eye me-1"></i> Detail
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="cancelOrder('INV-2024-001')">
                                <i class="fas fa-times me-1"></i> Batal Pesanan
                            </button>
                            <button class="btn btn-primary btn-sm" onclick="payOrder('INV-2024-001')">
                                <i class="fas fa-credit-card me-1"></i> Bayar Sekarang
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Transaction Item 2 -->
                <div class="transaction-card" data-status="shipped">
                    <div class="transaction-header">
                        <div class="transaction-info">
                            <div class="transaction-id">
                                <i class="fas fa-receipt me-2"></i>
                                <strong>INV-2024-002</strong>
                            </div>
                            <div class="transaction-date">
                                <i class="fas fa-calendar me-1"></i>
                                20 Mei 2025
                            </div>
                        </div>
                        <div class="transaction-status">
                            <span class="status-badge status-shipped">Dikirim</span>
                        </div>
                    </div>

                    <div class="transaction-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="order-items">
                                    <div class="order-item">
                                        <div class="item-image">
                                            <img src="{{ asset('assets/image/frontend/product-3.jpg') }}"
                                                alt="Protein Bowl">
                                        </div>
                                        <div class="item-details">
                                            <div class="item-name">Protein Power Bowl</div>
                                            <div class="item-variant">Extra Protein</div>
                                            <div class="item-qty">Qty: 1</div>
                                        </div>
                                        <div class="item-price">Rp55.000</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="order-summary-mini">
                                    <div class="summary-item">
                                        <span class="summary-label">Subtotal</span>
                                        <span class="summary-value">Rp55.000</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="summary-label">Ongkir (J&T)</span>
                                        <span class="summary-value">Rp12.000</span>
                                    </div>
                                    <hr>
                                    <div class="summary-item total">
                                        <span class="summary-label">Total</span>
                                        <span class="grand-total">Rp67.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="transaction-footer">
                        <div class="shipping-info">
                            <div class="shipping-address">
                                <i class="fas fa-truck me-1"></i>
                                <span>No. Resi: JP123456789 - Sedang dalam perjalanan</span>
                            </div>
                        </div>
                        <div class="transaction-actions">
                            <button class="btn btn-outline-secondary btn-sm" onclick="viewDetail('INV-2024-002')">
                                <i class="fas fa-eye me-1"></i> Detail
                            </button>
                            <button class="btn btn-success btn-sm" onclick="trackOrder('JP123456789')">
                                <i class="fas fa-map-marker-alt me-1"></i> Lacak Pesanan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Transaction Item 3 -->
                <div class="transaction-card" data-status="delivered">
                    <div class="transaction-header">
                        <div class="transaction-info">
                            <div class="transaction-id">
                                <i class="fas fa-receipt me-2"></i>
                                <strong>INV-2024-003</strong>
                            </div>
                            <div class="transaction-date">
                                <i class="fas fa-calendar me-1"></i>
                                18 Mei 2025
                            </div>
                        </div>
                        <div class="transaction-status">
                            <span class="status-badge status-delivered">Selesai</span>
                        </div>
                    </div>

                    <div class="transaction-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="order-items">
                                    <div class="order-item">
                                        <div class="item-image">
                                            <img src="{{ asset('assets/image/frontend/product-4.jpg') }}"
                                                alt="Smoothie Bowl">
                                        </div>
                                        <div class="item-details">
                                            <div class="item-name">Berry Smoothie Bowl</div>
                                            <div class="item-variant">Mixed Berry</div>
                                            <div class="item-qty">Qty: 2</div>
                                        </div>
                                        <div class="item-price">Rp80.000</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="order-summary-mini">
                                    <div class="summary-item">
                                        <span class="summary-label">Subtotal</span>
                                        <span class="summary-value">Rp80.000</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="summary-label">Ongkir (SiCepat)</span>
                                        <span class="summary-value">Rp13.000</span>
                                    </div>
                                    <hr>
                                    <div class="summary-item total">
                                        <span class="summary-label">Total</span>
                                        <span class="grand-total">Rp93.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="transaction-footer">
                        <div class="shipping-info">
                            <div class="shipping-address">
                                <i class="fas fa-check-circle me-1 text-success"></i>
                                <span>Pesanan telah diterima pada 19 Mei 2025</span>
                            </div>
                        </div>
                        <div class="transaction-actions">
                            <button class="btn btn-outline-secondary btn-sm" onclick="viewDetail('INV-2024-003')">
                                <i class="fas fa-eye me-1"></i> Detail
                            </button>
                            <button class="btn btn-warning btn-sm" onclick="reviewOrder('INV-2024-003')">
                                <i class="fas fa-star me-1"></i> Beri Ulasan
                            </button>
                            <button class="btn btn-success btn-sm" onclick="reorder('INV-2024-003')">
                                <i class="fas fa-redo me-1"></i> Pesan Lagi
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination-section">
                <nav aria-label="Transaction pagination">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </section>
    </div>

    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Detail content will be loaded here -->
                    <div id="modalContent">
                        <div class="text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
