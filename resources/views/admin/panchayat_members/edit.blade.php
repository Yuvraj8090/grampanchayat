<x-app-layout title="Edit Panchayat Member">
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                        <h5 class="mb-0 text-primary fw-bold">
                            <i class="fas fa-user-edit me-2"></i> सदस्य विवरण संपादित करें: {{ $business->name }}
                        </h5>
                        <a href="{{ route('admin.panchayats.members.index', $panchayat->id) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> वापस जाएं
                        </a>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('admin.panchayats.members.update', [$panchayat->id, $business->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row g-4">
                                <div class="col-md-7">
                                    <label class="form-label fw-bold">सदस्य का नाम (Full Name) <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control text-capitalize" value="{{ $business->name }}" required>
                                </div>

                                <div class="col-md-5">
                                    <label class="form-label fw-bold">पद (Designation) <span class="text-danger">*</span></label>
                                    <select name="designation" class="form-select" required>
                                        <option value="Gram Pradhan" {{ $business->designation == 'Gram Pradhan' ? 'selected' : '' }}>ग्राम प्रधान</option>
                                        <option value="Up-Pradhan" {{ $business->designation == 'Up-Pradhan' ? 'selected' : '' }}>उप-प्रधान</option>
                                        <option value="Ward Member" {{ $business->designation == 'Ward Member' ? 'selected' : '' }}>वार्ड सदस्य</option>
                                        <option value="Panchayat Secretary" {{ $business->designation == 'Panchayat Secretary' ? 'selected' : '' }}>पंचायत सचिव</option>
                                        <option value="Gram Rozgar Sahayak" {{ $business->designation == 'Gram Rozgar Sahayak' ? 'selected' : '' }}>ग्राम रोजगार सहायक</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-bold">वार्ड संख्या (Ward No.)</label>
                                    <input type="text" name="ward_no" class="form-control" value="{{ $business->ward_no }}" placeholder="वार्ड नंबर">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-bold">फ़ोन नंबर (Phone)</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $business->phone }}" placeholder="मोबाइल नंबर">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-bold">क्रम संख्या (Sort Order)</label>
                                    <input type="number" name="order_by" class="form-control" value="{{ $business->order_by ?? 0 }}" min="0">
                                    <small class="text-muted">दिखाने का क्रम</small>
                                </div>

                                <div class="col-md-8">
                                    <label class="form-label fw-bold">फोटो बदलें (Change Photo)</label>
                                    <input type="file" name="photo" class="form-control" accept="image/*">
                                    <small class="text-muted">खाली छोड़ें यदि आप बदलना नहीं चाहते। (Max 2MB)</small>
                                </div>

                                <div class="col-md-4 text-center">
                                    <label class="form-label d-block fw-bold">वर्तमान फोटो</label>
                                    @if($business->image)
                                        <img src="{{ asset('storage/' . $business->image) }}" class="rounded shadow-sm border" width="80" height="80" style="object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded border d-inline-block text-center text-muted" style="width:80px; height:80px; line-height:80px;">
                                            <i class="fas fa-user fa-2x"></i>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-bold">स्थिति (Status)</label>
                                    <select name="status" class="form-select">
                                        <option value="active" {{ $business->status == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ $business->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                                <div class="col-12 text-end mt-4 border-top pt-3">
                                    <button type="submit" class="btn btn-success px-5 shadow-sm">
                                        <i class="fas fa-sync-alt me-1"></i> अपडेट करें (Update Member)
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