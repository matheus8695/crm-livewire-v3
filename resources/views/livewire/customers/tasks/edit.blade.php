<div class="flex items-start gap-2 justify-between">
    @if ($editing)
        <form class="pt-1 pb-3 flex items-start gap-2 w-full" wire:submit='save'>
            <div class="w-full">
                <x-input 
                    wire:model="task.title"
                    class="input-sm input-ghost w-full" 
                />
            </div>
            <div class="flex items-center">
                <x-button type="button" class="btn-xs btn-ghost" wire:click="$set('editing', 0)" >{{ __('Cancel') }}</x-button>
                <x-button type="submit" class="btn-xs btn-ghost">{{ __('Save') }}</x-button>
            </div>
        </form>
    @else
        <div>
            <button wire:sortable.handle title="{{ __('Drah and drop') }}">
                <x-icon name="o-queue-list" class="w-4 h-4 -mt-px opacity-30"/>
            </button>

            <input id="task-{{ $task->id }}" type="checkbox" wire:click="toggleCheck('done')" value="1" @if ($task->done_at) checked @endif />
            <label for="task-{{ $task->id }}">{{ $task->title }}</label>
            <select>
                <option>assigned to: {{ $task->assignedTo?->name }}</option>    
            </select>
        </div>
        
        <div>
            <button title="{{ __('Edit task') }}" class="cursor-pointer" wire:click="$set('editing', true)">
                <x-icon name="o-pencil" class="w-4 h-4 -mt-px opacity-30 hover:opacity-100 hover:text-primary"/>
            </button>

            <button title="{{ __('Delete task') }}" class="cursor-pointer" wire:click='deleteTask()'>
                <x-icon name="o-trash" class="w-4 h-4 -mt-px opacity-30 hover:opacity-100 hover:text-error"/>
            </button>
        </div>
    @endif
</div>
