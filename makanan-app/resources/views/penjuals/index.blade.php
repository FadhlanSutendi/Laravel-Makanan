@extends('layouts.app')

@section('content-dinamis')
    <div class="container mt-5">
        <h2>List Makanan</h2>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif

        <!-- Tombol Create New -->
        <a href="{{ route('penjual.tambah') }}" class="btn btn-primary mb-3">Create New Makanan</a>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Makanan</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjual as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>{{ $item->deskripsi }}</td> 
                    <td>{{ $item->harga }}</td>    
                    <td>
                        <a href="{{ route('penjual.ubah', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('penjual.hapus', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
