@props([
    'text',
    'icon',
    'route'   
])

<a href="{{ $route }}">
    <div class="w-[285px] p-5 flex items-center bg-light-gray rounded-lg drop-shadow-pre">
        <div class="mr-5">
            {{ $icon }}
        </div>
        <div class="text-xl text-dark-gray">
            {{ $text }}
        </div>
    </div>
</a>