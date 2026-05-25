@props(['name', 'label' => null])

<div class="flex items-start gap-4">

    <label for="{{ $name }}" class="w-[30%] text-right pt-2">
        {{ $label ?? str($name)->headline() }}
    </label>

    <div class="w-[70%]">

        <select id="{{ $name }}"
            {{ $attributes->class([
                'w-full',
                'border',
                'rounded-md',
                'px-3',
                'py-2',
                'focus:outline-none',
                'focus:ring-2',
            
                'border-gray-300 focus:ring-primary' => !$errors->has($name),
            
                'border-red-500 focus:ring-red-500' => $errors->has($name),
            ]) }}>
            {{ $slot }}
        </select>

        @error($name)
            <p class="text-red-500 text-xs mt-1">
                {{ $message }}
            </p>
        @enderror

    </div>

</div>
