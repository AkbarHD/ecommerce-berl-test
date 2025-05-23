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
                    <li class="breadcrumb-item"><a href="{{ route('products') }}">Produk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <section class="cart-section">
            <div class="cart-title">
                @php
                    $cartCount = isset($globalCartItems) ? $globalCartItems->count() : 0;
                @endphp
                <h2>Keranjang Belanja <span id="total-item">({{ $cartCount }} item)</span></h2>
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
                                @php $grandTotal = 0; @endphp
                                @forelse ($cartItems as $item)
                                    @php
                                        $subTotal = $item->qty * $item->harga;
                                        $grandTotal += $subTotal;
                                    @endphp
                                    <tr data-id="{{ $item->id }}">
                                        <td data-label="Gambar">
                                            <div class="product-image-small">
                                                <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama_product }}">
                                            </div>
                                        </td>
                                        <td data-label="Produk">
                                            <div class="product-name">{{ $item->nama_product }}</div>
                                            <div class="product-category-small">{{ $item->kategori ?? '' }}</div>
                                        </td>
                                        <td data-label="Harga" class="text-center">
                                            <span
                                                class="price-amount">Rp{{ number_format($item->harga, 0, ',', '.') }}</span>
                                        </td>
                                        <td data-label="Jumlah" class="text-center">
                                            <div class="quantity-control">
                                                <input type="text" value="{{ $item->qty }}" class="quantity-input"
                                                    readonly>
                                            </div>
                                        </td>
                                        <td data-label="Total" class="text-center">
                                            <span
                                                class="price-amount subtotal">Rp{{ number_format($subTotal, 0, ',', '.') }}</span>
                                        </td>
                                        <td>
                                            <i class="fas fa-trash remove-item" style="cursor:pointer;"></i>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Keranjang kosong.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('products') }}" class="continue-shopping">
                        <i class="fas fa-arrow-left"></i> Lanjutkan Belanja
                    </a>
                </div>

                <!-- Cart Summary -->
                @if ($cartItems->count() > 0)
                    <div class="col-lg-4">
                        <div class="cart-summary">
                            <h3 class="summary-title">Ringkasan Belanja</h3>
                            <div class="summary-item">
                                <span class="summary-label">Subtotal</span>
                                <span class="summary-value"
                                    id="cart-subtotal">Rp{{ number_format($grandTotal, 0, ',', '.') }}</span>
                            </div>

                            <hr>
                            <div class="summary-item">
                                <span class="summary-label">Total</span>
                                </span><span class="grand-total"
                                    id="cart-total">Rp{{ number_format($grandTotal, 0, ',', '.') }}</span>
                            </div>
                            <button class="btn btn-checkout" id="checkoutButton">
                                <i class="fas fa-lock me-2"></i> Checkout Sekarang
                            </button>

                        </div>
                    </div>
                @else
                    <div class="col-lg-4">
                        <div class="cart-summary">
                            <h3 class="summary-title">Ringkasan Belanja</h3>
                            <div class="summary-item">
                                <span class="summary-label">Subtotal</span>
                                <span class="summary-value"
                                    id="cart-subtotal">Rp{{ number_format($grandTotal, 0, ',', '.') }}</span>
                            </div>

                            <hr>
                            <div class="summary-item">
                                <span class="summary-label">Total</span>
                                </span><span class="grand-total"
                                    id="cart-total">Rp{{ number_format($grandTotal, 0, ',', '.') }}</span>
                            </div>
                            <button class="btn btn-checkout" id="checkoutButton" disabled>
                                <i class="fas fa-lock me-2"></i> Checkout Sekarang
                            </button>

                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#checkoutButton').on('click', function() {
                window.location.href = "{{ route('checkout') }}";
            });

            // Function untuk format rupiah
            function formatRupiah(number) {
                return 'Rp' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            // Function untuk update grand total
            function updateGrandTotal() {
                let grandTotal = 0;

                // Loop semua subtotal untuk menghitung grand total
                $('.subtotal').each(function() {
                    let subtotalText = $(this).text().replace(/[^\d]/g,
                        ''); // Hapus semua karakter non-digit
                    let subtotalValue = parseInt(subtotalText) || 0;
                    grandTotal += subtotalValue;
                });

                // Update tampilan grand total
                $('#cart-subtotal').text(formatRupiah(grandTotal));
                $('#cart-total').text(formatRupiah(grandTotal));
            }


            $('.remove-item').on('click', function() {
                let row = $(this).closest('tr');
                let cartId = row.data('id');
                let removeButton = $(this);

                Swal.fire({
                    title: 'Yakin hapus produk ini?',
                    text: "Item akan dihapus dari keranjang kamu.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        removeButton.prop('disabled', true);
                        removeButton.html('<i class="fas fa-spinner fa-spin"></i>');

                        $.ajax({
                            url: '{{ route('keranjang.remove') }}',
                            type: 'POST',
                            data: {
                                cart_id: cartId,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    row.fadeOut(300, function() {
                                        $(this).remove();
                                        updateGrandTotal();
                                        updateCartCount(); // ← update jumlah badge keranjang
                                        updateTotalItemCount(); // ← ini untuk judul "Keranjang Belanja (X item)"

                                        if ($('tbody tr:visible').length ===
                                            0) {
                                            $('tbody').html(
                                                '<tr><td colspan="6" class="text-center">Keranjang kosong.</td></tr>'
                                            );
                                            $('#cart-subtotal').text('Rp0');
                                            $('#cart-total').text('Rp0');
                                            $('#checkoutButton').prop(
                                                'disabled', true);
                                        }
                                    });

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Dihapus!',
                                        text: response.message ||
                                            'Item berhasil dihapus dari keranjang.',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                } else {
                                    Swal.fire('Gagal', response.message ||
                                        'Gagal menghapus item.', 'error');
                                    removeButton.prop('disabled', false);
                                    removeButton.html('<i class="fas fa-trash"></i>');
                                }
                            },
                            error: function() {
                                Swal.fire('Oops!',
                                    'Terjadi kesalahan saat menghapus item.',
                                    'error');
                                removeButton.prop('disabled', false);
                                removeButton.html('<i class="fas fa-trash"></i>');
                            }
                        });
                    }
                });
            });


            function updateCartCount() {
                $.ajax({
                    url: "{{ route('cart.count') }}",
                    method: "GET",
                    success: function(response) {
                        const count = response.count;
                        let badge = $('.cart-badge');

                        if (count > 0) {
                            if (badge.length) {
                                badge.text(count);
                            } else {
                                $('.cart-icon').append(
                                    `<span class="cart-badge position-absolute badge rounded-pill bg-danger">${count}</span>`
                                );
                            }
                        } else {
                            badge.remove();
                        }
                    }
                });
            }

            function updateTotalItemCount() {
                let itemCount = $('tbody tr:visible').length;
                $('#total-item').text(`(${itemCount} item)`);
            }


        });
    </script>


@endsection
