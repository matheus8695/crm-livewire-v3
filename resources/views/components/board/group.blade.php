@props([
    'status',
    'items'
])

<div class="bg-base-300 p-2 rounded-md" wire:key="group-{{ $status }}">
    <x-header 
        :title="$status" 
        subtitle="Total {{ $items->count() }} opportunities" 
        size="text-lg" 
        class="px-2 pb-0 mb-2" 
        separator 
        progress-indicator 
    />
    <div 
        class="space-y-2 py-2 px-2" 
        wire:sortable-group.item-group="{{ $status }}" 
        wire:sortable-group.options="{ animation: 100 }"
    >
        @if ($items->isEmpty())
            <div wire:key='opportunity-null' class="h-10 border-dashed border-gray-400 border-2 shadow rounded w-full flex items-center justify-center opacity-20">
                Empty List
            </div>
        @endif
    
        @foreach ($items as $item)
            <x-card 
                class="hover:opacity-60 cursor-grab"
                wire:sortable-group.handle 
                wire:sortable-group.item="{{ $item->id }}" 
                wire:key="opportunioty-{{ $item->id }}"
            >
                {{ $item->title }}
            </x-card>
        @endforeach
    </div>
</div>