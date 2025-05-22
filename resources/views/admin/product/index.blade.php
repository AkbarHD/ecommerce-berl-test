@extends('admin.layouts.tamplate')

@section('title', 'Product')

@section('css')
@endsection

@section('content')
    <div class="container mt-1">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h4>Product</h4>
                <a href="javascript:void(0);" class="btn btn-primary" id="btnTambahProduct"> <i class="fa-solid fa-plus"></i>
                    Tambah product</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover nowrap" id="DataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->nama_product ?? '-' }}</td>
                                    <td>{{ $product->name ?? '-' }}</td>
                                    <td>

                                        <div class="btn-group">
                                            <button class="btn p-0 px-1 dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                    <a class="dropdown-item edit" data-id="{{ $product->id }}"
                                                        href="javascript:void(0);">
                                                        <i class="mdi mdi-pencil me-2"></i>
                                                        Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('product.destroy', $product->id) }}"
                                                        method="POST" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="dropdown-item text-danger btn-delete"
                                                            data-name="{{ $product->nama_product }}">
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
    <div class="modal fade" id="createProduct" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" id="frmProduct">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Tambah Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Product</label>
                            <input type="text" name="nama_product" id="nama_product" placeholder="nama product"
                                class="form-control @error('nama_product') is-invalid @enderror"
                                value="{{ old('nama_product') }}">
                            @error('nama_product')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="" hidden>Pilih Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gambar</label>
                            <input type="file" name="gambar" id="gambar" placeholder="gambar"
                                class="form-control @error('gambar') is-invalid @enderror" value="{{ old('gambar') }}">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror"></textarea>

                            @error('keterangan')
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
    <div class="modal modal-blur fade" id="modal-editProduct" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadedEditProductForm">
                    {{-- isi form akan dimuat lewat AJAX --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let editorKeterangan; // simpan instance CKEditor

        ClassicEditor
            .create(document.querySelector('#keterangan'), {
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'link', 'bulletedList', 'numberedList', '|',
                    'blockQuote', 'insertTable', 'undo', 'redo'
                ],
            })
            .then(editor => {
                editorKeterangan = editor; // simpan ke variabel
            })
            .catch(error => {
                console.error(error);
            });

        $(document).ready(function() {

            $('#btnTambahProduct').on('click', function() {
                $('#frmProduct')[0].reset();

                // Reset konten CKEditor tanpa membuat ulang
                if (editorKeterangan) {
                    editorKeterangan.setData('');
                }

                $('#createProduct').modal('show');
            });


            $('#frmProduct').on('submit', function() {
                var nama_product = $('#nama_product').val();
                var category_id = $('#category_id').val();
                var gambar = $('#gambar').val();
                var keterangan = $('#keterangan').val();
                if (nama_product == "") {
                    $('#nama_product').focus();
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Nama Product Tidak Boleh Kosong',
                        icon: 'warning',
                    });
                    return false;
                } else if (category_id == "") {
                    $('#category_id').focus();
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Category Tidak Boleh Kosong',
                        icon: 'warning',
                    });
                    return false;
                } else if (gambar == "") {
                    $('#gambar').focus();
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Gambar Tidak Boleh Kosong',
                        icon: 'warning',
                    });
                    return false;
                } else if (keterangan == "") {
                    $('#keterangan').focus();
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Keterangan Tidak Boleh Kosong',
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
                    url: '{{ route('product.edit') }}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(response) {
                        $('#loadedEditProductForm').html(response);
                        $('#modal-editProduct').modal('show');

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
    </script>
@endsection
