@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-[#F4F4F2]']) }}>
    {{ $value ?? $slot }}
</label>
