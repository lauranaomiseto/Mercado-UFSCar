@props([
    'route',
    'text'
])

<a href="{{ $route }}" class="inline-block h-fit w-fit px-[25px] py-[10px] text-sm text-center text-orange border-orange border-2 rounded-md hover:bg-orange hover:text-white">
    {{ $text }}
</a>