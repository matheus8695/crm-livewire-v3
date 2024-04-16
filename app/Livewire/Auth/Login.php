<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\{Auth, RateLimiter};
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;

class Login extends Component
{
    public ?string $email = null;

    public ?string $password = null;

    public function render(): View
    {
        return view('livewire.auth.login')
            ->layout('components.layouts.guest');
    }

    public function tryToLogin(): void
    {
        if (RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            $this->addError('rateLimiter', trans('auth.throttle', [
                'seconds' => RateLimiter::availableIn($this->throttleKey()),
            ]));

            return;
        }

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            RateLimiter::hit($this->throttleKey());
            $this->addError('invalidCredentials', trans('auth.failed'));

            return;
        }

        $this->redirect(route('dashboard'));
    }

    private function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
}
