<div>
    <x-header title="Opportunities" separator/>

    <div class="mb-4 flex items-end justify-between">
        <div class="w-full flex space-x-4 items-end">
            <div class="w-1/3">
                <x-input
                    label="Searh by email or name" 
                    icon="o-magnifying-glass" 
                    wire:model.live="search"
                    />
            </div>

            <x-select 
                wire:model.live='perPage' 
                :options="[['id' => 5, 'name' => 5], ['id' => 15, 'name' => 15], ['id' => 25, 'name' => 25], ['id' => 50, 'name' => 50]]"
                label="Records Per Page"
            />

            <x-checkbox 
                label="Show Archived Opportunities" 
                wire:model.live="search_trash" 
                class="checkbox-primary" 
                right tight 
            />
        </div>

        <x-button @click="$dispatch('opportunity::create')" label="New Opportunity" icon="o-plus"/>
    </div>

    <x-table :headers="$this->headers" :rows="$this->items">
        @scope('header_id', $header) 
            <x-table.th :$header name="id"/>
        @endscope

        @scope('header_title', $header) 
            <x-table.th :$header name="title"/>
        @endscope

        @scope('header_status', $header) 
            <x-table.th :$header name="status"/>
        @endscope
        
        @scope('header_amount', $header) 
        <x-table.th :$header name="amount"/>
        @endscope
        
        @scope('cell_status', $item)
        <x-badge :value="$item->status" @class([
            'badge-outline badge-sm',
            'badge-info' => $item->status == 'open',
            'badge-success' => $item->status == 'won',
            'badge-error' => $item->status == 'lost'
        ])/>
        @endscope

        @scope('cell_amount', $item)
            <div class="whitespace-nowrap">R$ {{ number_format($item->amount/100, 2, ',', '.') }}</div>
        @endscope

        @scope('actions', $opportunity) 
            <div class="flex justify-between items-center space-x-2">
                @unless ($opportunity->trashed())
                    <x-button 
                        icon="o-pencil"
                        id="update-btn-{{ $opportunity->id }}"
                        wire:key="update-btn-{{ $opportunity->id }}" 
                        @click="$dispatch('opportunity::update', { id: {{ $opportunity->id }} })" 
                        spinner class="btn-sm" 
                    />

                    <x-button 
                        icon="o-trash"
                        id="archive-btn-{{ $opportunity->id }}"
                        wire:key="archive-btn-{{ $opportunity->id }}" 
                        @click="$dispatch('opportunity::archive', { id: {{ $opportunity->id }} })" 
                        spinner class="btn-sm" 
                    />
                @else 
                    <x-button 
                        icon="o-arrow-uturn-left"
                        id="restore-btn-{{ $opportunity->id }}"
                        wire:key="restore-btn-{{ $opportunity->id }}" 
                        @click="$dispatch('opportunity::restore', { id: {{ $opportunity->id }} })" 
                        spinner class="btn-sm" 
                    />
                @endunless
            </div>
        @endscope
    </x-table>

    {{ $this->items->links(data: ['scrollTo' => false]) }}

    <livewire:opportunities.create/>
    <livewire:opportunities.archive/>
    <livewire:opportunities.restore/>
    <livewire:opportunities.update/>
</div>
