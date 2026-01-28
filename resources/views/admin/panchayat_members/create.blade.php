<x-app-layout title="Add Panchayat Member">
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                        <h5 class="mb-0 text-primary fw-bold">
                            <i class="fas fa-user-plus me-2"></i> सदस्य जोड़ें: {{ $panchayat->name }}
                        </h5>
                        <a href="{{ route('admin.panchayats.members.index', $panchayat->id) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> वापस जाएं
                        </a>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('admin.panchayats.members.store', $panchayat->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row g-4">
                                <div class="col-md-7">
                                    <label class="form-label fw-bold">सदस्य का नाम (Full Name) <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control text-capitalize" placeholder="नाम लिखें" required>
                                </div>

                                <div class="col-md-5">
                                    <label class="form-label fw-bold">पद (Designation) <span class="text-danger">*</span></label>
                                    <select name="designation" class="form-select" required>
                                        <option value="">पद चुनें</option>
                                        <option value="Gram Pradhan">ग्राम प्रधान</option>
                                        <option value="Up-Pradhan">उप-प्रधान</option>
                                        <option value="Ward Member">वार्ड सदस्य</option>
                                        <option value="Panchayat Secretary">पंचायत सचिव</option>
                                        <option value="Gram Rozgar Sahayak">ग्राम रोजगार सहायक</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-bold">वार्ड संख्या (Ward No.)</label>
                                    <input type="text" name="ward_no" class="form-control" placeholder="वार्ड नंबर">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-bold">फ़ोन नंबर (Phone)</label>
                                    <input type="text" name="phone" class="form-control" placeholder="मोबाइल नंबर">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-bold">क्रम संख्या (Sort Order)</label>
                                    <input type="number" name="order_by" class="form-control" value="0" min="0">
                                    <small class="text-muted">दिखाने का क्रम (0 सबसे ऊपर)</small>
                                </div>

                                <div class="col-md-8">
                                    <label class="form-label fw-bold">फोटो (Member Photo)</label>
                                    <input type="file" name="photo" class="form-control" accept="image/*">
                                    <small class="text-muted">Max 2MB (jpg, png, webp)</small>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-bold">स्थिति (Status)</label>
                                    <select name="status" class="form-select">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>

                                <div class="col-12 text-end mt-4 border-top pt-3">
                                    <button type="submit" class="btn btn-primary px-5 shadow-sm">
                                        <i class="fas fa-save me-1"></i> सदस्य सुरक्षित करें
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