<div x-data x-init="const options = {
    mode: '{{ $mode ?? 'single' }}',
    dateFormat: '{{ $dateFormat ?? 'Y-m-d' }}',
    altInput: true,
    altFormat: '{{ $altFormat ?? 'F j, Y' }}',
    allowInput: false,
};

if (@js($monthPicker ?? false)) {
    options.plugins = [
        new monthSelectPlugin({
            shorthand: true,
            dateFormat: '{{ $dateFormat ?? 'Y-m' }}',
            altFormat: '{{ $altFormat ?? 'F Y' }}',
        })
    ];
}

flatpickr($refs.input, options);">
    <input x-ref="input" type="text" name="{{ $name }}" value="{{ $value ?? '' }}" {{ $attributes }}>
</div>
