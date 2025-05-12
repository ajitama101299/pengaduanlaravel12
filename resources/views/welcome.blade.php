<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Layanan Pengaduan Masyarakat</title>
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
    
            .hero {
                background-color: #a88bea;
                padding: 4rem 2rem;
                text-align: center;
            }
    
            .hero img {
                max-width: 100%;
                height: auto;
            }
    
            .hero h1 {
                font-size: 2rem;
                font-weight: bold;
                color: #333;
            }
    
            .hero p {
                font-size: 1.2rem;
                color: #666;
                margin-bottom: 2rem;
            }
    
            .hero .btn-primary {
                padding: 0.75rem 2rem;
                font-size: 1rem;
            }
    
            .steps-section {
                padding: 4rem 2rem;
            }
    
            .steps-section .step-card {
                border: none;
                text-align: center;
                padding: 1.5rem;
                background: #fff;
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
                transition: all 0.3s ease-in-out;
            }
    
            .steps-section .step-card:hover {
                transform: translateY(-5px);
                box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);
            }
    
            .steps-section .step-card img {
                width: 80px;
                height: auto;
                margin-bottom: 1rem;
            }
    
            .steps-section .step-card h5 {
                font-size: 1.1rem;
                font-weight: bold;
                color: #333;
            }
    
            .steps-section .step-card p {
                color: #666;
            }
    
    
            /* From Uiverse.io by cssbuttons-io */
            button {
            position: relative;
            display: inline-block;
            cursor: pointer;
            outline: none;
            border: 0;
            vertical-align: middle;
            text-decoration: none;
            background: transparent;
            padding: 0;
            font-size: inherit;
            font-family: inherit;
            }
    
            button.learn-more {
            width: 12rem;
            height: auto;
            }
    
            button.learn-more .circle {
            transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
            position: relative;
            display: block;
            margin: 0;
            width: 3rem;
            height: 3rem;
            background: #282936;
            border-radius: 1.625rem;
            }
    
            button.learn-more .circle .icon {
            transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
            position: absolute;
            top: 0;
            bottom: 0;
            margin: auto;
            background: #fff;
            }
    
            button.learn-more .circle .icon.arrow {
            transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
            left: 0.625rem;
            width: 1.125rem;
            height: 0.125rem;
            background: none;
            }
    
            button.learn-more .circle .icon.arrow::before {
            position: absolute;
            content: "";
            top: -0.29rem;
            right: 0.0625rem;
            width: 0.625rem;
            height: 0.625rem;
            border-top: 0.125rem solid #fff;
            border-right: 0.125rem solid #fff;
            transform: rotate(45deg);
            }
    
            button.learn-more .button-text {
            transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 0.75rem 0;
            margin: 0 0 0 1.85rem;
            color: #282936;
            font-weight: 700;
            line-height: 1.6;
            text-align: center;
            text-transform: uppercase;
            }
    
            button:hover .circle {
            width: 100%;
            }
    
            button:hover .circle .icon.arrow {
            background: #fff;
            transform: translate(1rem, 0);
            }
    
            button:hover .button-text {
            color: #fff;
            }
    
        </style>
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
          <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">LAPOR NDAN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#proses">Tata Cara</a>
                    </li>                    
                
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="authDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Masuk / Daftar
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="authDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li>
                                            <a class="dropdown-item" href="{{ route('register') }}">Register</a>
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
     <section class="hero">
         <div class="container">
             <div class="row align-items-center">
                 <div class="col-md-6">
                     <h1>Layanan Pengaduan Masyarakat Online</h1>
                     <p>Sampaikan laporan masalah Anda di sini, kami akan memprosesnya dengan cepat.</p>
                     <button class="learn-more" id="report-btn">
                         <span class="circle" aria-hidden="true">
                             <span class="icon arrow"></span>
                         </span>
                         <span class="button-text">Laporkan!</span>
                     </button>
                 </div>
                 <div class="col-md-6">
                     <img src="/images/komunikasi.webp" alt="Step 1">
                 </div>
             </div>
         </div>
     </section>


    <!-- Steps Section -->
    <section class="steps-section bg-light" id="proses">
        <div class="container">
            <div class="row text-center mb-4">
                <div class="col">
                    <h2 class="fw-bold">Proses Pengaduan</h2>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="step-card">
                        <img src="/images/laporan.gif" alt="Step 1">
                        <h5>Tulis Laporan</h5>
                        <p>Tulis laporan keluhan Anda dengan jelas.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card">
                        <img src="/images/verifikasi.gif" alt="Step 2">
                        <h5>Proses Verifikasi</h5>
                        <p>Laporan Anda akan diverifikasi oleh petugas.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card">
                        <img src="/images/tindak.gif" alt="Step 3">
                        <h5>Tindak Lanjut</h5>
                        <p>Laporan Anda sedang dalam tindak lanjut.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card">
                        <img src="/images/done.gif" alt="Step 4">
                        <h5>Selesai</h5>
                        <p>Laporan pengaduan telah selesai ditindak.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <!-- Map Section -->
        <section class="map-section py-5">
            <div class="container">
                <div class="row text-center mb-4">
                    <div class="col">
                        <h2 class="fw-bold">Lokasi Desa Ngaben Rejo</h2>
                        <p>Peta Kecamatan Grobogan dengan penandaan lokasi Desa Ngaben Rejo.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <!-- Map Embed -->
                        <div class="map-container" style="position:relative; overflow:hidden; height:500px;">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63213.52094748663!2d110.8414865!3d-7.0945577!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70b50a74ad543b%3A0x5d042a6b527dd769!2sNgaben%20Rejo%2C%20Grobogan%2C%20Central%20Java!5e0!3m2!1sen!2sid!4v1234567890123" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>            
        </section>

<!-- Leaflet.js CSS and JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>
