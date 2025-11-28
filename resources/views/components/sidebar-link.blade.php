@props(['href' => '#', 'title' => 'Link'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'text-[#243A69] bg-[#d4cdc5] hover:bg-[#E5E5E5] px-3 py-2 rounded-md']) }}>
    {{ $title }}
</a>