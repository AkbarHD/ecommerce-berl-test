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
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products') }}">Produk</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('keranjang') }}">Keranjang</a></li>
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
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="nama_lengkap" class="form-label">Nama lengkap *</label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">No. HP *</label>
                                    <input type="text" class="form-control" id="phone" name="phone" required>
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
                                    <option value="">-- Pilih Provinsi --</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province }}">{{ $province }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat Lengkap *</label>
                            <textarea class="form-control" id="address" name="address" rows="3"
                                placeholder="Masukkan alamat lengkap beserta kode pos" required></textarea>
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

                        @php $grandTotal = 0; @endphp
                        @foreach ($cartItems as $item)
                            @php
                                $subTotal = $item->qty * $item->harga;
                                $grandTotal += $subTotal;
                            @endphp
                            <div class="order-item">
                                <div class="item-image">
                                    <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama_product }}">
                                </div>
                                <div class="item-details">
                                    <div class="item-name">{{ $item->nama_product }}</div>
                                    <div class="item-qty">Qty: {{ $item->qty }}</div>
                                </div>
                                <div class="item-price">Rp{{ number_format($subTotal, 0, ',', '.') }}</div>
                            </div>
                        @endforeach

                        <!-- Summary Calculation -->
                        <div class="summary-item">
                            <span class="summary-label">Subtotal</span>
                            <span class="summary-value"
                                id="subtotal">Rp{{ number_format($grandTotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Pengiriman</span>
                            <span class="summary-value" id="shippingCost">Rp0</span>
                        </div>

                        <hr>
                        <div class="summary-item">
                            <span class="summary-label">Total</span>
                            <span class="grand-total" id="grandTotal">Rp130.000</span>
                        </div>

                        <button class="btn btn-place-order" id="placeOrderBtn">
                            <i class="fas fa-credit-card me-2"></i> Buat Pesanan
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            let subtotal = {{ $grandTotal }};
            let shippingCost = 0;

            // Update grand total function
            function updateGrandTotal() {
                let total = subtotal + shippingCost;
                $('#grandTotal').text('Rp' + total.toLocaleString('id-ID'));
            }

            // Handle shipping method selection
            $('input[name="shipping"]').change(function() {
                if ($(this).is(':checked')) {
                    // Remove selected class from all shipping options
                    $('.shipping-option').removeClass('selected active');

                    // Add selected class to current option
                    $(this).closest('.shipping-option').addClass('selected active');

                    // Update shipping cost
                    let price = parseInt($(this).closest('.shipping-option').data('price'));
                    shippingCost = price;
                    $('#shippingCost').text('Rp' + price.toLocaleString('id-ID'));
                    updateGrandTotal();
                }
            });

            // Handle click on shipping option div (not just radio button)
            $('.shipping-option').click(function() {
                // Find the radio button inside this option and check it
                let radioButton = $(this).find('input[type="radio"]');
                radioButton.prop('checked', true);

                // Trigger the change event
                radioButton.trigger('change');
            });

            // Optional: Add visual feedback on hover
            $('.shipping-option').hover(
                function() {
                    if (!$(this).hasClass('selected')) {
                        $(this).addClass('hover-effect');
                    }
                },
                function() {
                    $(this).removeClass('hover-effect');
                }
            );

            $('#placeOrderBtn').click(function() {
                let formValid = true;
                let errorMessage = '';

                // Validasi input
                if (!$('#nama_lengkap').val().trim()) {
                    formValid = false;
                    errorMessage += 'Nama lengkap harus diisi<br>';
                }
                if (!$('#email').val().trim()) {
                    formValid = false;
                    errorMessage += 'Email harus diisi<br>';
                }
                if (!$('#phone').val().trim()) {
                    formValid = false;
                    errorMessage += 'Nomor HP harus diisi<br>';
                }
                if (!$('#province').val()) {
                    formValid = false;
                    errorMessage += 'Provinsi harus dipilih<br>';
                }
                if (!$('#address').val().trim()) {
                    formValid = false;
                    errorMessage += 'Alamat harus diisi<br>';
                }
                if (!$('input[name="shipping"]:checked').val()) {
                    formValid = false;
                    errorMessage += 'Metode pengiriman harus dipilih<br>';
                }

                if (!formValid) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Validasi Gagal',
                        html: errorMessage,
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                // Disable button
                $(this).prop('disabled', true).html(
                    '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...');

                // Siapkan data
                let formData = {
                    nama_lengkap: $('#nama_lengkap').val().trim(),
                    email: $('#email').val().trim(),
                    no_hp: $('#phone').val().trim(),
                    province: $('#province').val(),
                    alamat: $('#address').val().trim(),
                    ekspedisi: $('input[name="shipping"]:checked').val(),
                    ongkir: shippingCost,
                    _token: $('meta[name="csrf-token"]').attr('content')
                };

                // Kirim via AJAX
                $.ajax({
                    url: '{{ route('checkout.store') }}',
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Pesanan Berhasil Dibuat!',
                                html: 'Invoice: <strong>' + response.invoice +
                                    '</strong>',
                                confirmButtonText: 'Lihat Transaksi'
                            }).then(() => {
                                window.location.href = '{{ route('transaksi') }}';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                            $('#placeOrderBtn').prop('disabled', false).html(
                                '<i class="fas fa-credit-card me-2"></i> Buat Pesanan');
                        }
                    },
                    error: function(xhr) {
                        let errorMsg = 'Terjadi kesalahan sistem. Silakan coba lagi.';

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMsg = 'Validasi gagal:<br>';
                            const errors = xhr.responseJSON.errors;
                            for (const field in errors) {
                                errorMsg += '- ' + errors[field].join('<br>- ') + '<br>';
                            }
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Membuat Pesanan',
                            html: errorMsg
                        });
                        $('#placeOrderBtn').prop('disabled', false).html(
                            '<i class="fas fa-credit-card me-2"></i> Buat Pesanan');
                    }
                });
            });


            // Initialize grand total
            updateGrandTotal();
        });
    </script>
@endsection
