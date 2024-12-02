@extends('layouts.app')
@section('content-dinamis')
    <div class="background">
        <h1 class="text-center">TESTING</h1>
        <h1>SELAMAT,{{Auth::user()->name}}</h1>
    </div>
    @endsection