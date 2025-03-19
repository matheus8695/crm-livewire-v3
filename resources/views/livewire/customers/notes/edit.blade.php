<div class="bg-base-300 rounded-md p-4 space-y-2 text-base gap-4 flex flex-col relative">
    @unless ($edit)
        <p>{{ $note->note }}</p>
        <p class="text-sm italic mt-2">by {{ $note->user->name }}</p>

        <div class="absolute top-2 right-2 flex gap-4">
            <x-button
                class="btn-ghost btn-sm"
                spinner
                wire:click="pinNote"
            >
                <x-icon 
                    name="s-star"
                    @class(['w-4 h-4', 'text-yellow-500' => $note->pinned])
                />
            </x-button>
    
            @if ($note->user->is(auth()->user()))
                <x-button
                    class="btn-ghost btn-sm"
                    icon="o-pencil"
                    spinner
                    wire:click="$set('edit', true)"
                />
            @endif
        </div>
    @else
        <form class="flex-col items-start gap-2" wire:submit='save'>
            <div class="w-full">
                <x-textarea wire:model='note.note' class="input-sm" placeholder="{{ __('Write down your new note') }}" />
            </div>
        
            <div class="flex justify-between">
                <div>
                    <x-button type='submit' class="btn-xs btn-ghost">{{ __('Save') }}</x-button>
                    <x-button 
                        type='button' 
                        class="btn-xs btn-ghost"
                        wire:click="$set('edit', false)"
                    >
                        {{ __('Cancel') }}
                    </x-button>
                </div>

                <x-button
                    type='button' 
                    class="btn-xs btn-ghost !text-error"
                    wire:click='destroy'
                >
                    {{ __('Are you sure?') }}
                </x-button>
            </div>
        </form>   
    @endunless
</div>