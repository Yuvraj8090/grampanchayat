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


        <div class="row g-5">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <div class="col-12 text-center">
                            <div class="d-inline-block px-4 py-2 bg-warning text-white fw-bold rounded-end shadow-sm mb-3"
                                style="background: linear-gradient(90deg, #ff8c00 0%, #ffae42 100%); border-bottom-right-radius: 50px !important; position: relative; left: -20px;">
                                ग्राम पंचायत में चल रहे मुख्य व्यवसाय
                            </div>

                           

                            <p class="text-muted text-center mx-auto" style="max-width: 900px; line-height: 1.8;">
                                उत्तराखंड, उत्तर भारत में स्थित एक बहुत ही खूबसूरत और शांत पर्यटन केंद्र है । इस जगह का शुमार देश की उन चुनिन्दा जगहों में है जोअपनी सुन्दरता के चलते दुनिया भर के पर्यटकों को अपनी ओर आकर्षित करती है।  'देवताओं की भूमि' के रूप में जाना जाने वाला उत्तराखंड अपने शांत वातावरण, मनमोहक दृश्यों और खूबसूरती के कारण पृथ्वी का स्वर्ग माना जाता है।
                            </p>
                        </div>
                        @forelse($panchayat->businesses as $business)

                            <div class="col-12 mb-4">
                                <div class="row align-items-start place-row">
                                    <div class="col-md-3">
                                        <div class="place-img-container shadow-sm border p-2 bg-white rounded">
                                            @if ($business->image)
                                                <img src="{{ asset('storage/' . $business->image) }}"
                                                    class="img-fluid rounded w-100"
                                                    style="height: 180px; object-fit: cover;" alt="{{ $business->title }}">
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
                                            {{ $business->title }}
                                        </div>

                                        <div class="place-description text-dark mt-2"
                                            style="line-height: 1.7; text-align: justify;">
                                            
                                            {!! $business->description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <div class="p-4 bg-light rounded border border-dashed">
                                    <i class="fas fa-info-circle fa-2x text-muted mb-2"></i>
                                    <p class="mb-0 text-muted">इस पंचायत के लिए अभी कोई पर्यटन स्थल नहीं जोड़े गए हैं।
                                    </p>
                                </div>
                            </div>
                        @endforelse
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


    <x-footer :panchayat="$panchayat" :details="$details" />

</x-guest-layout>
