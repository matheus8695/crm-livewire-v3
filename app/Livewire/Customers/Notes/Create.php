<?php

namespace App\Livewire\Customers\Notes;

use App\Models\Customer;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Mary\Traits\Toast;

class Create extends Component
{
    use Toast;

    public Customer $customer;

    #[Rule(['required', 'string'])]
    public ?string $note = null;

    public function save(): void
    {
        $this->validate();

        $this->customer->notes()->create([
            'note'    => $this->note,
            'user_id' => auth()->id(),
        ]);

        $this->dispatch('note::refresh')->to('customers.notes.index');
        $this->success(__('Note created successfully.'));
        $this->reset('note');
    }
    public function render()
    {
        return view('livewire.customers.notes.create');
    }
}
