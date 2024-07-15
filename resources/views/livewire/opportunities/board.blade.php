<div class="p-2 grid grid-cols-3 gap-4 h-full" wire:sortable-group="updateOpportunities">
    @foreach ($this->opportunities->groupBy('status') as $status => $items)
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
    @endforeach
</div>
