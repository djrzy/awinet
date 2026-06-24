<div class="relative p-2">
    <div class="mt-2 mb-2 flex flex-wrap justify-between items-center px-1 space-y-3">

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

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left rounded-lg overflow-hidden">
            <thead class="bg-[#007E41] text-white text-sm select-none">
                <tr>
                    <th wire:click="sort('customer_code')" class="px-6 py-3 cursor-pointer">
                        Customer Code
                        @if ($sortBy === 'customer_code')
                            <span>{{ $sortDirection === 'asc' ? ' ↑' : ' ↓' }}</span>
                        @endif
                    </th>
                    <th wire:click="sort('name')" class="px-6 py-3 cursor-pointer">
                        Name
                        @if ($sortBy === 'name')
                            <span>{{ $sortDirection === 'asc' ? ' ↑' : ' ↓' }}</span>
                        @endif
                    </th>
                    <th class="px-6 py-3">Phone Number</th>
                    <th class="px-6 py-3">Internet Plans</th>
                    <th class="px-6 py-3 text-center">Status</th>
                </tr>
            </thead>
            <tbody class="*:even:bg-gray-100">
                @forelse ($customers as $customer)
                    {{-- Added wire:key to keep Dom synchronization flawless during real-time filtering --}}
                    <tr wire:key="customer-row-{{ $customer->id }}"
                        class="bg-neutral-primary-soft hover:bg-[#007E41]/5 transition-colors duration-150">
                        <td class="px-6 py-4 font-mono text-xs text-gray-600">
                            {{ $customer->customer_code }}
                        </td>
                        <td class="px-6 py-4 font-medium whitespace-nowrap flex items-center gap-2">
                            <a href="{{ route('admin.customers.show', $customer) }}"
                                class="text-gray-900 hover:text-[#007E41] transition-colors">
                                {{ $customer->user?->name ?? 'Unknown User' }}
                            </a>

                            {{-- Optional condition tracking check: display flag tag context safely --}}
                            @if ($customer->created_at?->greaterThanOrEqualTo(now()->subDays(7)))
                                <div
                                    class="bg-yellow-500 rounded-sm text-white px-1 py-0.5 text-[10px] font-semibold tracking-wider">
                                    NEW
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            {{ $customer->user?->phone ?? '-' }}
                        </td>
                        <td class="px-6 py-4 font-mono text-xs">
                            {{ $customer->internet_plans_id ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="block rounded-sm px-2 py-0.5 uppercase text-center font-semibold text-xs select-none text-white {{ $customer->status === 'active' ? 'bg-green-500' : 'bg-gray-400' }}">
                                {{ $customer->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-400 italic">
                            No matching customer records discovered...
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $customers->links() }}
    </div>
</div>
