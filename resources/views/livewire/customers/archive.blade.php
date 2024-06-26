<x-modal 
    wire:model='modal' 
    title="Archive Confirmation"
    subtitle="You are archive the customer {{ $customer?->name }}" 
>
    <x-slot:actions>
        <x-button label="Hum... no" @click="$wire.modal = false"/>
        <x-button label="Yes, i am" class="btn-primary" wire:click='archive'/>
    </x-slot:actions>
</x-modal>

