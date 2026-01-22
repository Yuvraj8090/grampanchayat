<x-app-layout title="Edit User">
    <x-slot name="header">
         {{ __('Edit User') }}
           
    </x-slot>

    <div class="container py-4">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header border-0 p-4 text-white" style="background: linear-gradient(to right, #6366f1, #a855f7);">
                <h5 class="mb-0 fw-bold">
                    <i class="fas fa-user me-2"></i> {{ __('User Details') }}
                </h5>
            </div>

            <div class="card-body p-4">
                @if (session('success'))
                    <div class="alert alert-success d-flex align-items-center mb-4 border-0 shadow-sm" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger mb-4 border-0 shadow-sm" role="alert">
                        <div class="fw-bold mb-2">
                            <i class="fas fa-exclamation-triangle me-2"></i> {{ __('There were some errors with your submission:') }}
                        </div>
                        <ul class="mb-0 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold text-secondary small">
                                <i class="fas fa-user me-1 text-primary"></i> {{ __('Name') }}
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                class="form-control @error('name') is-invalid @enderror" 
                                placeholder="Enter full name">
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold text-secondary small">
                                <i class="fas fa-envelope me-1 text-primary"></i> {{ __('Email Address') }}
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                class="form-control @error('email') is-invalid @enderror" 
                                placeholder="Enter email address">
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label fw-semibold text-secondary small">
                                <i class="fas fa-lock me-1 text-primary"></i> {{ __('New Password') }} 
                                <span class="text-muted fw-normal">({{ __('Leave blank to keep current') }})</span>
                            </label>
                           <input type="password" 
       name="password" 
       id="password"
       class="form-control @error('password') is-invalid @enderror" 
       placeholder="Enter new password"
       autocomplete="new-password">
                        </div>

                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label fw-semibold text-secondary small">
                                <i class="fas fa-lock me-1 text-primary"></i> {{ __('Confirm Password') }}
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" 
                                placeholder="Confirm new password">
                        </div>

                        <div class="col-md-6">
                            <label for="role_id" class="form-label fw-semibold text-secondary small">
                                <i class="fas fa-user-tag me-1 text-primary"></i> {{ __('Assigned Role') }}
                            </label>
                            <select name="role_id" id="role_id" class="form-select @error('role_id') is-invalid @enderror">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="last_service_date" class="form-label fw-semibold text-secondary small">
                                <i class="fas fa-calendar-alt me-1 text-primary"></i> {{ __('Last Service Date') }}
                            </label>
                            <input type="date" name="last_service_date" id="last_service_date" 
                                value="{{ old('last_service_date', $user->last_service_date?->format('Y-m-d')) }}"
                                class="form-control @error('last_service_date') is-invalid @enderror">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-light border px-4">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="btn btn-warning px-4 fw-bold shadow-sm">
                            <i class="fas fa-user-edit me-1"></i> {{ __('Update User') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>