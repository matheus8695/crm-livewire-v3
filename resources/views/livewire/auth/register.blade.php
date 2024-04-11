<x-card shadow class="mx-auto w-[350px]">
    <x-form wire:submit="submit">
        <x-input label="Name" wire:model="name" />
        <x-input label="Email" wire:model="email" />
        <x-input label="Confirm your email" wire:model="email_confirmation" />
        <x-input label="Password" wire:model="password" type="password"/>

        <x-slot:actions>
            <x-button label="Cancel" />
            <x-button label="Click me!" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</x-card>
