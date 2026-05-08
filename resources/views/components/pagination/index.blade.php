@if ($paginator->hasPages())
    <nav class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-4">

        {{-- Info --}}
        <div class="text-sm text-gray-600 pl-2">
            Showing
            <span class="font-semibold">{{ $paginator->firstItem() }}</span>
            to
            <span class="font-semibold">{{ $paginator->lastItem() }}</span>
            of
            <span class="font-semibold">{{ $paginator->total() }}</span>
            entries
        </div>

        {{-- Pagination --}}
        <div class="flex items-center gap-1 text-sm">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                {{-- <span
                    class="flex items-center justify-center min-w-8 h-9 rounded-md bg-gray-100 text-gray-400 cursor-not-allowed px-3">
                    Prev
                </span> --}}
            @else
                <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
                    class="flex items-center justify-center min-w-8 h-9 rounded-md bg-[#007E41] text-white hover:bg-[#007E41]/80 transition cursor-pointer px-3">
                    Prev
                </button>
            @endif

            {{-- Page Numbers --}}
            @foreach ($elements as $element)
                {{-- Dots --}}
                @if (is_string($element))
                    <span class="px-2 text-gray-500">
                        {{ $element }}
                    </span>
                @endif

                {{-- Pages --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                class="flex items-center justify-center min-w-8 h-9 rounded-md bg-[#F14F10] text-white font-semibold">
                                {{ $page }}
                            </span>
                        @else
                            <button wire:click="gotoPage({{ $page }})"
                                class="flex items-center justify-center min-w-8 h-9 rounded-md border border-gray-200 bg-white hover:bg-[#F14F10]/10 transition cursor-pointer">
                                {{ $page }}
                            </button>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <button wire:click="nextPage" wire:loading.attr="disabled" rel="next"
                    class="flex items-center justify-center min-w-8 h-9 rounded-md bg-[#007E41] text-white hover:bg-[#007E41]/80 transition cursor-pointer px-3">
                    Next
                </button>
            @else
                {{-- <span
                    class="flex items-center justify-center min-w-8 h-9 rounded-md bg-gray-100 text-gray-400 cursor-not-allowed px-3">
                    Next
                </span> --}}
            @endif

        </div>
    </nav>
@endif
