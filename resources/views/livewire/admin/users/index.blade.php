<div>
    <x-header title="Users" separator/>

    <div class="mb-4 flex space-x-4">
        <div class="w-1/3">
            <x-input
                label="Searh by email or name" 
                icon="o-magnifying-glass" 
                wire:model.live="search"/>
        </div>

        <div class="w-1/5">
            <x-choices
                label="Searh by permissions"
                wire:model.live="search_permissions"
                :options="$permissionsToSearch"
                option-label="key"
                search-function="filterPermissions"
                searchable 
            />
        </div>
    </div>

    <x-table :headers="$this->headers" :rows="$this->users" striped @row-click="alert($event.detail.name)">
        @scope('cell_permissions', $user)
            @foreach ($user->permissions as $permission)
                <x-badge :value="$permission->key" class="badge-primary"/>
            @endforeach
        @endscope

        @scope('actions', $user)
            <x-button icon="o-trash" wire:click="delete({{ $user->id }})" spinner class="btn-sm" ></x-button>
        @endscope
    </x-table>
</div>
