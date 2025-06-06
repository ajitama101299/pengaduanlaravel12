@extends('layouts.user')

@section('content')

<style>
    /* Gaya kustom untuk teks dan tombol */
    .text-custom { color: #2e7a75; }
    .btn-custom { background-color: #2e7a75; color: #fff; border: none; }
    .btn-custom:hover { background-color: #256660; color: #fff; }

    /* Gaya untuk badge status */
    .badge-menunggu { background-color: #ffc107; color: #212529; } /* Kuning untuk Menunggu */
    .badge-proses { background-color: #17a2b8; color: #fff; }    /* Biru untuk Diproses */
    .badge-selesai { background-color: #28a745; color: #fff; }    /* Hijau untuk Selesai */
    .badge-secondary { background-color: #6c757d; color: #fff; } /* Abu-abu untuk status lainnya */

    /* Gaya untuk thumbnail foto */
    .thumbnail-img {
        width: 50px; /* Lebar thumbnail */
        height: 50px; /* Tinggi thumbnail */
        object-fit: cover; /* Memastikan gambar mengisi area tanpa terdistorsi */
        border-radius: 5px; /* Sudut membulat */
        border: 1px solid #ddd; /* Border tipis */
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3 align-items-center">
        <h2 class="text-custom">Daftar Pengaduan Saya</h2>
        <a href="{{ route('user.pengaduan.create') }}" class="btn btn-custom">+ Buat Pengaduan</a>
    </div>

    {{-- Form Filter dan Search --}}
    <form method="GET" action="{{ route('user.pengaduan.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari judul pengaduan...">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">-- Semua Status --</option>
                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-secondary w-100">Filter</button>
        </div>
        <div class="col-md-2 d-flex align-items-center">
            <a href="{{ route('user.pengaduan.index') }}" class="btn btn-outline-secondary w-100 d-flex justify-content-center align-items-center" title="Reset">
                <i class="fas fa-undo"></i>
                <span class="visually-hidden">Reset</span>
            </a>
        </div>
        
    </form>

    @if ($aduans->isEmpty())
        {{-- Pesan jika tidak ada pengaduan --}}
        <div class="alert alert-info">Tidak ada pengaduan ditemukan.</div>
    @else
        {{-- Tabel daftar pengaduan --}}
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Foto</th> {{-- Kolom baru untuk foto --}}
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aduans as $index => $aduan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $aduan->judul }}</td>
                        <td>{{ \Carbon\Carbon::parse($aduan->tanggal)->translatedFormat('d M Y') }}</td>
                        <td>
                            @php
                                // Menentukan kelas badge berdasarkan status pengaduan
                                $badgeClass = match($aduan->status) {
                                    'menunggu' => 'badge-menunggu',
                                    'diproses' => 'badge-proses',
                                    'selesai'  => 'badge-selesai',
                                    default    => 'badge-secondary'
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ ucfirst($aduan->status) }}</span>
                        </td>
                        <td>
                            @if ($aduan->foto)
                                {{-- Menampilkan thumbnail foto jika ada --}}
                                <img src="{{ asset('storage/' . $aduan->foto) }}" alt="Foto Pengaduan" class="thumbnail-img">
                            @else
                                {{-- Teks jika tidak ada foto --}}
                                <span class="text-muted small">Tidak ada foto</span>
                            @endif
                        </td>
                        <td>
                            {{-- Tombol untuk melihat detail pengaduan --}}
                            <a href="{{ route('user.pengaduan.show', $aduan->id) }}" class="btn btn-sm btn-info">Lihat</a>
                            {{-- Anda bisa menambahkan tombol edit/hapus di sini jika diperlukan untuk pengguna --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- Bagian untuk pagination jika Anda menggunakannya (uncomment jika perlu) --}}
        {{-- <div class="mt-3">
            {{ $aduans->links() }}
        </div> --}}
    @endif
</div>
@endsection
