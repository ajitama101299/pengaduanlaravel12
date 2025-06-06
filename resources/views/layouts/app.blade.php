<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin | Sistem Pengaduan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Tambahan CSS dari halaman lain --}}
    @stack('styles')
    
    <style>
        .table-green {
    background-color: #2e7d32 !important; /* Hijau gelap */
    color: white;
    }

    /* Hover untuk baris tabel */
    .table-hover tbody tr:hover {
    background-color: #c8e6c9 !important; /* Hijau muda */
    }

    /* Border tabel lebih lembut */
    .table-bordered > :not(caption) > * > * {
    border-color: #a5d6a7; /* Warna hijau muda */
    }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f4f4f4;
        }
        .sidebar {
            width: 220px;
            background-color: #2e7d32;
            color: #fff;
            position: fixed;
            height: 100%;
        }
        .sidebar h4 {
            padding: 20px;
            margin: 0;
            font-weight: bold;
            background-color: #1b5e20;
            text-align: center;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #e0e0e0;
            text-decoration: none;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #388e3c;
            color: #fff;
        }
        .content {
            margin-left: 220px;
            padding: 20px;
            width: 100%;
        }
        .topbar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding-bottom: 15px;
        }
        .topbar .user-info {
            font-weight: bold;
        }
        .badge-green {
            background-color: #4caf50;
        }
        .badge-red {
            background-color: #f44336;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4>LAPORNDAN!</h4>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home me-2"></i> Dashboard
        </a>
        <a href="{{ route('admin.pengaduan.index') }}" class="{{ request()->routeIs('admin.pengaduan.*') ? 'active' : '' }}">
            <i class="fas fa-file-alt me-2"></i> Data Pengaduan
        </a>
        {{-- <a href="{{ route('admin.kategori.index') }}" class="{{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
            <i class="fas fa-tags me-2"></i> Data Kategori
        </a> --}}
        <a href="{{ route('admin.kelolapelapor.index') }}" class="{{ request()->routeIs('admin.kelolapelapor.*') ? 'active' : '' }}">
            <i class="fas fa-users me-2"></i> Data Pelapor
        </a>

        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="topbar">
            <span class="user-info text-success fw-bold">
                <i class="fas fa-user-shield me-2"></i>ADMIN
            </span>
        </div>
        
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Tambahan JS dari halaman lain --}}
    @stack('scripts')
    
</body>
</html>
