<div>
   @if ($this->note)
        <div class="bg-base-200 rounded-md p-4 space-y-2 gap-4 flex flex-col">
            <x-info.title>Pinned Note</x-info.title>

            <p>{{ $this->note->note }}</p>
            <p class="text-sm italic mt-2">by {{ $this->note->user->name }}</p>
        </div>
   @endif
</div>
