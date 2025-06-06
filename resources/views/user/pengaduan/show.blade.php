@extends('layouts.user')

@section('content')
@php use Illuminate\Support\Facades\Storage; @endphp

<style>
    .text-custom { color: #2e7a75; }
    .btn-custom { background-color: #2e7a75; color: #fff; border: none; }
    .btn-custom:hover { background-color: #256660; color: #fff; }

    .badge-menunggu { background-color: #ffc107; color: #212529; }
    .badge-proses { background-color: #17a2b8; color: #fff; }
    .badge-selesai { background-color: #28a745; color: #fff; }
    .badge-secondary { background-color: #6c757d; color: #fff; }

    dt { font-weight: 600; }
    .card-body dd { margin-bottom: .75rem; }

    .admin-response {
        background-color: #e9f7f7;
        border: 1px solid #2e7a75;
        border-radius: 8px;
        padding: 1rem 1.25rem;
        margin-top: 1.5rem;
        color: #145a54;
        font-size: 1rem;
        white-space: pre-wrap;
    }
    .admin-response-header {
        font-weight: 700;
        font-size: 1.25rem;
        margin-bottom: 0.75rem;
        color: #2e7a75;
    }
    .admin-response-date {
        font-size: 0.875rem;
        color: #4d7c75;
        font-style: italic;
        margin-top: 0.5rem;
    }
    .admin-response-empty {
        font-style: italic;
        color: #6c757d;
        margin-top: 1rem;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-custom">Detail Pengaduan</h2>
        <a href="{{ route('user.pengaduan.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">{{ $aduan->judul }}</h4>
            @php
                $badgeClass = match($aduan->status) {
                    'menunggu' => 'badge-menunggu',
                    'diproses' => 'badge-proses',
                    'selesai'  => 'badge-selesai',
                    default    => 'badge-secondary'
                };
            @endphp
            <span class="badge {{ $badgeClass }} fs-6">{{ ucfirst($aduan->status) }}</span>
        </div>

        <div class="card-body">
            <div class="row">
                {{-- Info Utama --}}
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
                            <p class="mt-2 small text-muted">Koordinat: {{ $aduan->latitude }}, {{ $aduan->longitude }}</p>
                            @else
                                <span>-</span>
                            @endif
                        </dd>

                        <dt class="col-sm-4">Isi Pengaduan</dt>
                        <dd class="col-sm-8" style="white-space: pre-wrap;">{{ $aduan->isi_pengaduan }}</dd>

                        <hr class="my-3">

                        <dt class="col-sm-4">Pelapor</dt>
                        <dd class="col-sm-8">{{ $aduan->user->name ?? $aduan->nama ?? 'Data Pelapor Tidak Ditemukan' }}</dd>

                        <dt class="col-sm-4">Email Pelapor</dt>
                        <dd class="col-sm-8">{{ $aduan->user->email ?? $aduan->email ?? '-' }}</dd>

                        <dt class="col-sm-4">Telepon Pelapor</dt>
                        <dd class="col-sm-8">{{ $aduan->telepon ?? '-' }}</dd>
                    </dl>
                </div>

                {{-- Foto Bukti --}}
                <div class="col-md-4">
                    <h5>Foto Pengaduan</h5>
                    @if ($aduan->foto && Storage::disk('public')->exists($aduan->foto))
                        <a href="{{ asset('storage/' . $aduan->foto) }}" data-bs-toggle="modal" data-bs-target="#imagePreviewModal">
                            <img src="{{ asset('storage/' . $aduan->foto) }}" alt="Foto Pengaduan {{ $aduan->judul }}" class="img-fluid rounded shadow-sm" style="max-height: 300px; cursor: pointer;">
                        </a>
                        <p class="mt-2 text-muted small">Klik gambar untuk melihat ukuran penuh.</p>
                    @else
                        <div class="text-center p-3 border rounded bg-light">
                            <i class="fas fa-image fa-3x text-muted"></i>
                            <p class="mt-2 mb-0 text-muted">Foto tidak tersedia atau tidak ditemukan.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Tanggapan Admin --}}
        @if ($aduan->tanggapan)
            <div class="card-footer">
                <div class="admin-response">
                    <div class="admin-response-header">Tanggapan Admin:</div>
                    {{ $aduan->tanggapan }}
                    @if($aduan->updated_at)
                        <div class="admin-response-date">Diberikan pada: {{ \Carbon\Carbon::parse($aduan->updated_at)->translatedFormat('d F Y, H:i') }}</div>
                    @endif
                </div>
            </div>
        @else
            <div class="card-footer">
                <div class="admin-response-empty">Belum ada tanggapan dari admin.</div>
            </div>
        @endif
    </div>

    {{-- Modal Preview Gambar --}}
    @if ($aduan->foto && Storage::disk('public')->exists($aduan->foto))
    <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imagePreviewModalLabel">Pratinjau Foto: {{ $aduan->judul }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
@endpush


@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@if ($aduan->latitude && $aduan->longitude)
<script>
    const latitude = {{ $aduan->latitude }};
    const longitude = {{ $aduan->longitude }};
    const lokasi = [latitude, longitude];

    console.log("Koordinat lokasi:", lokasi);

    const map = L.map('map').setView(lokasi, 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    L.marker(lokasi).addTo(map)
        .bindPopup("Lokasi Kejadian")
        .openPopup();
</script>
@endif
@endpush

