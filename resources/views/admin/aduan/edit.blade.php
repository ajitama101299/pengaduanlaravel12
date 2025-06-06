@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Edit Status & Berikan Tanggapan Pengaduan</h2>
        <a href="{{ route('admin.pengaduan.show', $aduan->id) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Detail
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Pengaduan: {{ $aduan->judul }}</h5>
            <small class="text-muted">Nomor: {{ $aduan->nomor_pengaduan }} | Pelapor: {{ $aduan->user->name ?? 'N/A' }}</small>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.pengaduan.update', $aduan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status" class="form-label"><strong>Ubah Status Pengaduan</strong></label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="menunggu" {{ old('status', $aduan->status) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="diproses" {{ old('status', $aduan->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="selesai" {{ old('status', $aduan->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                {{-- Tambahkan status lain jika ada --}}
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="tanggapan" class="form-label"><strong>Tanggapan / Catatan Admin</strong></label>
                    <textarea name="tanggapan" id="tanggapan" rows="5" class="form-control @error('tanggapan') is-invalid @enderror" placeholder="Berikan tanggapan atau catatan terkait pengaduan ini...">{{ old('tanggapan', $aduan->tanggapan) }}</textarea>
                    @error('tanggapan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Tanggapan ini akan dapat dilihat oleh pengguna (jika diimplementasikan).</small>
                </div>

                <hr>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Tambahan style jika diperlukan */
</style>
@endpush