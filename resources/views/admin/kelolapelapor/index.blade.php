@extends('layouts.app')

@section('title', 'Kelola Data Pelapor')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Kelola Data Pelapor</h4>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tanggal Laporan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pelaporList as $index => $pelapor)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pelapor->name }}</td>
                            <td>{{ $pelapor->email }}</td>
                            <td>{{ $pelapor->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.kelolapelapor.edit', $pelapor->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('admin.kelolapelapor.destroy', $pelapor->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data pelapor</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
