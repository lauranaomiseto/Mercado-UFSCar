@props([
    'label',
    'name',
    'value',
    'placeholder'  
])

<label class="mb-4"
for="{{ $name }}">{{ $label }}</label><br>

<input class="w-[295px] bg-light-gray px-[15px] py-[10px] rounded-[5px] mt-[5px] mb-[25px] text-medium-gray"
 type="text" 
 name="{{ $name }}"
 value="{{ $value }}" 
 placeholder="{{ $placeholder }}"><br>