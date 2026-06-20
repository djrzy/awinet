<div class="relative p-2">
    <div class="mt-2 mb-2 flex flex-wrap justify-between items-center px-1 space-y-3 row">
        <div x-data="{ search: @entangle('search').live }" class="relative">

            <input x-model.debounce.300ms="search" type="text"
                class="py-1 px-2 border text-sm border-black/20 rounded-sm w-full pr-8 placeholder:text-sm placeholder:text-gray-300 focus:outline-none focus:ring-2 focus:ring-[#007E41]"
                placeholder="Search..">

            <!-- Search Icon -->
            <button x-show="!search" type="button"
                class="absolute -translate-y-1/2 top-1/2 right-2 flex items-center justify-center">
                <span class="material-symbols-outlined text-lg!">
                    search
                </span>
            </button>

            <!-- Clear Button -->
            <button x-show="search" x-cloak @click="search = ''" type="button"
                class="absolute -translate-y-1/2 top-1/2 right-2 flex items-center justify-center cursor-pointer">
                <span class="material-symbols-outlined text-lg!">
                    close
                </span>
            </button>

        </div>
        <div class="flex flex-col items-end gap-1.5 w-[50%]">
            <div>
                <x-button>Create Invoice</x-button>
            </div>
            <div class="flex items-center gap-1">
                <label for="billing_period_range" class="text-sm">Period</label>
                <x-form.date-picker name="billing_period_range" mode="range" :month-picker="true" date-format="Y-m"
                    alt-format="M Y" class="border border-black/20 rounded px-2 py-1.5 text-sm mx-0.5" />
            </div>
            <div class="flex items-center gap-3">
                <div>
                    <label for="" class="text-sm">Status</label>
                    <select wire:model="payment_status" class="border border-black/20 rounded p-2 text-sm mx-0.5">
                        <option value="any">Any</option>
                        <option value="paid">Paid</option>
                        <option value="unpaid">Unpaid</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
                <div>
                    <label for="" class="text-sm">Show</label>
                    <select wire:model="perPage" class="border border-black/20 rounded p-2 text-sm mx-0.5">

                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <label for="" class="text-sm">entries.</label>
                </div>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left rounded-lg overflow-hidden">
            <thead class="bg-[#007E41] text-white text-sm">
                <tr>
                    <th wire:click="sort('payment_status')" class="px-6 py-3 cursor-pointer select-none">
                        Status
                    </th>
                    <th wire:click="sort('name')" scope="col" class="px-6 py-3 cursor-pointer select-none">
                        Customer Name
                        {{-- @if ($sortBy === 'name')
                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                        @endif --}}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Payment Date
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Payment Type
                    </th>
                </tr>
            </thead>
            <tbody class="*:even:bg-gray-100">

                {{-- @dump($invoices) --}}
                @forelse ($invoices as $invoice)
                    <td class="px-6 py-4 uppercase">{{ $invoice->status }}</td>
                    <td class="px-6 py-4 font-semibold">{{ $invoice->customer->user->name }}</td>
                    <td class="px-6 py-4 font-semibold uppercase">{{ $invoice->invoice_number }}</td>
                    <td class="px-6 py-4">{{ rupiah($invoice->grand_total) }}</td>
                    <td class="px-6 py-4"></td>
                    <td class="px-6 py-4"></td>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- {{ $customers->links() }} --}}
</div>

@script
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            flatpickr('#payment_date', {
                dateFormat: 'Y-m-d'
            });
        });
    </script>
@endscript
