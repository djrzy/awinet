@props(['name', 'type' => 'checkbox', 'label' => null, 'description' => null])

<div class="flex items-start gap-4">

    <label for="{{ $name }}" class="w-[30%] text-right">
        {{ $label ?? str($name)->headline() }}
    </label>

    <div class="w-[70%]">

        <div class="flex gap-1">

            <input type="{{ $type }}" id="{{ $name }}"
                {{ $attributes->class([
                    // 'w-full',
                    'px-3',
                    'py-2',
                    'border',
                    'focus:outline-none',
                    'focus:ring-2',

                    'border-gray-300 focus:ring-primary' => !$errors->has($name),

                    'border-red-500 focus:ring-red-500' => $errors->has($name),
                ]) }}>

            @if ($description)
                <p class="text-xs text-gray-400">
                    ({{ $description }})
                </p>
            @endif

        </div>

        @error($name)
            <p class="text-red-500 text-xs mt-1">
                {{ $message }}
            </p>
        @enderror

    </div>

</div>
