@extends('layouts.app')

@section('content-dinamis')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Daftar Menu</h2>

        <!-- Search and Add Buttons -->
        <div class="d-flex align-items-center">
            <form class="d-flex me-3" action="{{ route('data-makanan.data') }}" method="GET">
                <input type="text" name="cari" placeholder="Cari Nama Makanan..." class="form-control form-control-sm me-2">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="bi bi-search"></i> Cari</button>
            </form>
            <a href="{{ route('data-makanan.tambah') }}" class="btn btn-success btn-sm">
                <i class="bi bi-plus-circle"></i> + Tambah Menu
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

    <!-- Makanan Cards -->
    <div class="row">
        @forelse ($makanans as $makanan)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $makanan->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Kategori: {{ ucfirst($makanan->kategori) }}</h6>
                        <p class="card-text">Deskripsi: {{ $makanan->deskripsi }}</p>
                        <p class="card-text fw-bold">Harga: Rp {{ number_format($makanan->harga, 0, ',', '.') }}</p>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('data-makanan.ubah', $makanan->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('data-makanan.hapus', $makanan->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="bi bi-trash-fill"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">Tidak ada data makanan.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection