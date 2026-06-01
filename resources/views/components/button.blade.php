@props([
    'type' => 'button',
    'variant' => 'primary',
    'loadingTarget' => null,
    'loadingText' => null,
])

<button type="{{ $type }}"
    {{ $attributes->class([
        'rounded-md',
        'px-4',
        'py-1',
        'transition',
        'cursor-pointer',
    
        // Primary
        'bg-primary text-white hover:bg-primary/80' => $variant === 'primary',
    
        // Secondary
        'border hover:bg-gray-100' => $variant === 'secondary',
    
        // Danger
        'bg-red-500 text-white hover:bg-red-600' => $variant === 'danger',
    ]) }}>

    @if ($loadingTarget)
        <span wire:loading.remove wire:target="{{ $loadingTarget }}">
            {{ $slot }}
        </span>

        <span wire:loading wire:target="{{ $loadingTarget }}">
            {{ $loadingText ?? 'Loading...' }}
        </span>
    @else
        {{ $slot }}
    @endif

</button>
