<x-modal 
    wire:model='modal' 
    title="Restore Confirmation"
    subtitle="You are restoring the opportunity {{ $opportunity?->title }}" 
>
    <x-slot:actions>
        <x-button label="Hum... no" @click="$wire.modal = false"/>
        <x-button label="Yes, i am" class="btn-primary" wire:click='restore'/>
    </x-slot:actions>
</x-modal>

