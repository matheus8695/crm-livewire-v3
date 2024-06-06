<div class="flex items-center p-2 bg-gray-900 space-x-2 justify-end">
    <x-select icon="o-user" :options="$this->users" wire:model='selectedUser' placeholder="Select an user"/>
    <x-button wire:click='login'>Login</x-button>
</div>
