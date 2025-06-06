@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Daftar Pengaduan Masyarakat</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($aduans->isEmpty())
        <div class="alert alert-info">Belum ada pengaduan yang masuk.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                
                <thead class="table-green text-white">
                    <tr>
                        <th>No</th>
                        <th>Nomor Pengaduan</th>
                        <th>Judul</th>
                        <th>Isi Pengaduan</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aduans as $aduan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>  <!-- Menggunakan $loop->iteration -->
                            <td>{{ $aduan->nomor_pengaduan }}</td>
                            <td>{{ $aduan->judul }}</td>
                            <td>{{ Str::limit($aduan->isi_pengaduan, 50) }}</td>
                            <td>{{ $aduan->tanggal }}</td>
                            <td>{{ $aduan->lokasi }}</td>
                            <td>
                                @php
                                    $badgeClass = '';
                                    $statusText = ucfirst($aduan->status); // Menggunakan $aduan->status

                                    switch ($aduan->status) { // Menggunakan $aduan->status
                                        case 'menunggu':
                                            $badgeClass = 'bg-warning text-dark';
                                            break;
                                        case 'diproses':
                                            $badgeClass = 'bg-primary';
                                            break;
                                        case 'selesai':
                                            $badgeClass = 'bg-success';
                                            break;
                                        default:
                                            $badgeClass = 'bg-secondary';
                                            break;
                                    }
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.pengaduan.show', $aduan->id) }}" class="btn btn-sm btn-info">Lihat</a>
                                <a href="{{ route('admin.pengaduan.edit', $aduan->id) }}" class="btn btn-sm btn-warning">Edit Status</a>
                                
                                <form action="{{ route('admin.pengaduan.destroy', $aduan->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                                
                            </td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection


