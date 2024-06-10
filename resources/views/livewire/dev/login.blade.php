<div class="flex items-center space-x-2">
    <x-select icon="o-user" :options="$this->users" wire:model='selectedUser' placeholder="Select an user"/>
    <x-button wire:click='login'>Login</x-button>
</div>
