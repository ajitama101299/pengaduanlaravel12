@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h4>Selamat datang, Admin!</h4>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">Total Pengaduan: {{ $total }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">Status Baru: {{ $baru }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">Diproses: {{ $proses }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">Selesai: {{ $selesai }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
