@extends('layouts.app')

@section('content-dinamis')
<div class="container">
    <form action="{{ route('pesan.proses') }}" class="card p-5" method="POST">
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
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::get('failed'))
            <div class="alert alert-danger">
                {{ Session::get('failed') }}
            </div>
        @endif
        
        <div class="mb-3">
            <label for="name" class="form-label" placeholder="Input Nama...">Nama Pembeli : </label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        </div>

        <div id="wrap-makanan" class="mb-3">
            @if (isset($valueFormBefore))
                @foreach ($valueFormBefore['makanan'] as $key => $medicine)
                    <div class="d-flex align-items-center mb-2" id="makanan-{{$key}}">
                        <select name="makanan[]" class="form-select me-2">
                            <option selected hidden disabled>Pesanan {{ $key + 1 }}</option>
                            @foreach ($makanan as $item)
                                <option value="{{ $item->id }}" {{ $medicine == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach        
                        </select>
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteSelect('makanan-{{$key}}')">X</button>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="width">
            <button type="button" id="add-select" class="btn btn-secondary btn-sm mb-3">Tambah Menu</button>
        </div>
        
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>

@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
let no = {{ isset($valueFormBefore) ? count($valueFormBefore['makanan']) : 0 }};

$("#add-select").on("click", function() {
    let html = `<div id="makanan-${no}" class="d-flex align-items-center mb-2">
        <select name="makanan[]" class="form-select me-2">
            <option selected hidden disabled>Pesanan ${no + 1}</option>
            @foreach ($makanan as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
        <button type="button" class="btn btn-danger btn-sm" onclick="deleteSelect('makanan-${no}')">X</button>
    </div>`;
    $("#wrap-makanan").append(html);
    no++;
});

function deleteSelect(id) {
    $("#" + id).remove();
}
</script>
@endpush