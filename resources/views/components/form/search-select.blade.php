@props(['name', 'label' => null, 'options' => [], 'placeholder' => 'Select an option...'])

<div class="flex flex-col lg:flex-row items-start lg:gap-4" x-data="{
    open: false,
    search: '',
    value: @entangle($attributes->wire('model')),
    options: {{ json_encode($options) }},
    dropdownStyles: { top: '0px', left: '0px', width: '0px' },

    updatePosition() {
        if (!this.open) return;
        let trigger = this.$refs.trigger.getBoundingClientRect();
        this.dropdownStyles = {
            top: (trigger.bottom + window.scrollY) + 'px',
            left: (trigger.left + window.scrollX) + 'px',
            width: trigger.width + 'px'
        };
    },
    get filteredOptions() {
        if (this.search === '') return this.options;
        return this.options.filter(option =>
            option.label.toLowerCase().includes(this.search.toLowerCase())
        );
    },
    get selectedLabel() {
        let found = this.options.find(option => option.id == this.value);
        return found ? found.label : '';
    }
}" x-init="$watch('open', value => { if (value) { $nextTick(() => updatePosition()); } })"
    x-on:click.outside="open = false" x-on:keydown.escape.window="open = false" x-on:resize.window="updatePosition()"
    x-on:scroll.window="updatePosition()">

    <label for="{{ $name }}" class="lg:w-[30%] text-right pt-2 text-gray-500">
        {{ $label ?? str($name)->headline() }}
    </label>

    <div class="w-full lg:w-[70%]">

        <div x-on:click.stop="open = !open" x-ref="trigger"
            {{ $attributes->class([
                'w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 cursor-pointer flex justify-between items-center bg-white select-none',
                'border-gray-300 focus:ring-primary' => !$errors->has($name),
                'border-red-500 focus:ring-red-500' => $errors->has($name),
            ]) }}>

            <span x-text="selectedLabel || '{{ $placeholder }}'" :class="value ? 'text-gray-900' : 'text-gray-400'">
            </span>

            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>

        <template x-teleport="body">
            <div x-show="open" x-transition x-on:click.stop
                class="absolute z-[99999] bg-white border border-gray-300 rounded-md shadow-lg max-h-60 flex flex-col"
                :style="dropdownStyles" style="display: none;">

                <div class="p-2 border-b border-gray-100 sticky top-0 bg-white">
                    <input type="text" x-model="search" placeholder="Search..."
                        class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded focus:outline-none focus:border-primary"
                        x-ref="searchBox" x-effect="if(open) $nextTick(() => $refs.searchBox.focus())">
                </div>

                <ul class="overflow-y-auto flex-1 py-1 text-sm text-gray-700">
                    <template x-for="option in filteredOptions" :key="option.id">
                        <li x-on:click.stop="value = option.id; open = false; search = '';"
                            class="px-3 py-2 cursor-pointer hover:bg-primary hover:text-white flex justify-between items-center"
                            :class="value == option.id ? 'bg-gray-100 font-semibold' : ''">

                            <span x-text="option.label"></span>

                            <template x-if="value == option.id">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </template>
                        </li>
                    </template>

                    <template x-if="filteredOptions.length === 0">
                        <li class="px-3 py-2 text-gray-400 text-center italic">
                            No results found
                        </li>
                    </template>
                </ul>
            </div>
        </template>

        @error($name)
            <p class="text-red-500 text-xs mt-1">
                {{ $message }}
            </p>
        @enderror

    </div>
</div>
