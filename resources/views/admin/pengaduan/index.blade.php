@extends('layouts.app') <!-- Ganti ini jika menggunakan layout lain -->

@section('content')
<div class="container-fluid">
    <div class="row">
        

        <!-- Main Content -->
        <div class="col-md-16">
            <div class="p-4">
                <h4>Laporan Masuk</h4>
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Isi Laporan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Surya Ray</td>
                            <td>ray@gmail.com</td>
                            <td>087123123444</td>
                            <td>Apakah nomor pengaduan itu dan apa yang harus saya lakukan terhadap nomor pengaduan ini?</td>
                            <td>07/04/2018</td>
                            <td><span class="badge bg-warning text-dark">Menunggu</span></td>
                            <td>
                                <a href="#" class="btn btn-primary btn-sm">Detail</a>
                                <a href="#" class="btn btn-success btn-sm">Balas</a>
                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Wahid Ari</td>
                            <td>wahid.ari@gmail.com</td>
                            <td>087368666666</td>
                            <td>Apakah Aplikasi Pengaduan Masyarakat Dispendukcapil Bangkalan ini?</td>
                            <td>07/04/2018</td>
                            <td><span class="badge bg-success">Direspon</span></td>
                            <td>
                                <a href="#" class="btn btn-primary btn-sm">Detail</a>
                                <a href="#" class="btn btn-success btn-sm">Balas</a>
                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-end">
                    <small class="text-muted">Updated yesterday at 11:56 PM</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
