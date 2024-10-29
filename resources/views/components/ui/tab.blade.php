@props(['href'])

@php
    $tab = collect(explode('/', $href))->last();
    $requestTab = data_get(request()->route()->parameters(), 'tab', 'opportunities');
@endphp

<a {{ $attributes->class([
    'group items-center px-2 py-2 text-sm font-medium text-gray-500 rounded-t-md border-b-2 hover:text-gray-200 hover:bg-base-200',
    'border-transparent' => $tab != $requestTab,
    'text-gray-200 bg-base-200' => $tab == $requestTab
]) }} 
    href="{{ $href }}" wire:navigate.hover
>
    {{ $slot }}
</a>