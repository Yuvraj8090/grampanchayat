<x-app-layout title="Panchayat Gallery - {{ $panchayat->name }}">
    <x-slot name="header">
        {{ __('Gallery Management') }}
    </x-slot>

    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 mb-0 text-dark">
                <i class="fas fa-images me-2 text-primary"></i> Gallery: {{ $panchayat->name }}
            </h2>
            <a href="{{ route('admin.panchayats.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
    <div class="card shadow-sm border-0 sticky-top" style="top: 20px; z-index: 1;">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-cloud-upload-alt me-2"></i> Upload Media
        </div>
        <div class="card-body">
            <form action="{{ route('admin.panchayats.gallery.store', $panchayat->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Media Type</label>
                    <select name="media_type" id="mediaTypeSelector" class="form-select">
                        <option value="image">Photo Gallery</option>
                        <option value="video">YouTube Video</option>
                    </select>
                </div>

                <div id="imageInputSection">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Select Images</label>
                        <input type="file" name="files[]" class="form-control" multiple accept="image/*">
                        <small class="text-muted d-block mt-1">Max size: 5MB per image.</small>
                    </div>
                </div>

                <div id="videoInputSection" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label fw-bold">YouTube Video URL</label>
                        <input type="text" name="video_url" class="form-control" placeholder="e.g. https://youtu.be/l8Jb5oHgDPg">
                        <small class="text-muted d-block mt-1">Supports share links and standard URLs.</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Caption</label>
                    <input type="text" name="caption" class="form-control" placeholder="Title for this media">
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="is_featured" id="uploadFeatured">
                    <label class="form-check-label" for="uploadFeatured">Mark as Featured</label>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-plus-circle me-1"></i> Add to Gallery
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selector = document.getElementById('mediaTypeSelector');
        const imageSection = document.getElementById('imageInputSection');
        const videoSection = document.getElementById('videoInputSection');

        selector.addEventListener('change', function() {
            if (this.value === 'video') {
                imageSection.style.display = 'none';
                videoSection.style.display = 'block';
            } else {
                imageSection.style.display = 'block';
                videoSection.style.display = 'none';
            }
        });
    });
</script>

            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-dark"><i class="fas fa-list me-2"></i> Uploaded Photos</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-3">
                            <x-datatable :route="route('admin.panchayats.gallery.index', $panchayat->id)" :columns="[
                                [
                                    'data' => 'DT_RowIndex',
                                    'title' => '#',
                                    'orderable' => false,
                                    'searchable' => false,
                                    'width' => '5%',
                                ],
                                [
                                    'data' => 'media_display',
                                    'title' => 'Preview',
                                    'orderable' => false,
                                    'searchable' => false,
                                ],
                                ['data' => 'caption', 'title' => 'Caption'],
                                ['data' => 'featured_status', 'title' => 'Status'],
                                [
                                    'data' => 'action',
                                    'title' => 'Actions',
                                    'orderable' => false,
                                    'searchable' => false,
                                    'class' => 'text-end',
                                ],
                            ]" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editGalleryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editGalleryForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title fw-bold"><i class="fas fa-edit me-2"></i> Edit Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Caption</label>
                            <input type="text" name="caption" id="modalCaption" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold d-block">Display Status</label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="status" id="modalStandard"
                                    value="standard">
                                <label class="btn btn-outline-secondary" for="modalStandard">Standard</label>

                                <input type="radio" class="btn-check" name="status" id="modalFeatured"
                                    value="featured">
                                <label class="btn btn-outline-warning" for="modalFeatured"><i
                                        class="fas fa-star me-1"></i> Featured</label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script type="module">
        document.addEventListener('DOMContentLoaded', function() {
            var editModal = document.getElementById('editGalleryModal');

            editModal.addEventListener('show.bs.modal', function(event) {
                // Button that triggered the modal
                var button = event.relatedTarget;

                // Extract info from data-* attributes
                var url = button.getAttribute('data-url');
                var caption = button.getAttribute('data-caption');
                var isFeatured = button.getAttribute('data-featured'); // "1" or "0"

                // Update Form Action URL
                var form = document.getElementById('editGalleryForm');
                form.action = url;

                // Fill Inputs
                document.getElementById('modalCaption').value = caption;

                // Set Radio Buttons
                if (isFeatured == "1") {
                    document.getElementById('modalFeatured').checked = true;
                } else {
                    document.getElementById('modalStandard').checked = true;
                }
            });
        });
    </script>

</x-app-layout>
