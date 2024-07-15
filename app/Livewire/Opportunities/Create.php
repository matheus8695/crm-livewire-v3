<?php

namespace App\Livewire\Opportunities;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public Form $form;

    public bool $modal = false;

    public Collection|array $customers = [];

    public function mount()
    {
        $this->search();
    }

    public function render()
    {
        return view('livewire.opportunities.create');
    }

    #[On('opportunity::create')]
    public function open(): void
    {
        $this->form->resetErrorBag();
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
        $this->customers = Customer::query()
            ->where('name', 'like', "%$value%")
            ->take(5)
            ->orderBy('name')
            ->get(['id', 'name'])
            ->merge(Customer::query()->whereId($this->form->customer_id)->get(['id', 'name']));
    }
}
