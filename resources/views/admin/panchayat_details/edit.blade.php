<x-app-layout title="Update Website Details">
    <div class="container-fluid py-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 text-dark">
                <i class="fas fa-laptop-house me-2 text-primary"></i> 
                Edit Website: {{ $panchayat->name }}
            </h2>
            <a href="{{ route('admin.panchayats.index') }}" class="btn btn-secondary">Back</a>
        </div>

        <form action="{{ route('admin.panchayat.details.update', $panchayat->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row g-4">
                
                <div class="col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-primary text-white">Pradhan & Content</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Pradhan Name</label>
                                <input type="text" name="pradhan_name" class="form-control" value="{{ old('pradhan_name', $details->pradhan_name) }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Pradhan Personal Contact</label>
                                <input type="text" name="pradhan_contact" class="form-control" value="{{ old('pradhan_contact', $details->pradhan_contact) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Upload Photo</label>
                                <input type="file" name="pradhan_image" class="form-control">
                                @if($details->pradhan_image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $details->pradhan_image) }}" width="80" class="rounded border">
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Welcome Text (About Panchayat)</label>
                                <textarea name="about_text" class="form-control tinymce-editor" rows="4">{{ old('about_text', $details->about_text) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold text-primary">Pradhan's Message (Sandesh)</label>
                                <textarea name="pradhan_message" class="form-control tinymce-editor" rows="6">{{ old('pradhan_message', $details->pradhan_message) }}</textarea>
                                <small class="text-muted">Write the seasonal or monthly message to villagers here.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-success text-white">Population Statistics</div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label">Total Population</label>
                                    <input type="number" name="total_population" class="form-control" value="{{ old('total_population', $details->total_population) }}">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Literacy Rate (%)</label>
                                    <input type="text" name="literacy_rate" class="form-control" value="{{ old('literacy_rate', $details->literacy_rate) }}">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Male Population</label>
                                    <input type="number" name="male_population" class="form-control" value="{{ old('male_population', $details->male_population) }}">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Female Population</label>
                                    <input type="number" name="female_population" class="form-control" value="{{ old('female_population', $details->female_population) }}">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Total Families</label>
                                    <input type="number" name="total_families" class="form-control" value="{{ old('total_families', $details->total_families) }}">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">SC/ST Population</label>
                                    <input type="number" name="sc_st_population" class="form-control" value="{{ old('sc_st_population', $details->sc_st_population) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">Contact, Location & Media</div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Official Email</label>
                                    <input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', $details->contact_email) }}">
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label">Office Phone No.</label>
                                    <input type="text" name="contact_phone" class="form-control" value="{{ old('contact_phone', $details->contact_phone) }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Physical Address</label>
                                    <input type="text" name="address" class="form-control" value="{{ old('address', $details->address) }}">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">YouTube Video Embed URL</label>
                                    <input type="text" name="video_url" class="form-control" value="{{ old('video_url', $details->video_url) }}" placeholder="https://www.youtube.com/embed/...">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Google Map Embed Code (Iframe)</label>
                                    <textarea name="map_embed_code" class="form-control" rows="3" placeholder="<iframe src='https://www.google.com/maps/embed...'></iframe>">{{ old('map_embed_code', $details->map_embed_code) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary btn-lg px-5">
                        <i class="fas fa-save me-2"></i> Save Website Details
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            tinymce.init({
                selector: '.tinymce-editor', // This will apply to both About Text and Pradhan Message
                promotion: false,
                branding: false,
                menubar: false,
                plugins: 'link lists table code help',
                toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link table | code help',
                skin: 'oxide',
                content_css: 'default',
                setup: function (editor) {
                    editor.on('change', function () {
                        editor.save();
                    });
                }
            });
        });
    </script>
</x-app-layout>