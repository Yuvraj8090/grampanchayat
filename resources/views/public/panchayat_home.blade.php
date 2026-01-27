<!DOCTYPE html>
<html lang="hi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $panchayat->name }} | Govt of Uttarakhand</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@400;500;700&family=Poppins:wght@400;600&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', 'Hind', sans-serif;
            background-color: #f8f9fa;
        }

        /* Top Bar */
        .top-bar {
            background: #f1f1f1;
            font-size: 0.85rem;
            border-bottom: 1px solid #ddd;
        }

        .accessibility-links a {
            color: #333;
            text-decoration: none;
            margin-left: 10px;
        }

        /* Branding Header */
        .brand-header {
            background: #fff;
            
            border-bottom: 4px solid #ff9933;
            /* Saffron Border */
        }

        .emblem {
            height: 60px;
        }

        /* Navigation */
        .navbar-custom {
            background: #1a4a8d;
            /* Govt Blue */
        }

        .navbar-custom .nav-link {
            color: #fff !important;
            font-weight: 500;
            padding: 12px 15px;
        }

        .navbar-custom .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ff9933 !important;
        }

        /* Marquee / Ticker */
        .news-ticker {
            background: #2c3e50;
            color: #fff;
            padding: 8px 0;
        }

        .ticker-title {
            background: #e74c3c;
            padding: 5px 15px;
            font-weight: bold;
            font-size: 0.9rem;
        }

        /* Hero Section */
        .pradhan-card {
            background: linear-gradient(135deg, #1a4a8d 0%, #2980b9 100%);
            color: white;
            border-radius: 10px;
        }

        /* Stat Cards */
        .stat-card {
            background: #fff;
            border-left: 4px solid #1a4a8d;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            font-size: 2rem;
            color: #ddd;
        }

        /* Sidebar Links */
        .sidebar-box {
            background: #fff;
            border: 1px solid #e9ecef;
            border-top: 3px solid #1a4a8d;
            margin-bottom: 20px;
        }

        .sidebar-title {
            background: #f1f1f1;
            padding: 10px 15px;
            font-weight: 700;
            color: #1a4a8d;
            border-bottom: 1px solid #ddd;
        }

        .sidebar-link {
            display: block;
            padding: 10px 15px;
            color: #444;
            text-decoration: none;
            border-bottom: 1px solid #f8f9fa;
            transition: all 0.2s;
        }

        .sidebar-link:hover {
            background: #e9ecef;
            color: #1a4a8d;
            padding-left: 20px;
        }

        .new-badge {
            font-size: 0.7rem;
            animation: blink 1s infinite;
        }

        @keyframes blink {
            50% {
                opacity: 0;
            }
        }

        /* Footer */
        .footer {
            background: #1b1b1b;
            color: #bbb;
            padding-top: 40px;
            border-top: 5px solid #138808;
            /* Green Border */
        }

        .footer a {
            color: #bbb;
            text-decoration: none;
        }

        .footer a:hover {
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="top-bar py-1 d-none d-md-block ">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="text-muted">
                <small><i class="fas fa-calendar-alt me-1"></i> <span id="currentDate"></span></small>
            </div>
            <div class="accessibility-links">
                <a href="#" class="small">Skip to Main Content</a>
                <a href="#" class="small">Screen Reader Access</a>
                <a href="#" class="fw-bold">A+</a>
                <a href="#" class="fw-bold">A-</a>
                <a href="#" class="badge bg-secondary text-white ms-2">English / हिंदी</a>
            </div>
        </div>
    </div>

    <header class="brand-header">
        <div class="container">
            <div class="row align-items-center"
                style="background: url('https://grampanchayat.org/images/back.jpg') no-repeat center center; 
            background-size: cover; 
            min-height: 150px;">

                <div class="col-md-9 d-flex align-items-center gap-3">
                    <div class="p-3 rounded" >
                        <h2 class="mb-0 fw-bold text-dark" style="line-height: 1.2;">{{ $panchayat->name }}</h2>
                        <h5 class="text-secondary mb-0">
                            Block: {{ $panchayat->block?->name ?? 'N/A' }} |
                            District: {{ $panchayat->block?->district?->name ?? 'N/A' }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-custom sticky-top shadow-sm">
        <div class="container">
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="#"><i class="fas fa-home me-1"></i>
                            होम</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">पंचायत परिचय</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">पर्यटन स्थल</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">विकास कार्य</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">प्रतिनिधि मंडल</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">फोटो गैलरी</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">संपर्क करें</a></li>
                </ul>
                <div class="d-flex">
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="news-ticker">
        <div class="container d-flex align-items-center">
            <span class="ticker-title rounded shadow-sm">ताज़ा ख़बरें</span>
            <marquee class="ms-3" onmouseover="this.stop();" onmouseout="this.start();">
                <i class="fas fa-bullhorn text-warning me-2"></i> प्रधानमंत्री आवास योजना की नई सूची जारी कर दी गई है।
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <i class="fas fa-bullhorn text-warning me-2"></i> 25 जनवरी को ग्राम सभा की बैठक पंचायत भवन में आयोजित की
                जाएगी। &nbsp;&nbsp;|&nbsp;&nbsp;
                <i class="fas fa-bullhorn text-warning me-2"></i> किसान सम्मान निधि की 16वीं किस्त जल्द जारी होगी।
            </marquee>
        </div>
    </div>

    <div class="container my-5">
        <div class="row g-4">

            <div class="col-lg-8">

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex flex-column flex-md-row gap-4 align-items-start">
                            <div class="flex-grow-1">
                                <h3 class="text-primary fw-bold mb-3 border-bottom pb-2 d-inline-block">ग्राम पंचायत में
                                    आपका स्वागत है</h3>
                                <p class="text-muted text-justify">
                                    {!! $details->about_text !!}
                                </p>
                            </div>

                            <div class="pradhan-card p-3 text-center shadow" style="min-width: 200px;">
                                @if ($details->pradhan_image)
                                    <img src="{{ asset('storage/' . $details->pradhan_image) }}"
                                        class="rounded-circle border border-3 border-white mb-2"
                                        style="width: 100px; height: 100px; object-fit: cover;">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($details->pradhan_name ?? 'Pradhan') }}&background=random"
                                        class="rounded-circle border border-3 border-white mb-2"
                                        style="width: 100px; height: 100px;">
                                @endif

                                <h6 class="fw-bold mb-0">{{ $details->pradhan_name ?? 'Pradhan Name' }}</h6>
                                <small class="d-block text-white-50">ग्राम प्रधान</small>
                                <div class="mt-2 text-warning small">
                                    <i class="fas fa-phone-alt"></i> {{ $details->pradhan_contact ?? 'N/A' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="mb-3 fw-bold text-secondary"><i class="fas fa-chart-pie me-2"></i> पंचायत सांख्यिकी
                    (Statistics)</h4>
                <div class="row g-3 mb-4">
                    <div class="col-md-4 col-6">
                        <div class="stat-card p-3 d-flex justify-content-between align-items-center rounded">
                            <div>
                                <h3 class="fw-bold text-primary mb-0">{{ $details->total_population ?? 0 }}</h3>
                                <small class="text-muted">कुल जनसंख्या</small>
                            </div>
                            <i class="fas fa-users stat-icon text-primary opacity-25"></i>
                        </div>
                    </div>

                    <div class="col-md-4 col-6">
                        <div class="stat-card p-3 d-flex justify-content-between align-items-center rounded">
                            <div>
                                <h3 class="fw-bold text-success mb-0">{{ $details->male_population ?? 0 }}</h3>
                                <small class="text-muted">पुरुष जनसंख्या</small>
                            </div>
                            <i class="fas fa-male stat-icon text-success opacity-25"></i>
                        </div>
                    </div>

                    <div class="col-md-4 col-6">
                        <div class="stat-card p-3 d-flex justify-content-between align-items-center rounded">
                            <div>
                                <h3 class="fw-bold text-info mb-0">{{ $details->female_population ?? 0 }}</h3>
                                <small class="text-muted">महिला जनसंख्या</small>
                            </div>
                            <i class="fas fa-female stat-icon text-info opacity-25"></i>
                        </div>
                    </div>

                    <div class="col-md-4 col-6">
                        <div class="stat-card p-3 d-flex justify-content-between align-items-center rounded">
                            <div>
                                <h3 class="fw-bold text-warning mb-0">{{ $details->literacy_rate ?? '0%' }}</h3>
                                <small class="text-muted">साक्षरता दर</small>
                            </div>
                            <i class="fas fa-book-reader stat-icon text-warning opacity-25"></i>
                        </div>
                    </div>

                    <div class="col-md-4 col-6">
                        <div class="stat-card p-3 d-flex justify-content-between align-items-center rounded">
                            <div>
                                <h3 class="fw-bold text-danger mb-0">{{ $details->total_families ?? 0 }}</h3>
                                <small class="text-muted">कुल परिवार</small>
                            </div>
                            <i class="fas fa-home stat-icon text-danger opacity-25"></i>
                        </div>
                    </div>

                    <div class="col-md-4 col-6">
                        <div class="stat-card p-3 d-flex justify-content-between align-items-center rounded">
                            <div>
                                <h3 class="fw-bold text-dark mb-0">{{ $details->sc_st_population ?? 0 }}</h3>
                                <small class="text-muted">SC/ST जनसंख्या</small>
                            </div>
                            <i class="fas fa-user-friends stat-icon text-dark opacity-25"></i>
                        </div>
                    </div>
                </div>

                @if ($details->video_url)
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white fw-bold"><i class="fas fa-video me-2"></i> वीडियो गैलरी</div>
                        <div class="card-body">
                            <div class="ratio ratio-16x9 rounded overflow-hidden">
                                <iframe src="{{ $details->video_url }}" title="Panchayat Video"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($details->map_embed_code)
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white fw-bold"><i class="fas fa-map-marker-alt me-2"></i> पंचायत का
                            नक्शा</div>
                        <div class="card-body p-0">
                            <div class="ratio ratio-21x9">
                                {!! $details->map_embed_code !!}
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            <div class="col-lg-4">

                <div class="sidebar-box shadow-sm rounded overflow-hidden">
                    <div class="sidebar-title">
                        <i class="fas fa-tasks me-2"></i> संचालित योजनाएं (Schemes)
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="#" class="sidebar-link">
                            <span class="badge bg-danger new-badge me-1">New</span>
                            प्रधानमंत्री आवास योजना आवेदन <i class="fas fa-external-link-alt float-end small mt-1"></i>
                        </a>
                        <a href="#" class="sidebar-link">प्रधानमंत्री ग्रामीण आवास योजना</a>
                        <a href="#" class="sidebar-link">फसल बीमा योजना (Agri Insurance)</a>
                        <a href="#" class="sidebar-link">स्वच्छ भारत मिशन (ग्रामीण)</a>
                        <a href="#" class="sidebar-link">मनरेगा कार्य सूची</a>
                    </div>
                </div>

                <div class="sidebar-box shadow-sm rounded overflow-hidden">
                    <div class="sidebar-title bg-light border-bottom">
                        <i class="fas fa-link me-2"></i> महत्वपूर्ण लिंक
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="#" class="sidebar-link">CM हेल्पलाइन (1905)</a>
                        <a href="#" class="sidebar-link">उत्तराखंड शासन (Govt of UK)</a>
                        <a href="#" class="sidebar-link">PMAY लाभार्थी सूची देखें</a>
                        <a href="#" class="sidebar-link">परिवार रजिस्टर नकल</a>
                    </div>
                </div>

                <div class="card shadow-sm border-0 bg-primary text-white">
                    <div class="card-body">
                        <h5 class="fw-bold"><i class="fas fa-headset me-2"></i> सहायता केंद्र</h5>
                        <p class="small mb-2">किसी भी समस्या के लिए संपर्क करें:</p>
                        <h4 class="fw-bold mb-0">{{ $details->pradhan_contact ?? 'Not Available' }}</h4>

                        @if ($details->contact_email)
                            <div class="mt-2 small"><i class="fas fa-envelope me-1"></i>
                                {{ $details->contact_email }}</div>
                        @endif

                        @if ($details->address)
                            <div class="mt-1 small text-white-50"><i class="fas fa-map-marker-alt me-1"></i>
                                {{ $details->address }}</div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container pb-4">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5 class="text-white mb-3 border-start border-4 border-warning ps-2">{{ $panchayat->name }}</h5>
                    <p class="small text-justify">
                        यह ग्राम पंचायत, उत्तराखंड सरकार के पंचायती राज अधिनियम के अंतर्गत कार्य करती है। हमारा लक्ष्य
                        गांव का सर्वांगीण विकास है।
                    </p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube fa-lg"></i></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <h6 class="text-white mb-3">त्वरित लिंक</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="#">मुख्य पृष्ठ</a></li>
                        <li class="mb-2"><a href="#">हमारे बारे में</a></li>
                        <li class="mb-2"><a href="#">सूचना का अधिकार</a></li>
                        <li class="mb-2"><a href="#">संपर्क विवरण</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="text-white mb-3">संपर्क करें</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2 text-warning"></i>
                            {{ $details->address ?? 'Panchayat Bhawan' }}</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2 text-warning"></i>
                            {{ $details->contact_email ?? 'N/A' }}</li>
                        <li class="mb-2"><i class="fas fa-phone me-2 text-warning"></i>
                            {{ $details->pradhan_contact ?? 'N/A' }}</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="text-white mb-3">लोकेशन</h6>
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                        style="height: 100px; overflow:hidden;">
                        @if ($details->map_embed_code)
                            {!! $details->map_embed_code !!}
                        @else
                            <span class="small">Google Map Not Available</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-black py-3 text-center small">
            <div class="container">
                &copy; {{ date('Y') }} {{ $panchayat->name }}. Developed by <span class="text-warning">Universal
                    Web Solutions</span>.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Set Current Date
        const dateOptions = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        document.getElementById('currentDate').textContent = new Date().toLocaleDateString('hi-IN', dateOptions);
    </script>
</body>

</html>
