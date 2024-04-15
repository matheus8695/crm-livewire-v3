<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class Login extends Component
{
    public string $email;

    public string $password;

    public function render(): View
    {
        return view('livewire.auth.login');
    }

    public function tryToLogin(): void
    {
        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $this->addError('invalidCredentials', trans('auth.failed'));

            return;
        }

        $this->redirect(route('dashboard'));
    }
}
