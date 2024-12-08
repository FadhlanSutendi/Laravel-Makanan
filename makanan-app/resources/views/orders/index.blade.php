@extends('layouts.app')

@section('content-dinamis')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-3 rounded-top">
                    <h2 class="mb-0">MENU</h2>
                </div>
                <div class="card-body p-4">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Sukses!</strong> {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div id="checkoutContainer" class="text-center mb-5">
                        <h3 class="mb-3 text-secondary">Rekap Data Menu</h3>
                        <a href="{{ route('pesan.data.order') }}" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-sm">
                            <i class="fas fa-shopping-cart me-2"></i> Pilih Menu
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
