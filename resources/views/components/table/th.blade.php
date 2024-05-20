@props([
    'header',
    'name'
])

<div class="cursor-pointer" wire:click="sortBy('{{ $name }}', '{{ $header['sortDirection'] == 'asc' ? 'desc' : 'asc' }}')">
    {{  $header['label'] }} 
    @if ($header['sortColumnBy'] == $name)
        <x-icon :name="$header['sortDirection'] == 'asc' ? 'o-chevron-down' : 'o-chevron-up' " class="w-3 h-3 m-1"/>
    @endif
</div>