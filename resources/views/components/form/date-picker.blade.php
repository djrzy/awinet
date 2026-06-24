<div wire:ignore {{-- Tambahkan class relative di sini agar posisi tombol reset bisa dipasang secara absolute --}} class="relative w-full text-sm" x-data="{ value: @entangle($attributes->wire('model')) }" x-init="const options = {
    mode: '{{ $mode ?? 'single' }}',
    dateFormat: '{{ $dateFormat ?? 'Y-m-d' }}',
    altInput: true,
    altFormat: '{{ $altFormat ?? 'F j, Y' }}',
    allowInput: false,
    onChange: function(selectedDates, dateStr) {
        value = dateStr;
    }
};

if (@js($monthPicker ?? false)) {
    options.plugins = [
        new monthSelectPlugin({
            shorthand: true,
            dateFormat: '{{ $dateFormat ?? 'Y-m text-sm' }}',
            altFormat: '{{ $altFormat ?? 'F Y' }}',
        })
    ];
}

const instance = flatpickr($refs.input, options);

$watch('value', val => {
    if (!val) instance.clear();
});">

    <input x-ref="input" type="text" name="{{ $name }}" value="{{ $value ?? '' }}"
        {{ $attributes->whereDoesntStartWith('wire:model') }}>

    {{-- Workaround: Tombol reset yang hanya muncul jika input 'value' ada isinya --}}
    <button x-show="value" x-cloak type="button" @click="value = ''; instance.clear();"
        class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 cursor-pointer flex items-center justify-center z-10">
        <span class="material-symbols-outlined text-base">
            close
        </span>
    </button>
</div>
