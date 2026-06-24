@props(['name', 'type' => 'text', 'label' => null, 'prefix' => null, 'suffix' => null])

{{-- 1. If label is false, bypass the outer 30/70 grid wrapper entirely to protect inline rows --}}
@if ($label === false)
    <div class="w-full flex">
        @if ($prefix)
            <span class="bg-gray-200 px-3 flex items-center border border-r-0 border-gray-300 rounded-l-md shrink-0">
                {{ $prefix }}
            </span>
        @endif

        <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}"
            {{ $attributes->merge([
                'class' => collect([
                    'w-full',
                    'px-3',
                    'py-2',
                    'border',
                    'focus:outline-none',
                    'focus:ring-2',
                    !$errors->has($name) ? 'border-gray-300 focus:ring-primary' : 'border-red-500 focus:ring-red-500',
                    !$prefix && !$suffix ? 'rounded-md' : null,
                    $prefix ? 'rounded-r-md rounded-l-none' : null,
                    $suffix ? 'rounded-l-md rounded-r-none' : null,
                ])->filter()->implode(' '),
            ]) }}>

        @if ($suffix)
            <span class="bg-gray-200 px-3 flex items-center border border-l-0 border-gray-300 rounded-r-md shrink-0">
                {{ $suffix }}
            </span>
        @endif
    </div>
@else
    {{-- 2. Standard page behavior with label and responsive grid --}}
    <div class="flex flex-col lg:flex-row items-start lg:gap-4">

        <label for="{{ $name }}" class="lg:w-[30%] text-right pt-2 text-gray-500">
            {{ $label ?? str($name)->headline() }}
        </label>

        <div class="w-full lg:w-[70%]">
            <div class="flex">
                @if ($prefix)
                    <span
                        class="bg-gray-200 px-3 flex items-center border border-r-0 border-gray-300 rounded-l-md shrink-0">
                        {{ $prefix }}
                    </span>
                @endif

                <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}"
                    {{ $attributes->merge([
                        'class' => collect([
                            'w-full',
                            'px-3',
                            'py-2',
                            'border',
                            'focus:outline-none',
                            'focus:ring-2',
                            !$errors->has($name) ? 'border-gray-300 focus:ring-primary' : 'border-red-500 focus:ring-red-500',
                            !$prefix && !$suffix ? 'rounded-md' : null,
                            $prefix ? 'rounded-r-md rounded-l-none' : null,
                            $suffix ? 'rounded-l-md rounded-r-none' : null,
                        ])->filter()->implode(' '),
                    ]) }}>

                @if ($suffix)
                    <span
                        class="bg-gray-200 px-3 flex items-center border border-l-0 border-gray-300 rounded-r-md shrink-0">
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
@endif
