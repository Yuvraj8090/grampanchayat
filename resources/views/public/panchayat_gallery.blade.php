<x-guest-layout>
    <x-slot name="header">
        {{ $panchayat->name }} - {{ $pageTitle }}
    </x-slot>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    <x-navbar-gram :panchayat="$panchayat" />

    <div class="news-ticker">
        <div class="container d-flex align-items-center">
            <span class="ticker-title rounded shadow-sm">ताज़ा ख़बरें</span>
            <marquee class="ms-3" onmouseover="this.stop();" onmouseout="this.start();">
                <i class="fas fa-bullhorn text-warning me-2"></i> ग्राम पंचायत की नई गैलरी अपडेट कर दी गई है।
            </marquee>
        </div>
    </div>

    <div class="container my-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        
                        <div class="col-12 text-center mb-5">
                            <div class="d-inline-block px-4 py-2 bg-warning text-white fw-bold rounded-end shadow-sm mb-3"
                                style="background: linear-gradient(90deg, #ff8c00 0%, #ffae42 100%); border-bottom-right-radius: 50px !important; position: relative; left: -20px;">
                                {{ $pageTitle }}
                            </div>
                            <h2 class="fw-bold text-dark">ग्राम पंचायत की झलकियाँ</h2>
                            <p class="text-muted">{{ $pageDesc }}</p>
                        </div>

                        <div class="row g-3">
                            @forelse($galleries as $item)
                                <div class="col-6 col-md-4">
                                    <div class="gallery-item position-relative overflow-hidden rounded shadow-sm border">
                                        
                                        @if($item->type === 'video')
                                            {{-- VIDEO: Shows YouTube Thumb, Opens Video in Iframe Lightbox --}}
                                            <a href="https://www.youtube.com/watch?v={{ $item->path }}" 
                                               data-fancybox="gallery" 
                                               data-caption="{{ $item->caption ?? 'Video' }}">
                                                
                                                <img src="https://img.youtube.com/vi/{{ $item->path }}/mqdefault.jpg" 
                                                     class="img-fluid w-100 gallery-img" 
                                                     style="height: 200px; object-fit: cover;"
                                                     loading="lazy" 
                                                     alt="Video Thumbnail">
                                                
                                                <div class="gallery-overlay d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-play-circle text-white fa-3x opacity-75 drop-shadow"></i>
                                                </div>
                                            </a>
                                        @else
                                            {{-- IMAGE: Shows Image, Opens Image in Lightbox --}}
                                            <a href="{{ asset('storage/' . $item->path) }}" 
                                               data-fancybox="gallery" 
                                               data-caption="{{ $item->caption ?? 'Panchayat Image' }}">
                                                
                                                <img src="{{ asset('storage/' . $item->path) }}" 
                                                     class="img-fluid w-100 gallery-img" 
                                                     style="height: 200px; object-fit: cover;"
                                                     loading="lazy" 
                                                     alt="Gallery Image">
                                                
                                                <div class="gallery-overlay d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-search-plus text-white fa-2x drop-shadow"></i>
                                                </div>
                                            </a>
                                        @endif
                                        
                                    </div>
                                    
                                    @if($item->caption)
                                        <div class="text-center mt-1">
                                            <small class="text-muted fw-bold">{{ Str::limit($item->caption, 25) }}</small>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="col-12 text-center py-5">
                                    <div class="p-4 bg-light rounded border border-dashed">
                                        <i class="fas fa-images fa-3x text-muted mb-2"></i>
                                        <p class="mb-0 text-muted">इस श्रेणी में अभी कोई डेटा उपलब्ध नहीं है।</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <div class="d-flex justify-content-center mt-5">
                            {{ $galleries->links('pagination::bootstrap-5') }}
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
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Fancybox.bind('[data-fancybox="gallery"]', {
                Thumbs : { type: "modern" },
                Toolbar: { display: { left: ["infobar"], middle: [], right: ["slideshow", "thumbs", "close"] } },
                Html: { video: { autoplay: true } }
            });
        });
    </script>

    <style>
        .gallery-item { cursor: pointer; transition: transform 0.3s ease; }
        .gallery-item:hover { transform: translateY(-2px); }
        .gallery-item:hover .gallery-img { transform: scale(1.05); transition: transform 0.5s ease; }
        .gallery-overlay { position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.4); opacity: 0; transition: opacity 0.3s ease; }
        .gallery-item:hover .gallery-overlay { opacity: 1; }
        .drop-shadow { text-shadow: 0 2px 4px rgba(0,0,0,0.5); }
        .page-item.active .page-link { background-color: #ff8c00; border-color: #ff8c00; }
        .page-link { color: #333; }
    </style>
</x-guest-layout>