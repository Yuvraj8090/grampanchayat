<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="alert alert-success mb-4" role="alert">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email Field --}}
            <div class="mb-3">
                <x-label for="email" value="{{ __('Email') }}" />
                {{-- Removed 'block w-full' as the x-input component now has 'form-control' --}}
                <x-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            {{-- Password Field --}}
            <div class="mb-3">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" type="password" name="password" required autocomplete="current-password" />
            </div>

            {{-- Remember Me --}}
            <div class="mb-3 form-check">
                <x-checkbox id="remember_me" name="remember" />
                <label for="remember_me" class="form-check-label">
                    {{ __('Remember me') }}
                </label>
            </div>

            {{-- Footer Links & Button --}}
            <div class="d-flex align-items-center justify-content-end mt-4">
                @if (Route::has('password.request'))
                    <a class="text-decoration-none text-muted small" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>