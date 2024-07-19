<div class="p-2 grid grid-cols-3 gap-4 h-full" wire:sortable-group="updateOpportunities">
    <x-board.group status="open" :items="$this->opens"/>
    <x-board.group status="won" :items="$this->wons"/>
    <x-board.group status="lost" :items="$this->losts"/>
</div>
