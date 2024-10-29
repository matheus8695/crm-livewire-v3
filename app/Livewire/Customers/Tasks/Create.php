<?php

namespace App\Livewire\Customers\Tasks;

use App\Models\Customer;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Mary\Traits\Toast;

class Create extends Component
{
    use Toast;

    public Customer $customer;

    #[Rule(['required', 'string', 'max:255'])]
    public ?string $task = null;

    public function save(): void
    {
        $this->validate();

        $this->customer->tasks()->create([
            'title' => $this->task,
        ]);

        $this->dispatch('task::created')->to('customers.tasks.index');
        $this->success(__('Task created successfully.'));
        $this->reset('task');
    }

    public function render()
    {
        return view('livewire.customers.tasks.create');
    }
}
