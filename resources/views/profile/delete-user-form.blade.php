<div class="card shadow-sm border-0 border-start border-danger border-4">
    <div class="card-header bg-white py-3">
        <h5 class="mb-1 text-danger fw-bold">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ __('Delete Account') }}
        </h5>
        <small class="text-muted">{{ __('Permanently delete your account.') }}</small>
    </div>

    <div class="card-body p-4">
        <div class="text-muted small mb-4">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </div>

        <div class="mt-3">
            <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Delete Account') }}
            </x-danger-button>
        </div>

        <x-dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">
                <span class="text-danger">{{ __('Delete Account') }}</span>
            </x-slot>

            <x-slot name="content">
                <p class="text-muted small">
                    {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <label class="form-label small fw-bold text-secondary">{{ __('Confirm Password') }}</label>
                    <input type="password" 
                           class="form-control w-75 @error('password') is-invalid @enderror"
                           autocomplete="current-password"
                           placeholder="{{ __('Password') }}"
                           x-ref="password"
                           wire:model="password"
                           wire:keydown.enter="deleteUser" />

                    @error('password')
                        <div class="invalid-feedback mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-2" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </div>
</div>