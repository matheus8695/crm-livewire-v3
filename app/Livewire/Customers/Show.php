<?php

namespace App\Livewire\Customers;

use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Show extends Component
{
    public Customer $customer;

    public string $tab = "opportunities";

    public function mount(): void
    {
        abort_unless(in_array($this->tab, ['notes', 'tasks', 'opportunities']), 404);
    }

    public function render(): View
    {
        return view('livewire.customers.show');
    }
}
