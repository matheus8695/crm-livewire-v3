<?php

namespace App\Livewire\Admin\Users;

use App\Enum\Can;
use Livewire\Attributes\On;
use Livewire\Component;

class Impersonate extends Component
{
    public function render()
    {
        return <<<'HTML'
        <div></div>
        HTML;
    }

    #[On('user::impersonation')]
    public function impersonate(int $id): void
    {
        $this->authorize(Can::BE_AN_ADMIN->value);

        session()->put('impersonator', auth()->id());
        session()->put('impersonate', $id);

        $this->redirect(route('dashboard'));
    }
}
