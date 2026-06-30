@props([
    'position' => 'top-16 right-6',
])

<!-- Panggil komponen data dari toast.js -->
<div x-data="toast" @notify.window="showToast($event)" x-show="toast"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-full opacity-0" x-cloak
    class="fixed {{ $position }} z-9999">

    <div class="bg-white px-4 py-3 rounded-lg shadow-lg flex gap-3 items-center max-w-sm border-l-4"
        :class="{
            'border-green-500': toastType === 'success',
            'border-red-500': toastType === 'error' || toastType === 'danger',
            'border-amber-500': toastType === 'warning',
            'border-blue-500': toastType === 'info'
        }">

        <!-- Ikon Dinamis Menggunakan Material Symbols -->
        <span class="material-symbols-outlined text-3xl"
            :class="{
                'text-green-500': toastType === 'success',
                'text-red-500': toastType === 'error' || toastType === 'danger',
                'text-amber-500': toastType === 'warning',
                'text-blue-500': toastType === 'info'
            }"
            x-text="{
                'success': 'check_circle',
                'error': 'error',
                'danger': 'error',
                'warning': 'warning',
                'info': 'info'
            }[toastType] || 'check_circle'">
        </span>

        <div>
            <p class="font-semibold text-sm uppercase"
                :class="{
                    'text-green-600': toastType === 'success',
                    'text-red-600': toastType === 'error' || toastType === 'danger',
                    'text-amber-600': toastType === 'warning',
                    'text-blue-600': toastType === 'info'
                }"
                x-text="toastTitle"></p>

            <p class="text-sm text-gray-600" x-text="toastMessage"></p>
        </div>
    </div>
</div>
