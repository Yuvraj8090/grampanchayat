<x-app-layout title="Edit User">
    <x-slot name="header">
        {{ __('Edit User Account') }}
    </x-slot>

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 mb-0 text-dark">
                <i class="fas fa-user-edit me-2 text-primary"></i> Edit: <span class="text-muted">{{ $user->name }}</span>
            </h2>
            <div class="btn-group shadow-sm">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back to List
                </a>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="mb-0 card-title">Update Information</h5>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-bold text-secondary">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                                   class="form-control @error('name') is-invalid @enderror" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label fw-bold text-secondary">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                                   class="form-control @error('email') is-invalid @enderror" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="role_id" class="form-label fw-bold text-secondary">Assigned Role</label>
                            <select name="role_id" id="role_id" class="form-select @error('role_id') is-invalid @enderror">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label fw-bold text-secondary">New Password <span class="fw-normal text-muted">(Leave blank to keep current)</span></label>
                            <input type="password" name="password" id="password" autocomplete="new-password"
                                   class="form-control @error('password') is-invalid @enderror" placeholder="Enter new password">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label fw-bold text-secondary">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                   class="form-control" placeholder="Re-type new password">
                        </div>

                        <div class="col-12 mt-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-light border px-4">Cancel</a>
                                <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                    <i class="fas fa-save me-1"></i> Update User
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>