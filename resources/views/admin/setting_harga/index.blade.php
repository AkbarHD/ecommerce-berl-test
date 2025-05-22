@extends('admin.layouts.tamplate')

@section('title', 'Setting Harga')

@section('css')
@endsection

@section('content')
    <div class="container mt-1">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h4>Setting Harga</h4>
                <a href="javascript:void(0);" class="btn btn-primary" id="btnTambahSetting"> <i class="fa-solid fa-plus"></i>
                    Tambah Harga</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover nowrap" id="DataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Product</th>
                                <th>harga</th>
                                <th>periode awal</th>
                                <th>periode akhir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($setting_harga as $key => $harga)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $harga->nama_product ?? '-' }}</td>
                                    <td>{{ $harga->harga ?? '-' }}</td>
                                    <td>{{ $harga->periode_awal ?? '-' }}</td>
                                    <td>{{ $harga->periode_akhir ?? '-' }}</td>
                                    <td>

                                        <div class="btn-group">
                                            <button class="btn p-0 px-1 dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                    <a class="dropdown-item edit" data-id="{{ $harga->id }}"
                                                        href="javascript:void(0);">
                                                        <i class="mdi mdi-pencil me-2"></i>
                                                        Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('setting_harga.destroy', $harga->id) }}" method="POST"
                                                        class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="dropdown-item text-danger btn-delete"
                                                            data-name="{{ $harga->nama_product }}">
                                                            <i class="mdi mdi-delete me-2"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>

                                            </ul>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Create --}}
    <div class="modal fade" id="createSetting" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('setting_harga.store') }}" method="POST" id="frmSetting">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Tambah Setting Harga</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Product</label>
                            <select name="product_id" id="product_id" class="form-control">
                                <option value="" hidden>Pilih Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->nama_product }}</option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" name="harga" id="harga" placeholder="harga"
                                class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}">
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Periode awal</label>
                            <input type="text" name="periode_awal" class="form-control datepicker" id="periode_awal"
                                placeholder="dd-mm-yyyy" value="{{ old('periode_awal') }}" autocomplete="off">
                            @error('periode_awal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Periode akhir</label>
                            <input type="text" name="periode_akhir" class="form-control datepicker" id="periode_akhir"
                                placeholder="dd-mm-yyyy" value="{{ old('periode_akhir') }}" autocomplete="off">
                            @error('periode_akhir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" type="button" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark"></i>
                            Batal
                        </button>
                        <button class="btn btn-success" type="submit">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- modal edit --}}
    <div class="modal modal-blur fade" id="modal-editSetting" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadedEditSettingForm">
                    {{-- isi form akan dimuat lewat AJAX --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {

            $('.datepicker').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true,
            });

            $('#btnTambahSetting').on('click', function() {
                $('#createSetting').modal('show');
            });


            $('#frmSetting').on('submit', function() {
                var product_id = $('#product_id').val();
                var harga = $('#harga').val();
                var periode_awal = $('#periode_awal').val();
                var periode_akhir = $('#periode_akhir').val();
                if (product_id == "") {
                    $('#product_id').focus();
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Product Tidak Boleh Kosong',
                        icon: 'warning',
                    });
                    return false;
                } else if (harga == "") {
                    $('#harga').focus();
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Harga Tidak Boleh Kosong',
                        icon: 'warning',
                    });
                    return false;
                } else if (periode_awal == "") {
                    $('#periode_awal').focus();
                    Swal.fire({
                        title: 'Oops!',
                        text: 'periode awal Tidak Boleh Kosong',
                        icon: 'warning',
                    });
                    return false;
                } else if (periode_akhir == "") {
                    $('#periode_akhir').focus();
                    Swal.fire({
                        title: 'Oops!',
                        text: 'periode akhir Tidak Boleh Kosong',
                        icon: 'warning',
                    });
                    return false;
                }
            });

            $('.edit').on('click', function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                $.ajax({
                    type: 'GET',
                    url: '{{ route('setting_harga.edit') }}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(response) {
                        $('#loadedEditSettingForm').html(response);
                        $('#modal-editSetting').modal('show');

                        initDatepicker();
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseJSON.error);
                    }
                });
            });

            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                let form = $(this).closest('form');
                let name = $(this).data('name') || 'Category ini';

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: `Data ${name} akan dihapus secara permanen.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        function initDatepicker() {
            $('input[name="periode_awal"], input[name="periode_akhir"]').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true,
                orientation: "bottom auto",
                startView: 2,
                maxViewMode: 2,
                clearBtn: true
            });
        }
    </script>
@endsection
