<x-app-layout title="Create User">
    <x-slot name="header">
        {{ __('Create New User') }}
    </x-slot>

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 mb-0 text-dark">
                <i class="fas fa-user-plus me-2 text-primary"></i> Add User
            </h2>
            <div class="btn-group shadow-sm">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back to List
                </a>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="mb-0 card-title">Account Details</h5>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-bold text-secondary">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                   class="form-control @error('name') is-invalid @enderror" required placeholder="Enter full name">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label fw-bold text-secondary">Email Address <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" 
                                   class="form-control @error('email') is-invalid @enderror" required placeholder="name@example.com">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="role_id" class="form-label fw-bold text-secondary">Assigned Role <span class="text-danger">*</span></label>
                            <select name="role_id" id="role_id" class="form-select @error('role_id') is-invalid @enderror" required>
                                <option value="" selected disabled>Choose a role...</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label fw-bold text-secondary">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="password" 
                                   class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password" placeholder="Minimum 8 characters">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label fw-bold text-secondary">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                   class="form-control" required placeholder="Re-enter password">
                        </div>

                        <div class="col-12 mt-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-light border px-4">Cancel</a>
                                <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                    <i class="fas fa-save me-1"></i> Create User
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>