<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Pengaduan Masyarakat</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            padding-top: 1rem;
        }
        .sidebar .nav-link {
            color: #adb5bd;
            transition: 0.3s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff;
            background-color: #495057;
            border-radius: 0.375rem;
        }
        .sidebar .nav-link i {
            margin-right: 8px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-black">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-city me-2"></i> Aduan Masyarakat Ngabenrejo
            </a>
            <div class="d-flex">
                <!-- Tombol Logout -->
                <a href="#" class="btn btn-outline-light"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- Form Logout Tersembunyi -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Container -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <aside class="col-md-2 sidebar text-white">
                <div class="text-center mb-4">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" class="rounded-circle mb-2" width="80" alt="Admin">
                    <h6 class="mb-0 text-white">{{ Auth::user()->name }}</h6>
                    <small class="text-white">Super Admin</small>
                </div>
                <nav class="nav flex-column px-2">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a class="nav-link {{ request()->is('admin/pengaduan*') ? 'active' : '' }}" href="{{ route('admin.pengaduan.index') }}">
                        <i class="fas fa-envelope"></i> Pengaduan
                    </a>
                </nav>
            </aside>

            <!-- Content -->
            <main class="col-md-10 p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-5">
        <small>Copyright © Rahmadani Ajitama 2025</small>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
