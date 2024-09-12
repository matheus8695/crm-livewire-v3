@props([
    'title'
])

<div>
    <div class="text-gray-600 text-xs">{{ $title }}</div>
    <div>{{ $slot }}</div>
</div>