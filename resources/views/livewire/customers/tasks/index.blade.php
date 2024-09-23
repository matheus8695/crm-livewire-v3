<div class="p-4">
    <div class="uppercase font-bold text-slate-600 text-xs mb-2">Pending [{{ $this->notDoneTasks->count() }}]</div>
    <ul class="flex flex-col gap-1 mb-6">
        @foreach ($this->notDoneTasks as $task)
        <li>
            <input id="task-{{ $task->id }}" type="checkbox" value="1" @if ($task->done_at) checked @endif />
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
            <input id="task-{{ $task->id }}" type="checkbox" value="1" @if ($task->done_at) checked @endif />
            <label for="task-{{ $task->id }}">{{ $task->title }}</label>
            <select>
                <option>assigned to: {{ $task->assignedTo?->name }}</option>    
            </select>   
        </li>    
        @endforeach
    </ul>
</div>
