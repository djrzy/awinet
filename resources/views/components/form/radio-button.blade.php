@props([
    'name',
    'label' => null,
    'options' => [],
    'value' => null,
    'direction' => 'horizontal', // horizontal | vertical
])

<div class="flex flex-col lg:flex-row items-start lg:gap-4">

    <label class="lg:w-[30%] text-right pt-2 text-gray-500">
        {{ $label ?? str($name)->headline() }}
    </label>

    <div class="w-full lg:w-[70%]">

        <div @class([
            'flex gap-4 flex-wrap' => $direction === 'horizontal',
            'flex flex-col gap-1' => $direction === 'vertical',
        ])>

            @foreach ($options as $radioValue => $radioLabel)
                <label class="inline-flex items-center gap-2 cursor-pointer">

                    <input type="radio" name="{{ $name }}" value="{{ $radioValue }}"
                        @checked(old($name, $value) == $radioValue)
                        {{ $attributes->class([
                            'h-4 w-4',
                        
                            'text-primary border-gray-300 focus:ring-primary' => !$errors->has($name),
                        
                            'border-red-500 text-red-500 focus:ring-red-500' => $errors->has($name),
                        ]) }}>

                    <span>
                        {{ $radioLabel }}
                    </span>

                </label>
            @endforeach

        </div>

        @error($name)
            <p class="text-red-500 text-xs mt-1">
                {{ $message }}
            </p>
        @enderror

    </div>

</div>
