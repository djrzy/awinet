<div class="relative p-2">
    <div class="mt-2 mb-2 flex flex-wrap justify-between items-center px-1 space-y-3">
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
        <div>
            <label for="" class="text-sm">Show</label>
            <select wire:model.live="perPage" class="border border-black/20 rounded p-2 text-sm mx-0.5">

                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <label for="" class="text-sm">entries.</label>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left rounded-lg overflow-hidden">
            <thead class="bg-[#007E41] text-white text-sm">
                <tr>
                    <th wire:click="sort('customer_code')" class="px-6 py-3 cursor-pointer select-none">

                        Customer Code

                        @if ($sortBy === 'customer_code')
                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                        @endif
                    </th>
                    <th wire:click="sort('name')" scope="col" class="px-6 py-3 cursor-pointer select-none">
                        Name
                        @if ($sortBy === 'name')
                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Phone Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Internet Plans
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody class="*:even:bg-gray-100">
                @foreach ($customers as $customer)
                    <tr class="bg-neutral-primary-soft hover:bg-neutral-secondary-medium hover:bg-[#007E41]/7.5">
                        <td class="px-6 py-4">
                            {{ $customer->customer_code }}
                        </td>
                        <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap flex items-center gap-2">
                            <a href="{{ route('admin.customers.show', $customer) }}"
                                class="hover:text-black/50">{{ $customer->user->name }}</a>
                            <div
                                class="bg-yellow-500 rounded-sm text-white px-1 py-0.5 text-[10px] font-semibold select-none">
                                NEW
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            {{ $customer->user->phone }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $customer->internet_plans_id }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($customer->status === 'active')
                                <div
                                    class="bg-green-500 rounded-sm text-white px-1 py-0.5 uppercase text-center font-semibold select-none">
                                    {{ $customer->status }}
                                </div>
                            @else
                                <div
                                    class="bg-gray-400 rounded-sm text-white px-1 py-0.5 uppercase text-center font-semibold select-none">
                                    {{ $customer->status }}
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $customers->links() }}
</div>
