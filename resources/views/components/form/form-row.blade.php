@props(['label' => null])

<div class="flex flex-col lg:flex-row items-start lg:gap-4 mb-4">
    <div class="lg:w-[15%] lg:text-right pt-2 text-gray-500 font-medium">
        {{ $label }}
    </div>

    <div class="w-full lg:w-[85%]">
        <div class="flex flex-col sm:flex-row gap-2 items-start">
            {{ $slot }}
        </div>
    </div>
</div>
