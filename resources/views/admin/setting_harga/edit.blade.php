<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css">
<form action="{{ route('setting_harga.update', $setting->id) }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Product</label>
        <select name="product_id" class="form-control">
            <option value="" hidden>Pilih Product</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}" {{ $product->id == $setting->product_id ? 'selected' : '' }}>
                    {{ $product->nama_product }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Harga</label>
        <input type="number" name="harga" class="form-control" value="{{ $setting->harga }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Periode Awal</label>
        <input type="text" name="periode_awal" class="form-control datepicker"
            value="{{ \Carbon\Carbon::parse($setting->periode_awal)->format('d-m-Y') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Periode Akhir</label>
        <input type="text" name="periode_akhir" class="form-control datepicker"
            value="{{ \Carbon\Carbon::parse($setting->periode_akhir)->format('d-m-Y') }}">
    </div>

    <div class="text-end">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
            <i class="fa-solid fa-xmark"></i> Batal
        </button>
        <button type="submit" class="btn btn-success">
            <i class="fa-solid fa-floppy-disk"></i> Update
        </button>
    </div>
</form>
