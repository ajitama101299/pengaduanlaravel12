<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Pengaduan Masyarakat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3a9690;
            --primary-dark: #2e7a75;
            --primary-light: #e6feff;
            --secondary-color: #f8f9fa;
            --text-dark: #333;
            --text-light: #666;
            --bg-color: #f8f9fa;
            --card-bg: #ffffff;
            --text-color: #333;
            --navbar-bg: #3a9690;
            --footer-bg: #3a9690;
            --border-color: #dee2e6;
        }

        [data-bs-theme="dark"] {
            --primary-color: #3a9690;
            --primary-dark: #2e7a75;
            --primary-light: #1a2e35;
            --secondary-color: #1e1e1e;
            --text-dark: #f8f9fa;
            --text-light: #adb5bd;
            --bg-color: #121212;
            --card-bg: #1e1e1e;
            --text-color: #f8f9fa;
            --navbar-bg: #1a2e35;
            --footer-bg: #1a2e35;
            --border-color: #2d2d2d;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        
        /* Navbar Styling */
        .navbar-custom {
            background-color: var(--navbar-bg) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-custom .navbar-brand {
            font-weight: 700;
            color: white;
            font-size: 1.5rem;
        }
        
        .navbar-custom .nav-link {
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }
        
        .navbar-custom .nav-link:hover {
            color: white;
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: var(--card-bg);
        }

        .dropdown-item {
            color: var(--text-color);
        }

        .dropdown-item:hover {
            background-color: var(--primary-light);
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-color) 100%);
            padding: 5rem 0;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 40%;
            height: 100%;
            background-image: url('/images/pattern-leaf.png');
            background-size: contain;
            background-repeat: no-repeat;
            opacity: 0.1;
        }
        
        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
            color: var(--text-light);
            margin-bottom: 2rem;
            max-width: 600px;
        }
        
        /* Button Styling */
        .btn-custom {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        
        .btn-custom:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(58, 150, 144, 0.3);
        }

        .btn-outline-custom {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline-custom:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        /* Steps Section */
        .steps-section {
            padding: 5rem 0;
            background-color: var(--bg-color);
        }
        
        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }
        
        .section-title::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 4px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }
        
        .section-subtitle {
            color: var(--text-light);
            margin-bottom: 3rem;
        }
        
        .step-card {
            border: none;
            border-radius: 12px;
            background: var(--card-bg);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            height: 100%;
            transition: all 0.3s ease;
            border-top: 4px solid var(--primary-light);
        }
        
        .step-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            border-top-color: var(--primary-color);
        }
        
        .step-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--primary-light);
            border-radius: 50%;
        }
        
        .step-icon img {
            max-width: 50px;
            max-height: 50px;
        }
        
        .step-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }
        
        .step-description {
            color: var(--text-light);
        }
        
        /* Map Section */
        .map-section {
            padding: 5rem 0;
            background-color: var(--secondary-color);
        }
        
        .map-container {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            height: 500px;
            border: 1px solid var(--border-color);
        }
        
        /* Footer */
        .footer {
            background-color: var(--footer-bg);
            color: white;
            padding: 2rem 0;
            text-align: center;
        }
        
        .footer p {
            margin-bottom: 0;
        }

        /* Dark Mode Toggle */
        .theme-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0.5rem;
            margin-left: 1rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
            }
            
            .section-title {
                font-size: 1.75rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-bullhorn me-2"></i> LAPOR NDAN
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#proses">Tata Cara</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#lokasi">Lokasi</a>
                    </li>
                    
                    <!-- Dark Mode Toggle -->
                    <li class="nav-item">
                        <button class="theme-toggle" id="themeToggle">
                            <i class="fas fa-moon"></i>
                        </button>
                    </li>
                    
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="authDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user me-1"></i> Akun
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="authDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('login') }}">
                                            <i class="fas fa-sign-in-alt me-2"></i> Login
                                        </a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li>
                                            <a class="dropdown-item" href="{{ route('register') }}">
                                                <i class="fas fa-user-plus me-2"></i> Register
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title">Layanan Pengaduan Masyarakat Online</h1>
                    <p class="hero-subtitle">Sampaikan laporan masalah Anda dengan mudah dan cepat. Kami siap membantu menyelesaikan setiap pengaduan masyarakat.</p>
                    <div class="d-flex gap-3">
                        <a href="{{ Auth::check() ? route('user.dashboard') : route('login') }}" class="btn btn-custom">
                            <i class="fas fa-edit me-2"></i> Buat Laporan
                        </a>
                        <a href="#proses" class="btn btn-outline-custom">
                            <i class="fas fa-info-circle me-2"></i> Pelajari
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="/images/komunikasi.webp" alt="Hero Image" class="img-fluid rounded-3 shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Steps Section -->
    <section class="steps-section" id="proses">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Proses Pengaduan</h2>
                <p class="section-subtitle">Langkah-langkah mudah untuk menyampaikan pengaduan Anda</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="step-card">
                        <div class="step-icon">
                            <img src="/images/laporan.gif" alt="Step 1">
                        </div>
                        <h5 class="step-title">Tulis Laporan</h5>
                        <p class="step-description">Tulis laporan keluhan Anda dengan jelas dan lengkap.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="step-card">
                        <div class="step-icon">
                            <img src="/images/verifikasi.gif" alt="Step 2">
                        </div>
                        <h5 class="step-title">Proses Verifikasi</h5>
                        <p class="step-description">Laporan Anda akan diverifikasi oleh petugas dalam 1x24 jam.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="step-card">
                        <div class="step-icon">
                            <img src="/images/tindak.gif" alt="Step 3">
                        </div>
                        <h5 class="step-title">Tindak Lanjut</h5>
                        <p class="step-description">Petugas akan menindaklanjuti laporan Anda segera.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="step-card">
                        <div class="step-icon">
                            <img src="/images/done.gif" alt="Step 4">
                        </div>
                        <h5 class="step-title">Selesai</h5>
                        <p class="step-description">Anda akan mendapat notifikasi ketika laporan selesai.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section" id="lokasi">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Lokasi Desa Ngaben Rejo</h2>
                <p class="section-subtitle">Peta Kecamatan Grobogan dengan penandaan lokasi Desa Ngaben Rejo</p>
            </div>
            <div class="row">
                <div class="col">
                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63213.52094748663!2d110.8414865!3d-7.0945577!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70b50a74ad543b%3A0x5d042a6b527dd769!2sNgaben%20Rejo%2C%20Grobogan%2C%20Central%20Java!5e0!3m2!1sen!2sid!4v1234567890123" 
                                width="100%" 
                                height="100%" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p class="mb-2">
                <i class="fas fa-bullhorn me-2"></i> Sistem Pengaduan Masyarakat Desa Ngaben Rejo
            </p>
            <p class="mb-0">
                &copy; {{ date('Y') }} - Hak Cipta Dilindungi
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Dark Mode Toggle
        const themeToggle = document.getElementById('themeToggle');
        const htmlElement = document.documentElement;
        
        // Check for saved user preference or use system preference
        const savedTheme = localStorage.getItem('theme');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        if (savedTheme) {
            htmlElement.setAttribute('data-bs-theme', savedTheme);
            updateToggleIcon(savedTheme);
        } else if (systemPrefersDark) {
            htmlElement.setAttribute('data-bs-theme', 'dark');
            updateToggleIcon('dark');
        }
        
        themeToggle.addEventListener('click', () => {
            const currentTheme = htmlElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            htmlElement.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateToggleIcon(newTheme);
        });
        
        function updateToggleIcon(theme) {
            const icon = themeToggle.querySelector('i');
            if (theme === 'dark') {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            } else {
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            }
        }
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>