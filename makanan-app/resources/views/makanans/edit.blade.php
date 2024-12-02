@extends('layouts.app')

@section('content-dinamis')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="fw-bold">Edit  Data Menu</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('data-makanan.ubah.proses', $makanan->id) }}" method="POST">
                @method('PATCH')
                @csrf

                <!-- Error Alerts -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Success Alerts -->
                @if (Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Nama Menu -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Menu</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $makanan->name }}" placeholder="Masukkan nama menu">
                </div>

                <!-- Harga -->
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="{{ $makanan->harga }}" placeholder="Masukkan harga menu">
                </div>

                <!-- Kategori -->
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <input type="text" class="form-control" id="kategori" name="kategori" value="{{ $makanan->kategori }}" placeholder="Masukkan kategori menu">
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi menu">{{ $makanan->deskripsi }}</textarea>
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg"> Konfirmasi </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
