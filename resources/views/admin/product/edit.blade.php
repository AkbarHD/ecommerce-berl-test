<form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="form-label">Nama Product</label>
        <input type="text" name="nama_product" class="form-control @error('nama_product') is-invalid @enderror"
            value="{{ old('nama_product', $product->nama_product) }}">
        @error('nama_product')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
            <option value="">Pilih Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Gambar (kosongkan jika tidak diubah)</label>
        <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
        @if ($product->gambar)
            <img src="{{ asset($product->gambar) }}" width="100" class="mt-2">
        @endif
        @error('gambar')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Keterangan</label>
        <textarea name="keterangan" id="edit_keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $product->keterangan) }}</textarea>
        @error('keterangan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="text-end">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
            <i class="fa-solid fa-xmark"></i>
            Cancel
        </button>
        <button type="submit" class="btn btn-success">
            <i class="fa-solid fa-floppy-disk"></i>
            Update
        </button>
    </div>
</form>

{{-- CKEditor --}}
<script>
    ClassicEditor
        .create(document.querySelector('#edit_keterangan'))
        .catch(error => console.error(error));
</script>
