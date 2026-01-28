<x-app-layout title="Edit Panchayat Place">
    <div class="container-fluid py-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 text-dark">
                <i class="fas fa-map-marker-alt me-2 text-primary"></i> 
                Edit Place: {{ $place->title }} ({{ $panchayat->name }})
            </h2>
            <a href="{{ route('admin.panchayat.places.index', $panchayat->id) }}" class="btn btn-secondary">Back to List</a>
        </div>

        <form action="{{ route('admin.panchayat.places.update', [$panchayat->id, $place->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-primary text-white">Place Details</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Place Title (Name)</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $place->title) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control tinymce-editor" rows="10">{{ old('description', $place->description) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-success text-white">Media & Settings</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Place Photo</label>
                                <input type="file" name="photo" class="form-control">
                                @if($place->photo)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $place->photo) }}" class="img-fluid rounded border shadow-sm">
                                        <p class="small text-muted mt-1">Current Photo</p>
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Address / Specific Location</label>
                                <input type="text" name="address" class="form-control" value="{{ old('address', $place->address) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="active" {{ $place->status == 'active' ? 'selected' : '' }}>Visible on Website</option>
                                    <option value="inactive" {{ $place->status == 'inactive' ? 'selected' : '' }}>Hidden</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-save me-2"></i> Update Place
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            tinymce.init({
                selector: '.tinymce-editor',
                promotion: false,
                branding: false,
                menubar: false,
                plugins: 'link lists table code',
                toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright | bullist numlist | link table | code',
                setup: function (editor) {
                    editor.on('change', function () { editor.save(); });
                }
            });
        });
    </script>
</x-app-layout>