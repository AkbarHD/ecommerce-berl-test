<table class="table table-bordered">
    <tr>
        <th>Invoice</th>
        <td>{{ $transaction->invoice }}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            @if ($transaction->status == 0)
                <span class="badge bg-warning">Belum Bayar</span>
            @elseif ($transaction->status == 1)
                <span class="badge bg-success">Lunas</span>
            @else
                <span class="badge bg-danger">Batal</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Nama Pembeli</th>
        <td>{{ DB::table('users')->where('id', $transaction->user_id)->value('name') }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $transaction->email }}</td>
    </tr>
    <tr>
        <th>No HP</th>
        <td>{{ $transaction->no_hp }}</td>
    </tr>
    <tr>
        <th>Alamat</th>
        <td>{{ $transaction->alamat }}</td>
    </tr>
    <tr>
        <th>Ekspedisi</th>
        <td>{{ $transaction->ekspedisi }}</td>
    </tr>
    <tr>
        <th>Tanggal</th>
        <td>{{ $transaction->created_at }}</td>
    </tr>

    @php
        $subtotal = 0;
        foreach ($details as $item) {
            $subtotal += $item->qty * $item->price;
        }
        $grandTotal = $subtotal + $transaction->ongkir;
    @endphp

    <tr>
        <th>Subtotal Barang</th>
        <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <th>Ongkir</th>
        <td>Rp {{ number_format($transaction->ongkir, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <th>Total</th>
        <td>Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
    </tr>
</table>

<h5>Detail Item:</h5>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Produk</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($details as $item)
            @php
                $productName = DB::table('products')->where('id', $item->product_id)->value('nama_product');
            @endphp
            <tr>
                <td>{{ $productName }}</td>
                <td>{{ $item->qty }}</td>
                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($item->qty * $item->price, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
