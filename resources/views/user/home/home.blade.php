@extends('layouts.user')

@section('title', 'Beranda')

@section('content')
    <!-- Hero Section -->
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <marquee behavior="scroll" direction="left" scrollamount="13">
                <h1 class="display-5 fw-bold" style="color: #2e7a75;">Selamat Datang di Sistem Pengaduan Desa Ngabenrejo</h1>
            </marquee>
            <p class="lead mb-4">Laporkan masalah Anda dengan mudah dan cepat. Kami siap membantu menyelesaikan setiap pengaduan masyarakat.</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a href="{{ route('user.pengaduan.create') }}" class="btn btn-primary-custom btn-lg px-4 gap-3">
                    <i class="fas fa-edit me-1"></i> Buat Pengaduan Baru
                </a>
                {{-- <a href="{{ route('user.pengaduan.index') }}" class="btn btn-outline-success btn-lg px-4 gap-3">
                    <i class="fas fa-list-alt me-1"></i> Lihat Pengaduan
                </a> --}}
            </div>
        </div>
    </div>
    
    <!-- Cards Section -->
    <style>
        .bg-custom {
            background-color: rgba(46, 122, 117, 0.1); /* versi transparan */
        }
        
        .text-custom {
            color: #2e7a75;
        }
    </style>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card card-custom h-100">
                <div class="card-body text-center p-4">
                        <div class="bg-custom p-3 rounded-circle d-inline-block mb-3">
                            <i class="fas fa-home fa-2x text-custom"></i>
                        </div>
                    <h3 class="h5 fw-bold mb-3">Layanan Publik</h3>
                    <p class="text-muted">Laporkan masalah terkait layanan publik di lingkungan Anda</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card card-custom h-100">
                <div class="card-body text-center p-4">
                    <div class="bg-custom p-3 rounded-circle d-inline-block mb-3 me-2">
                        <i class="fas fa-road fa-2x text-custom"></i>
                    </div>
                    <h3 class="h5 fw-bold mb-3">Infrastruktur</h3>
                    <p class="text-muted">Laporkan kerusakan jalan, jembatan, atau fasilitas umum lainnya</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card card-custom h-100">
                <div class="card-body text-center p-4">
                    <div class="bg-custom p-3 rounded-circle d-inline-block mb-3">
                        <i class="fas fa-trash fa-2x text-custom"></i>
                    </div>
                    <h3 class="h5 fw-bold mb-3">Lingkungan</h3>
                    <p class="text-muted">Laporkan masalah kebersihan atau kerusakan lingkungan</p>
                </div>
            </div>
        </div>
    </div>
@endsection