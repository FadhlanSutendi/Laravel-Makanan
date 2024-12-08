<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sutendi's Food</title>
    {{-- CDN Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- asset : memanggil file yg ada di folder public biasanya untuk css,js atau gambar/file tambahan --}}
    <link rel="icon" href="{{ asset('images/koki 2.jpg') }}">
    
    @stack('style')
</head>


<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="{{route('landingPage')}}">SUTENDI'S FOOD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    
                        <a class="nav-link " href="{{ route('landingPage')}}">Landing pages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('pesan.data')}}">Data Makanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('data-makanan.data')}}">Data Menu</a>
                    </li>
                    @if (Auth::check())
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link">Logout</a>
                    </li>
                    @endif
                    
                </ul>
            </div>
        </div>
    </nav>

    {{-- yield : mengisi bagian content dinamis/bagian yg akan berubah-ubah di tiap halamannya --}}
    @yield('content-dinamis')

    <footer></footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    {{-- stack : tidak wajib diisi oleh view yg extends nya (optional), kalau yield wajib diisi oleh view extends nya --}}
    @stack('script')
</body>

</html>
