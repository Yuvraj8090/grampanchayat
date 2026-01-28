<x-guest-layout>
    <x-slot name="header">
        {{ $panchayat->name }} - पंचायत सदस्य
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
                                उत्तराखंड, उत्तर भारत में स्थित एक बहुत ही खूबसूरत और शांत पर्यटन केंद्र है । इस जगह का
                                शुमार देश की उन चुनिन्दा जगहों में है जोअपनी सुन्दरता के चलते दुनिया भर के पर्यटकों को
                                अपनी ओर आकर्षित करती है। 'देवताओं की भूमि' के रूप में जाना जाने वाला उत्तराखंड अपने शांत
                                वातावरण, मनमोहक दृश्यों और खूबसूरती के कारण पृथ्वी का स्वर्ग माना जाता है।
                            </p>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light text-dark">
                                    <tr>
                                        <th class="ps-4" style="width: 90px;">क्रमांक</th>
                                        <th class="ps-4">फोटो</th>
                                        <th>पूरा नाम</th>
                                        <th>पद का नाम</th>
                                        <th class="text-center">वार्ड संख्या</th>
                                        <th class="text-center">संपर्क सूत्र</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($members as $member)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-bold text-dark text-capitalize">#{{ $member->order_by }}
                                            </div>

                                        </td>
                                        <td>
                                            @if($member->image)
                                            <img src="{{ asset('storage/' . $member->image) }}"
                                                class="rounded-circle border shadow-sm"
                                                style="width: 55px; height: 55px; object-fit: cover;"
                                                alt="{{ $member->name }}">
                                            @else
                                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center border"
                                                style="width: 55px; height: 55px;">
                                                <i class="fas fa-user text-muted"></i>
                                            </div>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="fw-bold text-dark text-capitalize">{{ $member->name }}</div>

                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-soft-primary text-primary border border-primary px-3 py-2 rounded-pill">
                                                {{ $member->designation }}
                                            </span>
                                        </td>
                                        <td class="text-center fw-bold text-primary">
                                            {{ $member->ward_no ?? 'उपलब्ध नहीं' }}
                                        </td>
                                        <td class="text-center">
                                            @if($member->phone)
                                            <a href="tel:{{ $member->phone }}"
                                                class="btn btn-sm btn-outline-success rounded-pill px-3">
                                                <i class="fas fa-phone-alt me-1"></i> {{ $member->phone }}
                                            </a>
                                            @else
                                            <span class="badge bg-light text-muted fw-normal">उपलब्ध नहीं</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-users-slash fa-3x mb-3 text-light"></i>
                                                <h6 class="fw-bold">कोई डेटा उपलब्ध नहीं है</h6>
                                                <p class="small">वर्तमान में इस ग्राम पंचायत के लिए कोई सक्रिय सदस्य
                                                    सूची नहीं मिली।</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
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


    <div class="row mt-5">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 bg-warning text-dark">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-info-circle fa-3x opacity-25 me-4"></i>
                    <div>
                        <h5 class="fw-bold mb-1">शिकायत निवारण</h5>
                        <p class="mb-0 small">पंचायत संबंधी किसी भी शिकायत के लिए संबंधित वार्ड सदस्य या सचिव से
                            संपर्क करें।</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 bg-dark text-white">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-clock fa-3x opacity-25 me-4"></i>
                    <div>
                        <h5 class="fw-bold mb-1">कार्यालय समय</h5>
                        <p class="mb-0 small">सोमवार - शनिवार: सुबह 10:00 बजे से शाम 05:00 बजे तक</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <style>
        .bg-soft-primary {
            background-color: #e7f1ff;
        }

        .table thead th {
            border-top: none;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .rounded-4 {
            border-radius: 1rem !important;
        }
    </style>

    <x-footer :panchayat="$panchayat" :details="$details" />
</x-guest-layout>