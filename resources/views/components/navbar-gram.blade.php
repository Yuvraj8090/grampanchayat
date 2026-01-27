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
                    <div class="p-3 rounded">
                        <h2 class="mb-0 fw-bold text-dark" style="line-height: 1.2;">
                            {{ $panchayat->name }}
                        </h2>
                        <h5 class="text-secondary mb-0">
                            ब्लॉक: {{ $panchayat->block?->name ?? 'N/A' }} |
                            ज़िला: {{ $panchayat->block?->district?->name ?? 'N/A' }}
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
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.panchayat.show') ? 'active' : '' }}"
                            href="{{ route('public.panchayat.show', $panchayat->id) }}">
                            <i class="fas fa-home me-1"></i> होम
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.pradhan_message.show') ? 'active' : '' }}"
                            href="{{ route('public.pradhan_message.show', $panchayat->id) }}">
                            प्रधान संदेश
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.tourism.*') ? 'active' : '' }}" href="#">
                            पर्यटन स्थल
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.development.*') ? 'active' : '' }}"
                            href="#">
                            विकास कार्य
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.members.*') ? 'active' : '' }}"
                            href="#">
                            प्रतिनिधि मंडल
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.gallery.*') ? 'active' : '' }}"
                            href="#">
                            फोटो गैलरी
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.contact.*') ? 'active' : '' }}"
                            href="#">
                            संपर्क करें
                        </a>
                    </li>

                </ul>
                <div class="d-flex">
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Login</a>
                </div>
            </div>
        </div>
    </nav>