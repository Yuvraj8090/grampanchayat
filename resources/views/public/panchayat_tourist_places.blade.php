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
        <div class="row mb-5">
            <div class="col-12 text-center">
                <div class="d-inline-block px-4 py-2 bg-warning text-white fw-bold rounded-end shadow-sm mb-3"
                    style="background: linear-gradient(90deg, #ff8c00 0%, #ffae42 100%); border-bottom-right-radius: 50px !important; position: relative; left: -20px;">
                    ग्राम पंचायत के मुख्य स्थल और पर्यटक स्थल
                </div>

                <h2 class="fw-bold text-dark mb-4">ग्राम पंचायत के मुख्य स्थल और पर्यटक स्थल</h2>

                <p class="text-muted text-center mx-auto" style="max-width: 900px; line-height: 1.8;">
                    उत्तराखंड, उत्तर भारत में स्थित एक बहुत ही खूबसूरत और शांत पर्यटन केंद्र है। इस जगह का शुमार देश की
                    उन चुनिन्दा जगहों में है जो अपनी सुन्दरता के चलते दुनिया भर के पर्यटकों को अपनी ओर आकर्षित करती है।
                    'देवताओं की भूमि' के रूप में जाना जाने वाला उत्तराखंड अपने शांत वातावरण, मनमोहक दृश्यों और खूबसूरती
                    के कारण पृथ्वी का स्वर्ग माना जाता है।
                </p>
            </div>
        </div>

        <div class="row g-5">
            @forelse($panchayat->places as $place)
                <div class="col-12 mb-4">
                    <div class="row align-items-start place-row">
                        <div class="col-md-3">
                            <div class="place-img-container shadow-sm border p-2 bg-white rounded">
                                @if ($place->photo)
                                    <img src="{{ asset('storage/' . $place->photo) }}" class="img-fluid rounded w-100"
                                        style="height: 180px; object-fit: cover;" alt="{{ $place->title }}">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center rounded"
                                        style="height: 180px;">
                                        <i class="fas fa-mountain fa-3x text-muted"></i>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="place-title-banner px-4 py-2 text-white fw-bold mb-3 d-inline-block w-75 shadow-sm"
                                style="background: #0084ff; border-radius: 0 50px 50px 0; font-size: 1.25rem;">
                                {{ $place->title }}
                            </div>

                            <div class="place-description text-dark mt-2"
                                style="line-height: 1.7; text-align: justify;">
                                @if ($place->address)
                                    <div class="mb-1 text-primary small fw-bold">
                                        <i class="fas fa-map-marker-alt me-1"></i> {{ $place->address }}
                                    </div>
                                @endif
                                {!! $place->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="p-4 bg-light rounded border border-dashed">
                        <i class="fas fa-info-circle fa-2x text-muted mb-2"></i>
                        <p class="mb-0 text-muted">इस पंचायत के लिए अभी कोई पर्यटन स्थल नहीं जोड़े गए हैं।</p>
                    </div>
                </div>
            @endforelse
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
