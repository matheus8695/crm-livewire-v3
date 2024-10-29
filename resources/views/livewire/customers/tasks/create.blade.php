<form class="pt-1 pb-3 flex items-start gap-2" wire:submit='save'>
    <div class="w-full">
        <x-input wire:model='task' class="input-sm" placeholder="{{ __('Write down your new task') }}" />
    </div>

    <div>
        <x-button type='submit' class="btn-sm btn-ghost">{{ __('Save') }}</x-button>
    </div>
</form>
