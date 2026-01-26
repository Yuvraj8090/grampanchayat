<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h5 class="mb-1 text-dark">{{ __('Profile Information') }}</h5>
        <small class="text-muted">{{ __('Update your account\'s profile information and email address.') }}</small>
    </div>

    <div class="card-body p-4">
        <form wire:submit.prevent="updateProfileInformation">
            
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div x-data="{photoName: null, photoPreview: null}" class="mb-4">
                    <input type="file" id="photo" class="d-none"
                                wire:model.live="photo"
                                x-ref="photo"
                                x-on:change="
                                        photoName = $refs.photo.files[0].name;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            photoPreview = e.target.result;
                                        };
                                        reader.readAsDataURL($refs.photo.files[0]);
                                " />

                    <label for="photo" class="form-label fw-bold">{{ __('Photo') }}</label>

                    <div class="mt-2" x-show="! photoPreview">
                        <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" 
                             class="rounded-circle border" 
                             style="width: 80px; height: 80px; object-fit: cover;">
                    </div>

                    <div class="mt-2" x-show="photoPreview" style="display: none;">
                        <span class="d-block rounded-circle border"
                              x-bind:style="'background-image: url(\'' + photoPreview + '\'); background-size: cover; background-position: center; width: 80px; height: 80px;'">
                        </span>
                    </div>

                    <div class="mt-3">
                        <button type="button" class="btn btn-outline-secondary btn-sm me-2" x-on:click.prevent="$refs.photo.click()">
                            {{ __('Select A New Photo') }}
                        </button>

                        @if ($this->user->profile_photo_path)
                            <button type="button" class="btn btn-outline-danger btn-sm" wire:click="deleteProfilePhoto">
                                {{ __('Remove Photo') }}
                            </button>
                        @endif
                    </div>

                    @error('photo') 
                        <span class="text-danger small mt-1">{{ $message }}</span> 
                    @enderror
                </div>
            @endif

            <div class="mb-3">
                <label for="name" class="form-label fw-bold">{{ __('Name') }}</label>
                <input id="name" type="text" 
                       class="form-control @error('name') is-invalid @enderror" 
                       wire:model="state.name" 
                       required autocomplete="name">
                @error('name') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label fw-bold">{{ __('Email') }}</label>
                <input id="email" type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       wire:model="state.email" 
                       required autocomplete="username">
                @error('email') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                @enderror

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                    <div class="alert alert-warning mt-3 mb-0 p-2 small">
                        {{ __('Your email address is unverified.') }}

                        <button type="button" class="btn btn-link p-0 align-baseline" wire:click.prevent="sendEmailVerification">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </div>

                    @if ($this->verificationLinkSent)
                        <div class="text-success small mt-2 fw-bold">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </div>
                    @endif
                @endif
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

                <button type="submit" class="btn btn-dark px-4" wire:loading.attr="disabled" wire:target="photo">
                    <span wire:loading wire:target="photo" class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    {{ __('Save') }}
                </button>
            </div>
        </form>
    </div>
</div>