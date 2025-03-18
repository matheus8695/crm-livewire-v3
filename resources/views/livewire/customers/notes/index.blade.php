<div class="p-4">
    <livewire:customers.notes.create :customer="$customer"/>

    <div>
        @foreach ($this->notes as $note)
            <livewire:customers.notes.edit :$note wire:key="notes-edit-{{ $note->id }}" />
        @endforeach
    </div>
</div>
