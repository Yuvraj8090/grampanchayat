<x-app-layout title="Add New Business">
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-primary"><i class="fas fa-plus-circle me-2"></i> Add New Business to {{ $panchayat->name }}</h5>
                        <a href="{{ route('admin.panchayats.businesses.index', $panchayat->id) }}" class="btn btn-sm btn-outline-secondary">Back</a>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('admin.panchayats.businesses.store', $panchayat->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-bold">Business Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" placeholder="e.g. Sharma Grocery, Tech Solutions" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Business Photo / Logo</label>
                                    <label class="form-label fw-bold">Update Photo</label>
<input type="file" name="photo" class="form-control" accept="image/*">

                                    <small class="text-muted">Max 2MB (jpg, png, webp)</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>

                                

                                <div class="col-12">
                                    <label class="form-label fw-bold">Description</label>
                                    <textarea name="description" class="form-control" rows="5" placeholder="What does this business do?"></textarea>
                                </div>

                                <div class="col-12 text-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fas fa-save me-1"></i> Save Business
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>