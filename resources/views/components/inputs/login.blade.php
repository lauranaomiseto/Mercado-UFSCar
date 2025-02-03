@props([
    'icon',
    'text',
    'texttype'
])

<div class="w-[250px] py-2.5 pl-2.5 flex item-center font-light border-b-2 border-orange bg-white mb-[25px]">
    <div class="mr-4">
        {{ $icon }}
    </div>
    <input type="{{ $texttype }}" placeholder="{{ $text }}"
    class="placeholder-dark-gray w-full focus:outline-none">
</div>