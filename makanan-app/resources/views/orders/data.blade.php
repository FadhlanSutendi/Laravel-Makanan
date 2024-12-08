@extends('layouts.app')

@section('content-dinamis')
<div class="container mt-4">
    <h1 class="mb-4">Daftar Pesanan</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('failed'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('failed') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="d-flex align-items-center">
        <form class="d-flex me-3" action="{{ route('pesan.data') }}" method="GET">
            <input type="text" name="" id="" placeholder="Cari Pesanan..." class="form-control form-control-sm me-2">
            <button type="submit" class="btn btn-secondary btn-sm">
                <i class="bi bi-search"></i> Cari
            </button>
        </form>

        <a href="{{ route('pesan.create') }}" class="btn btn-primary btn-sm ms-3">
            <i class="bi bi-plus-circle"></i> Tambah Orderan
        </a>
        <a href="{{ route('pesan.export') }}" class="btn btn-success btn-sm ms-3">Export Data</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pemesan</th>
                    <th>Total Harga</th>
                    <th>Detail Makanan</th>
                    <th>Waktu Pesan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $index => $order)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $order->name }}</td>
                        <td>Rp. {{ number_format($order->total_price, 2) }}</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#orderModal{{ $order->id }}">
                                Lihat Detail
                            </button>
                        </td>
                        <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                        <td>
                            <a href="{{ route('pesan.struk', $order->id) }}" class="btn btn-primary btn-sm">Lihat Struk</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @foreach($orders as $order)
        <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel{{ $order->id }}">Detail Pesanan: {{ $order->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Makanan</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $makanans = json_decode($order->makanans, true);
                                @endphp
                                @foreach($makanans as $makanan)
                                    <tr>
                                        <td>{{ $makanan['name_makanan'] }}</td>
                                        <td>{{ $makanan['qty'] }}</td>
                                        <td>Rp. {{ number_format($makanan['harga'], 2) }}</td>
                                        <td>Rp. {{ number_format($makanan['total_price'], 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-right">Total:</th>
                                    <th>Rp. {{ number_format($order->total_price, 2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTables
        $('.table').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
            }
        });

        // Initialize Tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Modal functionality
        $('.modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            // You can add additional functionality here if needed
        });
    });
</script>
@endpush

@endsection

