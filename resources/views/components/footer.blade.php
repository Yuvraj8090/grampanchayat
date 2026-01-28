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