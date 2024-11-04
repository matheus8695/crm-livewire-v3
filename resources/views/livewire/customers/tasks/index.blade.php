<div class="p-4">
    <livewire:customers.tasks.create :customer="$customer"/>

    <div class="uppercase font-bold text-slate-600 text-xs mb-2">Pending [{{ $this->notDoneTasks->count() }}]</div>
    <ul class="flex flex-col gap-1 mb-6" wire:sortable='updateTaskOrder'>
        @foreach ($this->notDoneTasks as $task)
            <li wire:sortable.item='{{ $task->id }}' wire:key='task-{{ $task->id }}'>
                <button wire:sortable.handle title="{{ __('Drah and drop') }}">
                    <x-icon name="o-queue-list" class="w-4 h-4 -mt-px opacity-30"/>
                </button>

                <input id="task-{{ $task->id }}" type="checkbox" wire:click="toggleCheck({{ $task->id }}, 'done')" value="1" @if ($task->done_at) checked @endif />
                <label for="task-{{ $task->id }}">{{ $task->title }}</label>
                <select>
                    <option>assigned to: {{ $task->assignedTo?->name }}</option>    
                </select>   
            </li>    
        @endforeach
    </ul>
    
    <hr class="border-dashed border-gray-700 my-2"/>

    <div class="uppercase font-bold text-slate-600 text-xs mb-2">Done [{{ $this->doneTasks->count() }}]</div>
    <ul class="flex flex-col gap-1">
        @foreach ($this->doneTasks as $task)
        <li>
            <input id="task-{{ $task->id }}" type="checkbox" wire:click="toggleCheck({{ $task->id }}, 'pendding')" value="1" @if ($task->done_at) checked @endif />
            <label for="task-{{ $task->id }}">{{ $task->title }}</label>
            <select>
                <option>assigned to: {{ $task->assignedTo?->name }}</option>    
            </select>   
        </li>    
        @endforeach
    </ul>
</div>
