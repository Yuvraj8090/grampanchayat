<x-app-layout title="Edit Panchayat">
    <x-slot name="header">
        {{ __('Edit Panchayat') }}
    </x-slot>

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 mb-0 text-dark">
                <i class="fas fa-edit me-2 text-primary"></i> Edit Panchayat: {{ $panchayat->name }}
            </h2>
            <div class="btn-group shadow-sm">
                <a href="{{ route('admin.panchayats.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back to List
                </a>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="mb-0 card-title">Update Information</h5>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('admin.panchayats.update', $panchayat->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="block_id" class="form-label fw-bold text-secondary">Block <span class="text-danger">*</span></label>
                            <select name="block_id" id="block_id" class="form-select @error('block_id') is-invalid @enderror" required>
                                <option value="" disabled>Choose a block...</option>
                                @foreach($blocks as $block)
                                    <option value="{{ $block->id }}" {{ old('block_id', $panchayat->block_id) == $block->id ? 'selected' : '' }}>
                                        {{ $block->name }} ({{ $block->district->name ?? 'N/A' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('block_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="name" class="form-label fw-bold text-secondary">Panchayat Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name', $panchayat->name) }}" 
                                   class="form-control @error('name') is-invalid @enderror" required placeholder="Enter panchayat name">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="panchayat_id" class="form-label fw-bold text-secondary">Panchayat Code/ID <span class="text-danger">*</span></label>
                            <input type="text" name="panchayat_id" id="panchayat_id" value="{{ old('panchayat_id', $panchayat->panchayat_id) }}" 
                                   class="form-control @error('panchayat_id') is-invalid @enderror" required placeholder="Unique ID">
                            @error('panchayat_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="status" class="form-label fw-bold text-secondary">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="active" {{ old('status', $panchayat->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="pending" {{ old('status', $panchayat->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="suspended" {{ old('status', $panchayat->status) == 'suspended' ? 'selected' : '' }}>Suspended</option>
                            </select>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="vpo_name" class="form-label fw-bold text-secondary">VPO Name</label>
                            <input type="text" name="vpo_name" id="vpo_name" value="{{ old('vpo_name', $panchayat->vpo_name) }}" 
                                   class="form-control @error('vpo_name') is-invalid @enderror" placeholder="Village Panchayat Officer Name">
                            @error('vpo_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label for="address" class="form-label fw-bold text-secondary">Full Address</label>
                            <textarea name="address" id="address" rows="3" 
                                      class="form-control @error('address') is-invalid @enderror" placeholder="Enter complete address">{{ old('address', $panchayat->address) }}</textarea>
                            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 mt-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.panchayats.index') }}" class="btn btn-light border px-4">Cancel</a>
                                <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                    <i class="fas fa-save me-1"></i> Update Panchayat
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>