<!-- resources/views/aduan/create.blade.php -->
@extends('layouts.user')

@section('content')
<h2>Buat Pengaduan Baru</h2>

<form action="{{ route('user.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Input lain seperti judul, isi, telepon, email -->
    <label for="judul">Judul:</label>
    <input type="text" name="judul" id="judul" required><br><br>

    <label for="isi_pengaduan">Isi Pengaduan:</label>
    <textarea name="isi_pengaduan" id="isi_pengaduan" required></textarea><br><br>

    <!-- Input lokasi: akan diisi otomatis saat user klik peta -->
    <label>Lokasi Kejadian (klik peta untuk memilih):</label>
    <div id="map" style="height: 400px;"></div><br>

    <input type="hidden" name="latitude" id="latitude" required>
    <input type="hidden" name="longitude" id="longitude" required>

    <!-- File foto (opsional) -->
    <label for="foto">Foto (opsional):</label>
    <input type="file" name="foto" id="foto"><br><br>

    <button type="submit">Kirim Pengaduan</button>
</form>

<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
  // Set koordinat default, misal kota Solo (-7.57, 110.8)
  const defaultLat = -7.57;
  const defaultLng = 110.8;
  
  const map = L.map('map').setView([defaultLat, defaultLng], 13);

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
