<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Role') }}
    </x-slot>

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 mb-0 text-dark">
                <i class="fas fa-edit me-2 text-primary"></i> Edit Role: <span class="text-muted">{{ $role->name }}</span>
            </h2>
            <div class="btn-group shadow-sm">
                
                <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back List
                </a>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="mb-0 card-title">Role Details</h5>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label for="name" class="form-label fw-bold text-secondary">Role Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name', $role->name) }}" 
                                   class="form-control form-control-lg @error('name') is-invalid @enderror"
                                   placeholder="Enter role name (e.g. Admin)"
                                   required>
                            
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="col-md-12">
                            <label for="description" class="form-label fw-bold text-secondary">Description</label>
                            <textarea name="description" 
                                      id="description" 
                                      rows="4"
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Briefly describe what this role is for...">{{ old('description', $role->description) }}</textarea>
                            
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-text">Provide a short description to help identify this role later.</div>
                        </div>

                        <div class="col-12 mt-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.roles.index') }}" class="btn btn-light border px-4">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                    <i class="fas fa-save me-1"></i> Update Role
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>