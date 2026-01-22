<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h5 class="mb-1 text-dark">{{ __('Browser Sessions') }}</h5>
        <small class="text-muted">{{ __('Manage and log out your active sessions on other browsers and devices.') }}</small>
    </div>

    <div class="card-body p-4">
        <div class="text-muted small mb-4">
            {{ __('If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.') }}
        </div>

        @if (count($this->sessions) > 0)
            <div class="mt-4">
                @foreach ($this->sessions as $session)
                    <div class="d-flex align-items-center p-3 mb-2 bg-light rounded border">
                        <div class="text-secondary">
                            @if ($session->agent->isDesktop())
                                <i class="fa-solid fa-desktop fa-2x"></i>
                            @else
                                <i class="fa-solid fa-mobile-screen-button fa-2x"></i>
                            @endif
                        </div>

                        <div class="ms-3">
                            <div class="fw-bold text-dark small">
                                {{ $session->agent->platform() ? $session->agent->platform() : __('Unknown') }} - {{ $session->agent->browser() ? $session->agent->browser() : __('Unknown') }}
                            </div>

                            <div class="text-muted small">
                                {{ $session->ip_address }},

                                @if ($session->is_current_device)
                                    <span class="text-success fw-bold">{{ __('This device') }}</span>
                                @else
                                    {{ __('Last active') }} {{ $session->last_active }}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="d-flex align-items-center mt-4">
            <button class="btn btn-dark" wire:click="confirmLogout" wire:loading.attr="disabled">
                {{ __('Log Out Other Browser Sessions') }}
            </button>

            <span class="text-success ms-3 small fw-bold" 
                  x-data="{ shown: false, timeout: null }"
                  x-init="@this.on('loggedOut', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000); })"
                  x-show="shown" 
                  style="display: none;">
                {{ __('Done.') }}
            </span>
        </div>

        <div class="modal fade @if($confirmingLogout) show @endif" 
             id="logoutModal" 
             tabindex="-1" 
             style="@if($confirmingLogout) display: block; background: rgba(0,0,0,0.5); @else display: none; @endif"
             role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header border-bottom-0 p-4 pb-0">
                        <h5 class="modal-title fw-bold">{{ __('Log Out Other Browser Sessions') }}</h5>
                        <button type="button" class="btn-close" wire:click="$toggle('confirmingLogout')" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <p class="text-muted small">
                            {{ __('Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices.') }}
                        </p>

                        <div class="mt-3" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="{{ __('Password') }}"
                                   x-ref="password"
                                   wire:model="password"
                                   wire:keydown.enter="logoutOtherBrowserSessions" />
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 p-4 pt-0">
                        <button type="button" class="btn btn-light border" wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </button>
                        <button type="button" class="btn btn-dark ms-2"
                                    wire:click="logoutOtherBrowserSessions"
                                    wire:loading.attr="disabled">
                            {{ __('Log Out Other Sessions') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>