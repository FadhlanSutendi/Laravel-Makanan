@extends('layouts.app')


@section('content-dinamis')
{{-- <div class="container">
    <h1>Create</h1>
</div> --}}

<form action="{{ route('penjual.tambah.proses') }}" class="card p-5" method="POST">
    
    @csrf
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        
    @if (Session::get('success'))
           <div class="alert alert-success">
            {{Session::get('success')}}
           </div>
    @endif
    
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Nama Makanan: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
        </div>
    </div>
    
    <div class="mb-3 row">
        <select class="form-select" name="kategori" id="kategori">
            <option selected disabled hidden>Pilih</option>
            <option value="admin" {{old('kategori') == "admin" ? 'selected' : ''}}>Admin</option>
            <option value="kasir"{{old('kategori') == "kasir" ? 'selected' : ''}}>Kasir</option>
        </select>
    </div>
    <div class="mb-3 row">
        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{old('deskripsi')}}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Kirim</button>
</form>
@endsection
