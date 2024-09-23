<?php

namespace App\Livewire\Customers\Tasks;

use App\Models\Customer;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public Customer $customer;

    public function render(): View
    {
        return view('livewire.customers.tasks.index');
    }

    #[Computed]
    public function notDoneTasks()
    {
        return $this->customer->tasks()->notDone()->get();
    }

    #[Computed]
    public function doneTasks()
    {
        return $this->customer->tasks()->done()->get();
    }
}
