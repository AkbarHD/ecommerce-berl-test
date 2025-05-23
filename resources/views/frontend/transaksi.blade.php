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
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('profile') }}">Akun</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <section class="transaction-section">
            <!-- Filter Section -->
            <div class="filter-section mb-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2 class="mb-0">Riwayat Pesanan Anda</h2>
                    </div>
                    <div class="col-md-6">
                        <div class="filter-controls">
                            <form method="GET" action="{{ route('transaksi') }}" id="filterForm">
                                <select class="form-select" id="statusFilter" name="status"
                                    onchange="document.getElementById('filterForm').submit();">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Lunas
                                    </option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                                        Dibatalkan</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaction List -->
            <div class="transaction-list">
                @if ($transactions->count() > 0)
                    @foreach ($transactions as $transaction)
                        <div class="transaction-card mb-4" data-status="{{ $transaction->status }}">
                            <div class="transaction-header">
                                <div class="transaction-info">
                                    <div class="transaction-id">
                                        <i class="fas fa-receipt me-2"></i>
                                        <strong>{{ $transaction->invoice }}</strong>
                                    </div>
                                    <div class="transaction-date">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ \Carbon\Carbon::parse($transaction->created_at)->locale('id')->translatedFormat('d F Y') }}
                                    </div>
                                </div>
                                <div class="transaction-status">
                                    <span
                                        class="status-badge {{ $transaction->status_class }}">{{ $transaction->status_text }}</span>
                                </div>
                            </div>

                            <div class="transaction-body">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <!-- Order Items -->
                                        <div class="order-items">
                                            @foreach ($transaction->details as $detail)
                                                <div class="order-item">
                                                    <div class="item-image">
                                                        <img src="{{ asset($detail->gambar) }}"
                                                            alt="{{ $detail->nama_product }}"
                                                            onerror="this.src='{{ asset('assets/image/no-image.png') }}'">
                                                    </div>
                                                    <div class="item-details">
                                                        <div class="item-name">{{ $detail->nama_product }}</div>
                                                        <div class="item-variant">Harga Satuan:
                                                            Rp{{ number_format($detail->price, 0, ',', '.') }}</div>
                                                        <div class="item-qty">Qty: {{ $detail->qty }}</div>
                                                    </div>
                                                    <div class="item-price">
                                                        Rp{{ number_format($detail->qty * $detail->price, 0, ',', '.') }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <!-- Order Summary -->
                                        <div class="order-summary-mini">
                                            <div class="summary-item">
                                                <span class="summary-label">Subtotal</span>
                                                <span
                                                    class="summary-value">Rp{{ number_format($transaction->subtotal, 0, ',', '.') }}</span>
                                            </div>
                                            <div class="summary-item">
                                                <span class="summary-label">Ongkir ({{ $transaction->ekspedisi }})</span>
                                                <span
                                                    class="summary-value">Rp{{ number_format($transaction->ongkir, 0, ',', '.') }}</span>
                                            </div>
                                            <hr>
                                            <div class="summary-item total">
                                                <span class="summary-label">Total</span>
                                                <span
                                                    class="grand-total">Rp{{ number_format($transaction->grand_total, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="transaction-footer">
                                <div class="shipping-info">
                                    <div class="shipping-address">
                                        @if ($transaction->status == 1)
                                            <i class="fas fa-check-circle me-1 text-success"></i>
                                            <span>Pesanan sudah dibayar - {{ $transaction->nama_lengkap }},
                                                {{ $transaction->province }}</span>
                                        @elseif($transaction->status == 2)
                                            <i class="fas fa-times-circle me-1 text-danger"></i>
                                            <span>Pesanan dibatalkan</span>
                                        @else
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            <span>Dikirim ke: {{ $transaction->nama_lengkap }},
                                                {{ $transaction->province }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="transaction-actions">
                                    <button class="btn btn-outline-secondary btn-sm"
                                        onclick="viewDetail('{{ $transaction->id }}')">
                                        <i class="fas fa-eye me-1"></i> Detail
                                    </button>

                                    @if ($transaction->status == 0)
                                        <button class="btn btn-danger btn-sm"
                                            onclick="cancelOrder('{{ $transaction->id }}')">
                                            <i class="fas fa-times me-1"></i> Batal Pesanan
                                        </button>
                                        <button class="btn btn-primary btn-sm"
                                            onclick="payNow('{{ $transaction->id }}', '{{ $transaction->invoice }}')">
                                            <i class="fas fa-credit-card me-1"></i> Bayar Sekarang
                                        </button>
                                    @elseif($transaction->status == 1)
                                        <button class="btn btn-success btn-sm" disabled>
                                            <i class="fas fa-check me-1"></i> Lunas
                                        </button>
                                    @else
                                        <button class="btn btn-secondary btn-sm" disabled>
                                            <i class="fas fa-ban me-1"></i> Dibatalkan
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="no-transactions">
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum Ada Transaksi</h4>
                            <p class="text-muted mb-4">Anda belum memiliki riwayat transaksi</p>
                            <a href="{{ route('products') }}" class="btn btn-primary">
                                <i class="fas fa-shopping-bag me-2"></i>Mulai Belanja
                            </a>
                        </div>
                    </div>
                @endif
            </div>


            <!-- Pagination -->
            <div class="mt-4 d-flex justify-content-center align-items-center">
                {{ $transactions->links('pagination::bootstrap-4') }}

            </div>

        </section>
    </div>

    <!-- Modal Detail Transaksi -->
    <div class="modal fade" id="transactionDetailModal" tabindex="-1" aria-labelledby="transactionDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transactionDetailModalLabel">Detail Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body" id="transaction-detail-body">
                    <!-- Konten detail akan dimuat di sini -->
                    <div class="text-center">
                        <i class="fas fa-spinner fa-spin fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <script>
        function payNow(id, invoice) {
            $.ajax({
                url: '/transaksi/pay/' + id,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.snap_token) {
                        window.snap.pay(response.snap_token, {
                            onSuccess: function(result) {
                                // Update status ke server
                                $.ajax({
                                    url: '/transaksi/update-status',
                                    type: 'POST',
                                    data: {
                                        _token: $('meta[name="csrf-token"]').attr(
                                            'content'),
                                        invoice: result.order_id
                                    },
                                    success: function(res) {
                                        Swal.fire('Pembayaran Berhasil',
                                                'Transaksi telah dibayar', 'success')
                                            .then(() => location.reload());
                                    },
                                    error: function() {
                                        Swal.fire('Gagal', 'Gagal update status',
                                            'error');
                                    }
                                });
                            },
                            onPending: function(result) {
                                Swal.fire('Menunggu Pembayaran', 'Selesaikan pembayaranmu', 'info');
                            },
                            onError: function(result) {
                                Swal.fire('Gagal', 'Pembayaran gagal', 'error');
                            }
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire('Gagal', xhr.responseJSON?.error || 'Terjadi kesalahan', 'error');
                }
            });
        }

        function cancelOrder(id) {
            Swal.fire({
                title: 'Batalkan Pesanan?',
                text: "Pesanan yang dibatalkan tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, batalkan!',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/transaksi/batal/' + id,
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire('Berhasil!', response.success, 'success').then(() => {
                                location.reload(); // Reload agar status terupdate
                            });
                        },
                        error: function(xhr) {
                            Swal.fire('Gagal', xhr.responseJSON?.error || 'Terjadi kesalahan.',
                                'error');
                        }
                    });
                }
            });
        }

        function formatRupiah(number) {
            return 'Rp' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function viewDetail(transactionId) {
            $('#transaction-detail-body').html(
                `<div class="text-center"><i class="fas fa-spinner fa-spin fa-2x"></i></div>`);
            $('#transactionDetailModal').modal('show');

            $.ajax({
                url: '/transaksi/detail/' + transactionId,
                method: 'GET',
                success: function(res) {
                    const tr = res.transaction;
                    let itemsHtml = '';

                    tr.details.forEach(item => {
                        itemsHtml += `
                    <div class="d-flex mb-3 border-bottom pb-2">
                        <img src="${item.gambar}" onerror="this.src='/assets/image/no-image.png'" width="60" height="60" class="me-3">
                        <div>
                            <strong>${item.nama_product}</strong><br>
                            Harga: ${formatRupiah(item.price)}<br>
                            Qty: ${item.qty}<br>
                            Total: ${formatRupiah(item.price * item.qty)}
                        </div>
                    </div>
                `;
                    });

                    const summaryHtml = `
                <div class="mb-2"><strong>Status:</strong> <span class="${tr.status_class}">${tr.status_text}</span></div>
                <div class="mb-2"><strong>Subtotal:</strong> ${formatRupiah(tr.subtotal)}</div>
                <div class="mb-2"><strong>Ongkir:</strong> ${formatRupiah(tr.ongkir)}</div>
                <div class="mb-2"><strong>Total:</strong> <span class="fw-bold">${formatRupiah(tr.grand_total)}</span></div>
                <div class="mb-2"><strong>Alamat:</strong> ${tr.nama_lengkap}, ${tr.province}</div>
            `;

                    $('#transaction-detail-body').html(itemsHtml + '<hr>' + summaryHtml);
                },
                error: function() {
                    $('#transaction-detail-body').html(
                        '<div class="alert alert-danger text-center">Gagal memuat detail transaksi.</div>');
                }
            });



        }
    </script>
@endsection
