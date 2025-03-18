<div class="p-4">
    <livewire:customers.tasks.create :customer="$customer"/>

    <div class="uppercase font-bold text-slate-600 text-xs mb-2">Pending [{{ $this->notDoneTasks->count() }}]</div>
    <ul class="flex flex-col gap-1 mb-6" wire:sortable='updateTaskOrder'>
        @foreach ($this->notDoneTasks as $task)
            <li 
                wire:sortable.item='{{ $task->id }}' 
                wire:key='task-{{ $task->id }}' 
                class=""
            >
                <livewire:customers.tasks.edit
                    :task="$task"
                    wire:key='task-edit-component-{{ $task->id }}'
                />
            </li>    
        @endforeach
    </ul>
    
    <hr class="border-dashed border-gray-700 my-2"/>

    <div x-data="{show: true}">
        <div class="uppercase font-bold text-slate-600 text-xs mb-2 flex items-center gap-2">
            <span>Done [{{ $this->doneTasks->count() }}]</span>
            <button title="{{ __('HIde/Show list') }}" class="cursor-pointer" @click="show = !show" type="button">
                <x-icon x-show="show" name="o-chevron-up" class="w-4 h-4 -mt-px opacity-50 hover:opacity-100 hover:text-error" />
                <x-icon x-show="!show" name="o-chevron-down" class="w-4 h-4 -mt-px opacity-50 hover:opacity-100 hover:text-error" />
            </button>
        </div>

        <ul class="flex flex-col gap-1" x-show="show" x-transition.opacity.duration.300ms>
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
                    <x-icon name="o-trash" class="w-4 h-4 -mt-px opacity-30 hover:opacity-100 hover:text-error"/>
                </button>
            </li>    
            @endforeach
        </ul>
    </div>
</div>
