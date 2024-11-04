<?php

namespace App\Livewire\Customers\Tasks;

use App\Models\{Task, User};
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Mary\Traits\Toast;

class Edit extends Component
{
    use Toast;

    public Task $task;

    public bool $editing = false;

    public mixed $selectedUser = null;

    public function mount(): void
    {
        $this->selectedUser = $this->task->assigned_to;
    }

    public function render()
    {
        return view('livewire.customers.tasks.edit');
    }

    #[Computed]
    public function users(): Collection
    {
        return User::all();
    }

    public function rules(): array
    {
        return [
            'task.title'   => ['required', 'string', 'max:255'],
            'selectedUser' => ['nullable', Rule::exists('users', 'id')],
        ];
    }

    public function save(): void
    {
        $this->validate();

        if ($this->selectedUser) {
            $this->task->assigned_to = $this->selectedUser;
        }

        $this->task->save();

        if ($this->task->wasChanged('assigned_to')) {
            $this->task->load('assignedTo');
        }

        $this->info(__('Task updated successfully'));
        $this->reset('editing');
    }

    public function toggleCheck(string $status): void
    {
        Task::whereId($this->task->id)
            ->when(
                $status == 'done',
                fn (Builder $q) => $q->update(['done_at' => now()]),
                fn (Builder $q) => $q->update(['done_at' => null])
            );

        $this->dispatch('task::updated');
    }

    public function deleteTask(): void
    {
        $this->task->delete();
        $this->dispatch('task::deleted');
    }
}
