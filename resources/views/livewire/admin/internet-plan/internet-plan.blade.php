<div class="relative bg-neutral-primary-soft shadow-xs rounded-base p-2">
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
        {{-- <div class="relative">
            <input wire:model.live.debounce.350ms="search" type="text"
                class="py-1 px-2 border text-sm border-black/20 rounded-sm w-full placeholder:text-sm placeholder:text-gray-300 focus:outline-none focus:ring-2 focus:ring-[#007E41]"
                placeholder="Search..">
            <span class="material-symbols-outlined absolute -translate-y-1/2 top-1/2 right-2 text-lg!">
                search
            </span>
        </div> --}}
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
                    <th scope="col" class="px-6 py-3 cursor-pointer select-none">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer select-none">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Download Speed
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Upload Speed
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                </tr>
            </thead>
            <tbody class="*:even:bg-gray-100">
                @foreach ($plans as $plan)
                    <tr class="bg-neutral-primary-soft hover:bg-neutral-secondary-medium hover:bg-[#007E41]/7.5">
                        <td class="px-6 py-4">
                            {{ $loop->iteration }}
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap flex items-center gap-2">
                            <a href="{{ route('admin.customers.show', $plan) }}"
                                class="hover:text-black/50">{{ $plan->name }}</a>
                        </th>
                        <td class="px-6 py-4">
                            {{ $plan->price }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $plan->download_speed }} Mbps
                        </td>
                        <td class="px-6 py-4">
                            {{ $plan->upload_speed }} Mbps
                        </td>
                        <td class="px-6 py-4">
                            {{ $plan->description }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- {{ $plans->links() }} --}}
</div>
