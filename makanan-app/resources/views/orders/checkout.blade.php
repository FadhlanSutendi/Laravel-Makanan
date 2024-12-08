{{-- @extends('layouts.app')

@section('content-dinamis')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Daftar Menu</h2>

        <!-- Search and Add Buttons -->
        <div class="d-flex align-items-center">
            <form class="d-flex me-3" action="{{ route('data-makanan.data') }}" method="GET">
                <input type="text" name="cari" placeholder="Cari Nama Makanan..." class="form-control form-control-sm me-2">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="bi bi-search"></i> Cari
                </button>
            </form>
            <a href="{{ route('data-makanan.cetak') }}" class="btn btn-success btn-sm">
                <i class="bi bi-plus-circle"></i> Cetak PDF
            </a>

            <a href="{{ route('pesan.create') }}" class="btn btn-success btn-sm ms-3">
                <i class="bi bi-plus-circle"></i> Tambah Orderan
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Makanan Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Nama pembeli</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($makanans as $index => $makanan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $makanan->name }}</td>
                        <td>{{ ucfirst($makanan->kategori) }}</td>
                        <td>{{ $makanan->deskripsi }}</td>
                        <td>Rp {{ number_format($makanan->harga, 0, ',', '.') }}</td>
                        
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data makanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection --}}
