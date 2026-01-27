<x-guest-layout>
    <x-slot name="header">
        {{ $panchayat->name }}
    </x-slot>
   


    <x-navbar-gram :panchayat="$panchayat" />

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
                                <h3 class="text-primary fw-bold mb-3 border-bottom pb-2 d-inline-block">प्रधान संदेश
                                </h3>
                                <p class="text-muted text-justify">
                                    {!! $details->pradhan_message !!}
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

                            </div>
                        </div>
                    </div>
                </div>



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
                        <h4 class="fw-bold mb-0">{{ $details->contact_phone ?? 'Not Available' }}</h4>

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
                &copy; {{ date('Y') }} {{ $panchayat->name }}. Developed by <span class="text-warning">Yuvraj
                    Kohli</span>.
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

</x-guest-layout>
