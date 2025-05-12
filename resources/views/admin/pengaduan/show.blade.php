<!-- resources/views/admin/pengaduan/show.blade.php -->

@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Detail Pengaduan</h2>
        <table class="table">
            <tr>
                <th>ID</th>
                <td>{{ $aduan->id }}</td>
            </tr>
            <tr>
                <th>Nama Pelapor</th>
                <td>{{ $aduan->nama_pelapor }}</td>
            </tr>
            <tr>
                <th>Isi Pengaduan</th>
                <td>{{ $aduan->isi_pengaduan }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $aduan->status }}</td>
            </tr>
            <tr>
                <th>Tanggapan</th>
                <td>{{ $aduan->tanggapan }}</td>
            </tr>
        </table>
        <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-primary">Kembali</a>
    </div>
@endsection
