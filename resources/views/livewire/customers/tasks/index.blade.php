<div class="p-4">
    <livewire:customers.tasks.create :customer="$customer"/>

    <div class="uppercase font-bold text-slate-600 text-xs mb-2">Pending [{{ $this->notDoneTasks->count() }}]</div>
    <ul class="flex flex-col gap-1 mb-6" wire:sortable='updateTaskOrder'>
        @foreach ($this->notDoneTasks as $task)
            <li wire:sortable.item='{{ $task->id }}' wire:key='task-{{ $task->id }}' class="flex items-start gap-2 justify-between">
                <div class="flex gap-2">
                    <button wire:sortable.handle title="{{ __('Drah and drop') }}">
                        <x-icon name="o-queue-list" class="w-4 h-4 -mt-px opacity-30"/>
                    </button>

                    <input id="task-{{ $task->id }}" type="checkbox" wire:click="toggleCheck({{ $task->id }}, 'done')" value="1" @if ($task->done_at) checked @endif />
                    <label for="task-{{ $task->id }}">{{ $task->title }}</label>
                    <select>
                        <option>assigned to: {{ $task->assignedTo?->name }}</option>    
                    </select>
                </div>
                
                <button title="{{ __('Delete task') }}" class="cursor-pointer" wire:click='deleteTask({{ $task->id }})'>
                    <x-icon name="o-trash" class="w-4 h-4 -mt-px opacity-30 hover:opacity-100 hover:text-red-500"/>
                </button>
            </li>    
        @endforeach
    </ul>
    
    <hr class="border-dashed border-gray-700 my-2"/>

    <div class="uppercase font-bold text-slate-600 text-xs mb-2">Done [{{ $this->doneTasks->count() }}]</div>
    <ul class="flex flex-col gap-1">
        @foreach ($this->doneTasks as $task)
        <li class="flex items-start gap-2 justify-between">
            <div class="flex gap-2">
                <input id="task-{{ $task->id }}" type="checkbox" wire:click="toggleCheck({{ $task->id }}, 'pendding')" value="1" @if ($task->done_at) checked @endif />
                <label for="task-{{ $task->id }}">{{ $task->title }}</label>
                <select>
                    <option>assigned to: {{ $task->assignedTo?->name }}</option>    
                </select>   
            </div>

            <button title="{{ __('Delete task') }}" class="cursor-pointer" wire:click='deleteTask({{ $task->id }})'>
                <x-icon name="o-trash" class="w-4 h-4 -mt-px opacity-30 hover:opacity-100 hover:text-red-500"/>
            </button>
        </li>    
        @endforeach
    </ul>
</div>
