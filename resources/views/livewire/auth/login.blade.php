<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

    <div class="mb-8 text-center">
        <flux:heading size="xl" class="dark:text-white">R.A Mart</flux:heading>
    </div>

    <h2 class="text-2xl font-semibold mb-2 dark:text-gray-200">Welcome back</h2>
    <p class="text-gray-600 dark:text-gray-400 mb-6">Enter your details below to login.</p>

    <form wire:submit="login" class="flex flex-col gap-4">
        <flux:input wire:model="email" label="{{ __('Email') }}" type="email" name="email" required autocomplete="email"
            placeholder="Email" />
        {{--
        <x-input-error :messages="$errors->get('form.email')" class="text-red-500" /> --}}

        <flux:input wire:model="password" label="{{ __('Password') }}" type="password" name="password" required
            autocomplete="current-password" placeholder="Password" />
        {{--
        <x-input-error :messages="$errors->get('form.password')" class="text-red-500" /> --}}

        <flux:button variant="primary" type="submit" class="w-full" wire:loading.attr="disabled">
            <span wire:loading.remove>Log in</span>
            <div wire:loading class="flex items-center gap-2">
                <i class="fa-solid fa-spinner animate-spin text-xl"></i>
                <span>Memproses...</span>
            </div>
        </flux:button>
    </form>

    <div class="mt-4 text-center">
        @if (Route::has('password.request'))
        <flux:link href="{{ route('password.request') }}" class="text-rose-600 dark:text-rose-400 hover:underline"
            wire:navigate>
            Forgot password
        </flux:link>
        @endif
    </div>
</div>