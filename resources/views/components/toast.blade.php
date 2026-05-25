@props([
    'position' => 'top-16 right-6',
])

<div x-show="toast" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0 opacity-100"
    x-transition:leave-end="translate-x-full opacity-0" x-cloak class="fixed {{ $position }} z-50">
    <div class="bg-white px-4 py-3 rounded-lg shadow-lg flex gap-3 items-center max-w-sm">
        <span class="material-symbols-outlined text-green-500 text-3xl">
            check_circle
        </span>

        <div>
            <p class="font-semibold text-sm uppercase" x-text="toastTitle"></p>

            <p class="text-sm" x-text="toastMessage"></p>
        </div>
    </div>
</div>
