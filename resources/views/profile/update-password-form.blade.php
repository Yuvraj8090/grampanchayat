<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h5 class="mb-1 text-dark">{{ __('Update Password') }}</h5>
        <small class="text-muted">{{ __('Ensure your account is using a long, random password to stay secure.') }}</small>
    </div>

    <div class="card-body p-4">
        <form wire:submit.prevent="updatePassword">
            
            <div class="mb-3">
                <label for="current_password" class="form-label fw-bold">{{ __('Current Password') }}</label>
                <input id="current_password" type="password" 
                       class="form-control @error('current_password') is-invalid @enderror" 
                       wire:model="state.current_password" 
                       autocomplete="current-password">
                @error('current_password') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-bold">{{ __('New Password') }}</label>
                <input id="password" type="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       wire:model="state.password" 
                       autocomplete="new-password">
                @error('password') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label fw-bold">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" type="password" 
                       class="form-control @error('password_confirmation') is-invalid @enderror" 
                       wire:model="state.password_confirmation" 
                       autocomplete="new-password">
                @error('password_confirmation') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                @enderror
            </div>

            <div class="d-flex align-items-center justify-content-end mt-4">
                <span x-data="{ shown: false, timeout: null }"
                      x-init="@this.on('saved', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000); })"
                      x-show.transition.out.opacity.duration.1500ms="shown"
                      x-transition:leave.opacity.duration.1500ms
                      style="display: none;"
                      class="text-success me-3 small fw-bold">
                    {{ __('Saved.') }}
                </span>

                <button type="submit" class="btn btn-dark px-4">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
    </div>
</div>