<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelaporan Masyarakat - @yield('title')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    {{-- Styles tambahan dari halaman anak --}}
    @stack('styles')

    <style>
        /* Green gradient background */
        body {
            background: linear-gradient(135deg, #62a79c 0%, #c1f2d1 50%, #51ad97 100%);
            min-height: 100vh;
        }

        /* Card styling */
        .card-custom {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s, box-shadow 0.2s;
            background-color: rgba(255, 255, 255, 0.9);
        }

        .card-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        /* Button styling */
        .btn-primary-custom {
            background-color: #2e7a75;
            border-color: #2e7a75;
            color: white;
        }

        .btn-primary-custom:hover {
            background-color: #276963;
            border-color: #276963;
        }

        /* Navbar styling */
        .navbar-custom {
            background-color: #2e7a75 !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="#">
            <i class="fas fa-bullhorn me-2"></i> Sistem Pengaduan
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link text-white px-3" href="{{ route('user.home') }}">
                        <i class="fas fa-home me-1"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3" href="{{ route('user.pengaduan.index') }}">
                        <i class="fas fa-list-alt me-1"></i> Riwayat Pengaduan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-3" href="{{ route('user.pengaduan.create') }}">
                        <i class="fas fa-edit me-1"></i> Lapor
                    </a>
                </li>

                {{-- Dropdown User --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center px-3 text-white" href="#" id="userDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="bg-light rounded-circle p-1 me-2 d-flex justify-content-center align-items-center" style="width: 35px; height: 35px;">
                            <i class="fas fa-user text-success"></i>
                        </div>
                        <span class="d-none d-md-inline">
                            {{ Auth::user()->name }}
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                        <li class="px-3 py-2">
                            <strong>{{ Auth::user()->name }}</strong><br>
                            <small class="text-muted">{{ Auth::user()->email }}</small>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            {{-- Form Logout --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</nav>

{{-- Konten --}}
<main class="py-4">
    <div class="container">
        @yield('content')
    </div>
</main>

{{-- Footer --}}
<footer class="bg-success bg-opacity-10 py-4 mt-5">
    <div class="container text-center">
        <p class="mb-0 text-muted">&copy; {{ date('Y') }} Sistem Pengaduan Masyarakat. All rights reserved.</p>
    </div>
</footer>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- Script tambahan dari halaman anak --}}
@stack('scripts')

</body>
</html>
