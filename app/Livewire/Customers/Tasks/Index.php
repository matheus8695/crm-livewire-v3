<?php

namespace App\Livewire\Customers\Tasks;

use App\Actions\DataSort;
use App\Models\{Customer, Task};
use Illuminate\Database\Eloquent\Builder;
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

    public function updateTaskOrder($items): void
    {
        (new DataSort('tasks', $items, 'value'))->run();
    }

    public function toggleCheck(int $id, string $status): void
    {
        Task::whereId($id)
            ->when(
                $status == 'done',
                fn (Builder $q) => $q->update(['done_at' => now()]),
                fn (Builder $q) => $q->update(['done_at' => null])
            );
    }
}
