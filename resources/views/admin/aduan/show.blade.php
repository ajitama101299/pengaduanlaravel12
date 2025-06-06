@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Detail Pengaduan</h2>
        <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">{{ $aduan->judul }}</h4>
            @php
                $badgeClass = match($aduan->status) {
                    'menunggu' => 'bg-warning text-dark',
                    'diproses' => 'bg-primary text-white',
                    'selesai' => 'bg-success text-white',
                    default => 'bg-secondary text-white',
                };
            @endphp
            <span class="badge {{ $badgeClass }} fs-6">{{ ucfirst($aduan->status) }}</span>
        </div>

        <div class="card-body">
            <div class="row">
                <!-- Informasi Detail -->
                <div class="col-md-8">
                    <dl class="row">
                        <dt class="col-sm-4">Nomor Pengaduan</dt>
                        <dd class="col-sm-8">{{ $aduan->nomor_pengaduan }}</dd>

                        <dt class="col-sm-4">Tanggal Pengaduan</dt>
                        <dd class="col-sm-8">{{ \Carbon\Carbon::parse($aduan->tanggal)->translatedFormat('l, d F Y H:i') }} WIB</dd>

                        <dt class="col-sm-4">Lokasi Kejadian</dt>
                        <dd class="col-sm-8">
                            @if ($aduan->latitude && $aduan->longitude)
                                <div id="map" style="height: 300px; border-radius: 8px;"></div>
                                <p class="mt-2 text-muted small">Koordinat: {{ $aduan->latitude }}, {{ $aduan->longitude }}</p>
                            @else
                                {{ $aduan->lokasi ?: '-' }}
                            @endif
                        </dd>

                        <dt class="col-sm-4">Isi Pengaduan</dt>
                        <dd class="col-sm-8" style="white-space: pre-wrap;">{{ $aduan->isi_pengaduan }}</dd>

                        <hr class="my-3">

                        <dt class="col-sm-4">Pelapor</dt>
                        <dd class="col-sm-8">{{ $aduan->user->name ?? 'Data Pelapor Tidak Ditemukan' }}</dd>

                        <dt class="col-sm-4">Email Pelapor</dt>
                        <dd class="col-sm-8">{{ $aduan->user->email ?? '-' }}</dd>
                    </dl>
                </div>

                <!-- Foto Pengaduan -->
                <div class="col-md-4">
                    <h5>Foto Pengaduan</h5>
                    @if ($aduan->foto)
                        <a href="{{ asset('storage/' . $aduan->foto) }}" data-bs-toggle="modal" data-bs-target="#imagePreviewModal">
                            <img src="{{ asset('storage/' . $aduan->foto) }}" alt="Foto Pengaduan {{ $aduan->judul }}" class="img-fluid rounded shadow-sm" style="max-height: 300px; cursor: pointer;">
                        </a>
                        <p class="mt-2 text-muted small">Klik gambar untuk melihat ukuran penuh.</p>
                    @else
                        <div class="text-center p-3 border rounded bg-light">
                            <i class="fas fa-image fa-3x text-muted"></i>
                            <p class="mt-2 mb-0 text-muted">Tidak ada foto dilampirkan.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="card-footer d-flex justify-content-end gap-2">
            <a href="{{ route('admin.pengaduan.edit', $aduan->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit Status Pengaduan
            </a>
        </div>
    </div>

    <!-- Modal Preview Gambar -->
    @if ($aduan->foto)
    <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imagePreviewModalLabel">Pratinjau Foto: {{ $aduan->judul }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('storage/' . $aduan->foto) }}" class="img-fluid" alt="Foto Pengaduan {{ $aduan->judul }}">
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    dt { font-weight: 600; }
    .card-body dd { margin-bottom: .75rem; }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@if ($aduan->latitude && $aduan->longitude)
<script>
    const lat = {{ $aduan->latitude }};
    const lng = {{ $aduan->longitude }};

    const map = L.map('map').setView([lat, lng], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    L.marker([lat, lng]).addTo(map)
        .bindPopup("Lokasi Kejadian")
        .openPopup();
</script>
@endif
@endpush
