@extends('layouts.user')

@section('content')

    <h2 class="mb-4">Buat Pengaduan Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('user.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nomor_pengaduan" class="form-label">Nomor Pengaduan</label>
            <input type="text" name="nomor_pengaduan" id="nomor_pengaduan" class="form-control" value="{{ $nomor_pengaduan }}" readonly>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', auth()->user()->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="text" name="telepon" id="telepon" class="form-control" value="{{ old('telepon') }}" required>
        </div>

        <div class="mb-3">
            <label for="judul" class="form-label">Judul Pengaduan</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" required>
        </div>

        <div class="mb-3">
            <label for="isi_pengaduan" class="form-label">Isi Pengaduan</label>
            <textarea name="isi_pengaduan" id="isi_pengaduan" class="form-control" rows="5" required>{{ old('isi_pengaduan') }}</textarea>
        </div>

        {{-- Bagian GIS: Peta untuk Memilih Lokasi --}}
        <div class="mb-3">
            <label class="form-label">Tentukan Lokasi Kejadian di Peta:</label>
            <div id="mapid" style="height: 400px; width: 100%; border: 1px solid #ced4da; border-radius: 0.25rem;"></div>
            <small class="form-text text-muted mt-2">Geser penanda di peta atau klik area lain di peta untuk menentukan lokasi kejadian yang lebih spesifik.</small>
        </div>

        {{-- Input tersembunyi untuk menyimpan Latitude dan Longitude --}}
        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}" required>
        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}" required>
        <p class="mt-2">Koordinat Terpilih: <strong id="coordinatesDisplay">Belum dipilih</strong></p>

        {{-- Kolom lokasi lama: Bisa digunakan untuk alamat teks deskriptif --}}
        <div class="mb-3">
            <label for="lokasi" class="form-label">Nama/Deskripsi Lokasi (Opsional)</label>
            <input type="text" name="lokasi" id="lokasi" class="form-control" value="{{ old('lokasi') }}" placeholder="Contoh: Depan Balai Desa, Jalan Merdeka No. 10">
            <small class="form-text text-muted">Misalnya, nama tempat atau alamat yang lebih spesifik.</small>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Upload Foto Bukti (opsional)</label>
            <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
        </div>

        <input type="hidden" name="tanggal" value="{{ now()->toDateString() }}">

        <button type="submit" class="btn btn-success">Kirim Pengaduan</button>
        <a href="{{ route('user.pengaduan.index') }}" class="btn btn-secondary">Batal</a>
    </form>


{{-- CSS dan JS Leaflet --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    // Set koordinat default, misal kota Solo (-7.57, 110.8)
    const defaultLat = -7.57;
    const defaultLng = 110.8;
    
    const map = L.map('mapid').setView([defaultLat, defaultLng], 13);
  
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
  
    let marker;
  
    map.on('click', function(e) {
      // Hapus marker sebelumnya
      if (marker) {
        map.removeLayer(marker);
      }
      // Tambah marker baru di lokasi klik
      marker = L.marker(e.latlng).addTo(map);
  
      // Isi input latitude dan longitude
      document.getElementById('latitude').value = e.latlng.lat;
      document.getElementById('longitude').value = e.latlng.lng;
    });
  </script>
@endsection