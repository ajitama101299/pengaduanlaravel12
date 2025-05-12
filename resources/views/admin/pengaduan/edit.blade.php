<!-- resources/views/admin/pengaduan/edit.blade.php -->

@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Edit Pengaduan</h2>
        <form action="{{ route('admin.pengaduan.update', $aduan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="Pending" {{ $aduan->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Proses" {{ $aduan->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                    <option value="Selesai" {{ $aduan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tanggapan">Tanggapan</label>
                <textarea name="tanggapan" id="tanggapan" rows="4" class="form-control">{{ $aduan->tanggapan }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Update Pengaduan</button>
        </form>
        <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-primary mt-3">Kembali</a>
    </div>
@endsection
