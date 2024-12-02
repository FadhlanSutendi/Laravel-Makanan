@extends('layouts.app')

@section('content-dinamis')
<div class="container d-flex align-items-center justify-content-center min-vh-100" >
    <div class="card shadow-lg p-4 w-50">
        <div class=" text-center  text-dark">
            <h3>WELCOME</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('login.proses') }}" method="POST">
                @csrf
                {{-- Pesan Error atau Sukses --}}
                @if (Session::get('failed'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('failed') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (Session::get('logout'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        {{ Session::get('logout') }}
                    </div>
                @endif

                {{-- Input Email --}}
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email Anda" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Input Password --}}
                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password Anda" required>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Tombol Login --}}
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Login</button>
                </div>

                {{-- Link Lupa Password atau Registrasi --}}
                {{-- <div class="text-center mt-3">
                    <a href="#" class="text-decoration-none">Lupa Password?</a><br>
                    <small>Belum punya akun? <a href="{{ route('') }}" class="text-primary text-decoration-none">Daftar di sini</a></small>
                </div> --}}
            </form>
        </div>
    </div>
</div>
@endsection
