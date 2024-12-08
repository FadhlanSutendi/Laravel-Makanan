@extends('layouts.app')

@section('content-dinamis')
<div class="container">
    <h1>Detail Pesanan</h1>

    <h3>Nama Pemesan: {{ $order->name }}</h3>
    <h3>Total Harga: Rp. {{ number_format($order->total_price, 2, ',', '.') }}</h3>

    <h4>Detail Makanan yang Dipesan:</h4>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Makanan</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @php
                $makanans = json_decode($order->makanans, true);
            @endphp
            @foreach ($makanans as $index => $makanan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $makanan['name_makanan'] }}</td>
                    <td>Rp. {{ number_format($makanan['harga'], 2, ',', '.') }}</td>
                    <td>{{ $makanan['qty'] }}</td>
                    <td>Rp. {{ number_format($makanan['total_price'], 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('pesan.data', $order->id) }}" class="btn btn-primary">Kembali</a>
    <a href="{{ route('pesan.cetak', $order->id) }}" class="btn btn-danger">
        <i class="bi bi-plus-circle"></i> Cetak PDF
    </a>
</div>
@endsection
