<div>
    <x-header title="Users" separator/>

    <div class="flex justify-between mb-4">
        <div class="w-1/3">
            <x-input icon="o-magnifying-glass" class="input-md" placeholder="Searh by email and name" wire:model.live="search"/>
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
