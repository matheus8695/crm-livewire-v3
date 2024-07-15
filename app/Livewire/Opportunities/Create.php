<?php

namespace App\Livewire\Opportunities;

use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public Form $form;

    public bool $modal = false;

    public function render()
    {
        return view('livewire.opportunities.create');
    }

    #[On('opportunity::create')]
    public function open(): void
    {
        $this->form->resetErrorBag();
        $this->search();
        $this->modal = true;
    }

    public function save(): void
    {
        $this->form->create();
        $this->modal = false;

        $this->dispatch('opportunity::reload')->to('opportunities.index');
    }

    public function search(string $value = ''): void
    {
        $this->form->searchCustomers($value);
    }
}
