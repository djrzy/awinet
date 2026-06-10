@props(['show', 'maxWidth' => '2xl', 'closeable' => true])

<div x-show="$wire.{{ $show }}" x-transition x-cloak class="fixed inset-0 z-50">

    {{-- Overlay --}}
    <div class="fixed inset-0 bg-black/40"></div>

    {{-- Modal Container --}}
    <div class="relative min-h-screen flex items-center justify-center p-4 text-sm">
        <div x-show="$wire.{{ $show }}"
            @if ($closeable) @click.outside="$wire.closeModal()" @endif
            class="
                bg-white
                rounded-xl
                shadow-xl
                w-full
                max-w-{{ $maxWidth }}
                overflow-hidden
            ">

            {{-- Header --}}
            @isset($header)
                <div class="flex items-center justify-between px-6 py-4">
                    <div>
                        {{ $header }}
                    </div>
                    @if ($closeable)
                        <button type="button" @click="$wire.closeModal()"
                            class="text-gray-500 hover:text-gray-700 cursor-pointer">
                            <span class="material-symbols-outlined">
                                close
                            </span>
                        </button>
                    @endif
                </div>
            @endisset

            {{-- Body --}}
            <div class="px-6 py-1 overflow-y-auto max-h-[35vh]">
                {{ $slot }}
            </div>

            {{-- Footer --}}
            @isset($footer)
                <div class="flex justify-end gap-2 p-6">
                    {{ $footer }}
                </div>
            @endisset

        </div>
    </div>

</div>
