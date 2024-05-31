<div>
    <x-modal wire:model='modal' :title="$user?->name" separator>
        @if ($user)
            <div class="space-y-2">
                <x-input label="Name" :value="$user->name" readonly/>
                <x-input label="Email" :value="$user->email" readonly/>
                <x-input label="Created At" :value="$user->created_at->format('d/m/Y H:i')" readonly/>
                <x-input label="Updated At" :value="$user->updated_at->format('d/m/Y H:i')" readonly/>
                <x-input label="Deleted At" :value="$user->deleted_at?->format('d/m/Y H:i')" readonly/>
                <x-input label="Deleted By" :value="$user->deletedBy?->name" readonly/>
            </div>
        @endif

        <x-slot:actions>
            <x-button label="Cancel" @click="$wire.modal = false"/>
        </x-slot:actions>
    </x-modal>
</div>
