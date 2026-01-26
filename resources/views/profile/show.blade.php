<x-app-layout title="Profile">
    <x-slot name="header">
        {{ __('Profile') }}
    </x-slot>

    <div class="container py-2">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    <div class="mb-5">
                        @livewire('profile.update-profile-information-form')
                    </div>
                    
                    <hr class="my-5 text-muted border-2 opacity-25">
                @endif

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <div class="mb-5">
                        @livewire('profile.update-password-form')
                    </div>

                    <hr class="my-5 text-muted border-2 opacity-25">
                @endif

                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <div class="mb-5">
                        @livewire('profile.two-factor-authentication-form')
                    </div>

                    <hr class="my-5 text-muted border-2 opacity-25">
                @endif

                <div class="mb-5">
                    @livewire('profile.logout-other-browser-sessions-form')
                </div>

                @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                    <hr class="my-5 text-muted border-2 opacity-25">

                    <div class="mb-5">
                        @livewire('profile.delete-user-form')
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>