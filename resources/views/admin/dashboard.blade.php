@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-success ">Dashboard Admin</h1>
        <div class="text-muted fs-6">Hari ini: {{ date('d F Y') }}</div>
    </div>

    <!-- Statistik -->
    <div class="row g-4 mb-4">
        @php
            $cards = [
                ['title' => 'Total Pengaduan', 'count' => $total, 'color' => 'primary', 'icon' => 'clipboard-list'],
                ['title' => 'Status Baru', 'count' => $baru, 'color' => 'warning', 'icon' => 'exclamation-circle'],
                ['title' => 'Diproses', 'count' => $proses, 'color' => 'info', 'icon' => 'spinner'],
                ['title' => 'Selesai', 'count' => $selesai, 'color' => 'success', 'icon' => 'check-circle'],
            ];
        @endphp
        @foreach($cards as $card)
        <div class="col-xl-3 col-md-6">
            <div class="card h-100 shadow border-10" style="background: linear-gradient(135deg, var(--bs-{{ $card['color'] }}) 90%, #fff 100%);">
                <div class="card-body d-flex justify-content-between align-items-center text-white">
                    <div>
                        <h6 class="text-uppercase mb-2">{{ $card['title'] }}</h6>
                        <h3 class="fw-bold">{{ $card['count'] }}</h3>
                    </div>
                    <i class="fas fa-{{ $card['icon'] }} fa-2x opacity-75"></i>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Grafik & Pengaduan Terbaru -->
    <div class="row g-4">
        <!-- Grafik -->
        <div class="col-xl-8">
            <div class="card shadow-sm border-50">
                <div class="card-header bg-light border-0 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-success">Statistik Pengaduan Bulan Ini</h6>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Bulan Ini
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Minggu Ini</a></li>
                            <li><a class="dropdown-item" href="#">Bulan Ini</a></li>
                            <li><a class="dropdown-item" href="#">Tahun Ini</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="pengaduanChart" height="250"></canvas>
                </div>
            </div>
        </div>

        <!-- Pengaduan Terbaru -->
        <div class="col-xl-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light border-0">
                    <h6 class="m-0 fw-bold text-success">Pengaduan Terbaru</h6>
                </div>
                <div class="card-body p-0">
                    @if($recentComplaints->isEmpty())
                        <div class="p-4 text-center text-muted">Belum ada pengaduan baru</div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach($recentComplaints as $complaint)
                            <a href="#" class="list-group-item list-group-item-action px-4 py-3">
                                <div class="d-flex justify-content-between">
                                    <h6 class="mb-1 text-dark">{{ Str::limit($complaint->title, 30) }}</h6>
                                    <small class="text-muted">{{ $complaint->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1 text-muted">{{ Str::limit($complaint->description, 50) }}</p>
                                <span class="badge bg-{{ $complaint->status == 'baru' ? 'warning' : ($complaint->status == 'proses' ? 'info' : 'success') }}">
                                    {{ ucfirst($complaint->status) }}
                                </span>
                            </a>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="card-footer bg-light text-center">
                    <a href="#" class="text-decoration-none text-success">Lihat Semua Pengaduan</a>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('pengaduanChart').getContext('2d');
    const pengaduanChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
            datasets: [{
                label: 'Pengaduan Baru',
                data: [12, 19, 8, 15],
                backgroundColor: 'rgba(255, 193, 7, 0.7)',
                borderColor: 'rgba(255, 193, 7, 1)',
                borderWidth: 1
            }, {
                label: 'Pengaduan Selesai',
                data: [8, 12, 5, 10],
                backgroundColor: 'rgba(40, 167, 69, 0.7)',
                borderColor: 'rgba(40, 167, 69, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 5
                    }
                }
            }
        }
    });
</script>
@endsection
@endsection
