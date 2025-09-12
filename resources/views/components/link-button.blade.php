<a {{ $attributes->merge(['class' => 'bg-[#D4CDC5] text-[#2C3E50] w-full text-center font-bold text-2xl md:text-4xl px-4 py-2 rounded-md font-poppins mb-4 hover:bg-[#F4F4F2]']) }} href="{{ $href }}">
    {{ $slot }}
</a>
