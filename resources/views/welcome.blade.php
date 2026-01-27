<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @if (isset($header) && $header)
        {{ $header }} - {{ 'Gram Panchayat Admin' }}
        @else
        Gram Panchayat Admin
        @endif
    </title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .hero-section {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            color: white;
            padding: 100px 0;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }
        .feature-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">
                <i class="fas fa-building me-2"></i> Panchayat<span class="text-dark">MIS</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-sm px-4 rounded-pill">
                                    <i class="fas fa-tachometer-alt me-2"></i>Go to Dashboard
                                </a>
                            </li>
                        @else
                            <li class="nav-item me-2">
                                <a href="{{ route('login') }}" class="nav-link fw-semibold text-dark">Log in</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm px-4 rounded-pill">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-3">Panchayati Raj Management System</h1>
                    <p class="lead mb-5 opacity-75">
                        A centralized digital platform to manage Districts, Blocks, and Gram Panchayats efficiently. 
                        Empowering governance through data transparency.
                    </p>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-light btn-lg px-5 text-primary fw-bold shadow">
                            Access Portal
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-light btn-lg px-5 text-primary fw-bold shadow">
                            Login to Continue
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="fw-bold text-secondary">Administrative Structure</h2>
                    <p class="text-muted">Organized hierarchical data management</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-top">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-primary bg-opacity-10 text-primary mx-auto">
                                <i class="fas fa-map"></i>
                            </div>
                            <h5 class="card-title fw-bold mt-3">Districts</h5>
                            <p class="card-text text-muted small">
                                Manage Zila Parishad level data. Oversee all blocks and development activities within the district boundaries.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-top">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-success bg-opacity-10 text-success mx-auto">
                                <i class="fas fa-layer-group"></i>
                            </div>
                            <h5 class="card-title fw-bold mt-3">Blocks</h5>
                            <p class="card-text text-muted small">
                                Intermediate Panchayat Samiti level. Connects the district administration to the village panchayats.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-top">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-warning bg-opacity-10 text-warning mx-auto">
                                <i class="fas fa-landmark"></i>
                            </div>
                            <h5 class="card-title fw-bold mt-3">Gram Panchayats</h5>
                            <p class="card-text text-muted small">
                                The foundational unit of local self-government. Manage village-specific data, IDs, and statuses.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-white py-4 mt-auto border-top">
        <div class="container text-center">
            <p class="text-muted small mb-0">
                &copy; {{ date('Y') }} <strong>Panchayat MIS</strong>. All rights reserved. <br>
                Designed for Administrative Governance.
            </p>
        </div>
    </footer>

  
</body>
</html>