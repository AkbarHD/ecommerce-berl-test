@extends('admin.layouts.tamplate')

@section('title', 'Tranaksi')

@section('css')
@endsection

@section('content')
    <div class="container mt-1">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h4>Transaksi</h4>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover nowrap" id="DataTable">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->invoice }}</td>
                                    <td>{{ DB::table('users')->where('id', $transaction->user_id)->value('name') }}</td>
                                    <td>
                                        @if ($transaction->status == 0)
                                            <span class="badge bg-warning">Belum Bayar</span>
                                        @elseif ($transaction->status == 1)
                                            <span class="badge bg-success">Lunas</span>
                                        @else
                                            <span class="badge bg-danger">Batal</span>
                                        @endif
                                    </td>
                                    <td>Rp {{ number_format($transaction->total ?? 0, 0, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y H:i') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info view-detail" data-id="{{ $transaction->id }}">
                                            Detail
                                        </button>
                                        {{-- Tambah tombol aksi lain jika perlu --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalDetailContent">
                    <div class="text-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.view-detail').on('click', function() {
                var id = $(this).data('id');
                $('#modalDetailContent').html(
                    '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>'
                );
                $('#detailModal').modal('show');

                $.get('/admin/transaksi/' + id, function(data) {
                    $('#modalDetailContent').html(data);
                }).fail(function() {
                    $('#modalDetailContent').html(
                        '<div class="alert alert-danger">Gagal memuat data.</div>');
                });
            });
        });
    </script>
@endsection
