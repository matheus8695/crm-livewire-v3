<div class="p-4 my-4 rounded-lg shadow-md dark:bg-gray-700 relative">
    @unless ($edit)
        <p>{{ $note->note }}</p>
        <p class="text-sm italic mt-2">by {{ $note->user->name }}</p>

        @if ($note->user->is(auth()->user()))
            <x-button
                class="btn-ghost btn-sm absolute top-2 right-2"
                icon="o-pencil"
                spinner
                wire:click="$set('edit', true)"
            />
        @endif
    @else
        <form class="pt-1 pb-3 flex items-start gap-2" wire:submit='save'>
            <div class="w-full">
                <x-textarea wire:model='note.note' class="input-sm" placeholder="{{ __('Write down your new note') }}" />
            </div>
        
            <div>
                <x-button type='submit' class="btn-sm btn-ghost">{{ __('Save') }}</x-button>
                <x-button 
                    type='button' 
                    class="btn-sm btn-ghost btn-error"
                    wire:click='destroy'
                >
                    {{ __('Are you sure?') }}
                </x-button>
            </div>
        </form>   
    @endunless
</div>