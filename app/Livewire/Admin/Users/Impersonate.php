<?php

namespace App\Livewire\Admin\Users;

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
        session()->put('impersonate', $id);

        $this->redirect(route('dashboard'));
    }
}
