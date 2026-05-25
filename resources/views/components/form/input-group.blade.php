@props(['name', 'type' => 'text', 'label' => null, 'prefix' => null, 'suffix' => null])

<div class="flex items-start gap-4">

    <label for="{{ $name }}" class="w-[30%] text-right pt-2">
        {{ $label ?? str($name)->headline() }}
    </label>

    <div class="w-[70%]">

        <div class="flex">

            @if ($prefix)
                <span
                    class="
                        bg-gray-200
                        px-3
                        flex
                        items-center
                        border
                        border-r-0
                        border-gray-300
                        rounded-l-md
                        shrink-0
                    ">
                    {{ $prefix }}
                </span>
            @endif

            <input type="{{ $type }}" id="{{ $name }}"
                {{ $attributes->class([
                    'w-full',
                    'px-3',
                    'py-2',
                    'border',
                    'focus:outline-none',
                    'focus:ring-2',
                
                    'border-gray-300 focus:ring-primary' => !$errors->has($name),
                
                    'border-red-500 focus:ring-red-500' => $errors->has($name),
                
                    'rounded-md' => !$prefix && !$suffix,
                
                    'rounded-r-md rounded-l-none' => $prefix,
                
                    'rounded-l-md rounded-r-none' => $suffix,
                ]) }}>

            @if ($suffix)
                <span
                    class="
                        bg-gray-200
                        px-3
                        flex
                        items-center
                        border
                        border-l-0
                        border-gray-300
                        rounded-r-md
                        shrink-0
                    ">
                    {{ $suffix }}
                </span>
            @endif

        </div>

        @error($name)
            <p class="text-red-500 text-xs mt-1">
                {{ $message }}
            </p>
        @enderror

    </div>

</div>
