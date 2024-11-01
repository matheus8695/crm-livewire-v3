<?php

namespace App\Livewire\Customers\Tasks;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;

class Index extends Component
{
    public Customer $customer;

    #[On('task::created')]
    public function render(): View
    {
        return view('livewire.customers.tasks.index');
    }

    #[Computed]
    public function notDoneTasks()
    {
        return $this->customer->tasks()->orderBy('sort_order')->notDone()->get();
    }

    #[Computed]
    public function doneTasks()
    {
        return $this->customer->tasks()->done()->get();
    }

    public function updateTaskOrder($items)
    {
        $orders = collect($items)->pluck('value')->join(',');
        DB::table('tasks')->update(['sort_order' => DB::raw("field(id, $orders)")]);
    }
}
