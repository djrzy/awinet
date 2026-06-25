<div x-data="toast" x-on:notify.window="showToast($event)" class="relative p-2">

    {{-- Filter UI --}}
    <div class="mt-2 mb-2 flex flex-wrap justify-between items-center px-1 space-y-3 row">
        <div x-data="{ search: @entangle('search').live }" class="relative">

            <input x-model.debounce.300ms="search" type="text"
                class="py-1 px-2 border text-sm border-black/20 rounded-sm w-full pr-8 placeholder:text-sm placeholder:text-gray-300 focus:outline-none focus:ring-2 focus:ring-[#007E41]"
                placeholder="Search..">

            <button x-show="!search" type="button"
                class="absolute -translate-y-1/2 top-1/2 right-2 flex items-center justify-center">
                <span class="material-symbols-outlined text-lg!">search</span>
            </button>

            <button x-show="search" x-cloak @click="search = ''" type="button"
                class="absolute -translate-y-1/2 top-1/2 right-2 flex items-center justify-center cursor-pointer">
                <span class="material-symbols-outlined text-lg!">close</span>
            </button>
        </div>

        <div class="flex flex-col justify-end items-end gap-1.5 w-full lg:w-[50%]">
            <div>
                <x-button type="button" wire:click="create">Create Invoice</x-button>
            </div>

            <div class="flex items-center gap-1">
                <label for="billing_period_range" class="text-sm">Period</label>
                <x-form.date-picker name="billing_period_range" wire:model.live="billing_period_range" mode="range"
                    :month-picker="true" date-format="Y-m" alt-format="M Y"
                    class="border border-black/20 rounded px-2 py-1.5 text-sm mx-0.5" placeholder="Select Period" />
            </div>

            <div class="flex items-center gap-3">
                <div>
                    <label for="statusFilter" class="text-sm">Status</label>
                    <select id="statusFilter" wire:model.live="payment_status"
                        class="border border-black/20 rounded p-2 text-sm mx-0.5">
                        <option value="any">Any</option>
                        <option value="paid">Paid</option>
                        <option value="unpaid">Unpaid</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>

                <div>
                    <label for="perPageSelector" class="text-sm">Show</label>
                    <select id="perPageSelector" wire:model.live="perPage"
                        class="border border-black/20 rounded p-2 text-sm mx-0.5">
                        @foreach ($perPageOptions as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                    <label class="text-sm">entries.</label>
                </div>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left rounded-lg overflow-hidden">
            <thead class="bg-[#007E41] text-white text-sm select-none">
                <tr>
                    <th wire:click="sort('status')" class="px-6 py-3 cursor-pointer">
                        Status
                        @if ($sortBy === 'status')
                            <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </th>
                    <th wire:click="sort('customer_name')" class="px-6 py-3 cursor-pointer">
                        Customer Name
                        @if ($sortBy === 'customer_name')
                            <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </th>
                    <th wire:click="sort('invoice_number')" class="px-6 py-3 cursor-pointer">
                        Number
                        @if ($sortBy === 'invoice_number')
                            <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </th>
                    <th wire:click="sort('billing_period')" class="px-6 py-3 cursor-pointer">
                        Period
                        @if ($sortBy === 'billing_period')
                            <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3">Total</th>
                    <th scope="col" class="px-6 py-3 text-center">Payment Date</th>
                    <th scope="col" class="px-6 py-3 text-center">Payment Type</th>
                </tr>
            </thead>
            <tbody class="*:even:bg-gray-100">
                @forelse ($invoices as $invoice)
                    <tr wire:key="invoice-row-{{ $invoice->id }}" class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 uppercase font-semibold text-xs">
                            <span
                                class="px-2 py-0.5 rounded-sm text-white
                                {{ $invoice->status === 'paid' ? 'bg-green-500' : ($invoice->status === 'unpaid' ? 'bg-red-500' : 'bg-gray-400') }}">
                                {{ $invoice->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900">
                            {{ $invoice->customer?->user?->name ?? 'Unknown User' }}
                        </td>
                        <td class="px-6 py-4 font-mono uppercase text-xs text-gray-600">
                            {{ $invoice->invoice_number }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ month_year($invoice->billing_period) }}
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap">
                            {{ rupiah($invoice->grand_total) }}
                        </td>
                        <td class="px-6 py-4 text-center text-gray-500">—</td>
                        <td class="px-6 py-4 text-center text-gray-500">—</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400 italic">
                            No matching invoice milestones located...
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $invoices->links() }}
    </div>

    {{-- Create Modal --}}
    <x-modal show="showModal" size="xl" closeable=1>
        <x-slot:header>
            <h2 class="text-lg font-semibold">
                Create Invoice
            </h2>
            <p class="text-xs text-gray-500">
                Create new Invoice
            </p>
        </x-slot:header>

        <form id="CreateForm" wire:submit.prevent="save" class="pb-6 px-6 space-y-3 text-sm">

            <x-form.search-select name="customer_id" label="Customer" wire:model="customer_id" :options="$customers"
                placeholder="Select a customer..." />

            <x-form.input-group name="due_date" wire:model="due_date" label="Due Date" Suffix="Days"
                placeholder="How many days you want this invoice due?" />

            <div class="space-y-3">
                <div class="border-b border-gray-200 pb-2 mb-4 font-semibold text-gray-700">
                    Invoice Items
                </div>

                <table class="w-full table-fixed">
                    <thead>
                        <th class="text-center pl-15 w-[16.5%]">#</th>
                        <th class="text-center w-[33%]">Name</th>
                        <th class="text-center w-[7%]">Unit</th>
                        <th class="text-center w-[18%]">Price</th>
                        <th class="text-center w-[18%]">Total Price</th>
                        <th class="text-center w-[7.5%]">Remove</th>
                    </thead>
                </table>

                @foreach ($items as $index => $item)
                    <x-form.form-row :label="'Item ' . ($index + 1)">

                        <div class="flex-1 w-full">
                            <x-form.input-group name="items.{{ $index }}.name"
                                wire:model="items.{{ $index }}.name" placeholder="Item description..."
                                :label="false" />
                        </div>

                        <div class="w-full sm:w-12">
                            <x-form.input-group name="items.{{ $index }}.quantity"
                                wire:model.live.debounce.500ms="items.{{ $index }}.quantity" placeholder="0"
                                :label="false" />
                        </div>

                        <div class="w-full sm:w-34">
                            <x-form.input-group name="items.{{ $index }}.unit_price"
                                wire:model.live.debounce.500ms="items.{{ $index }}.unit_price" prefix="Rp"
                                placeholder="0" :label="false" />
                        </div>

                        <div class="w-full sm:w-34">
                            <x-form.input-group name="items.{{ $index }}.total_price"
                                wire:model="items.{{ $index }}.total_price" class="bg-gray-200 text-gray-700"
                                prefix="Rp" placeholder="0" :label="false" disabled />
                        </div>

                        <x-button variant="danger" wire:click="removeItem({{ $index }})">
                            <span class="material-symbols-outlined block">delete</span>
                        </x-button>

                    </x-form.form-row>
                @endforeach

                <div class="flex flex-col lg:flex-row items-start lg:gap-4 mt-4">
                    <div class="w-full flex items-center justify-center">
                        <x-button variant="secondary" wire:click="addItem">Add Another Item</x-button>
                    </div>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row items-center lg:gap-4 mt-6 pt-4 border-t border-gray-100">
                <div class="lg:w-[30%] lg:text-right hidden lg:block">
                    <span class="text-gray-500 font-semibold">Total Amount:</span>
                </div>

                <div
                    class="w-full lg:w-[70%] flex justify-between items-center sm:justify-end sm:gap-6 bg-gray-50 px-4 py-3 rounded-lg">
                    <span class="text-gray-500 font-semibold lg:hidden">Total Amount:</span>

                    <span class="text-xl font-bold text-gray-900">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </form>

        <x-slot:footer>
            <x-button type="button" variant="secondary" wire:click="closeModal" loadingTarget="save">
                Cancel
            </x-button>

            <x-button type="submit" variant="primary" form="CreateForm" loadingTarget="save"
                loadingText="Saving...">
                Save
            </x-button>
        </x-slot:footer>
    </x-modal>

    <x-toast />
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
