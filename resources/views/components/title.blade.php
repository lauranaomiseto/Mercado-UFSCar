@props([
    'text',
    'boldtext'
])

<h1 class="text-4xl font-light inline"> 
    {{ $text }}
    <span class="font-bold">
        {{ $boldtext }}
    </span>
</h1>
