@props([
    'route',
    'text'
])

<a href="{{ $route }}" class="inline-block h-fit w-fit px-[25px] py-[10px] text-sm text-center text-white border-orange border-2 bg-orange rounded-md hover:bg-dark-orange">
    {{ $text }}
</a>