@props([
    'route',
    'text'
])

<a href="{{ $route }}" class="flex items-center text-orange underline hover:font-semibold">
    <div class="mr-2">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.5 10H2.91667" stroke="#DB5A0F" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M8.33333 15.8333L2.5 10L8.33333 4.16666" stroke="#DB5A0F" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
    <div>
        {{ $text }}
    </div>    
</a>