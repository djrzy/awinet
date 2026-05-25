<div>
    <h2 class="text-lg font-semibold mb-4">
        Internet Services
    </h2>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left rounded-lg overflow-hidden">
            <thead class="bg-[#007E41] text-white">
                <tr>
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Service Name</th>
                    <th class="px-6 py-3">Internet Plan</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Activation Date</th>
                    <th class="px-6 py-3">Action</th>
                </tr>
            </thead>

            <tbody class="*:even:bg-gray-100">
                @forelse ($customer->services as $service)
                    <tr class="hover:bg-[#007E41]/5 transition">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-semibold">{{ $service->service_name }}</td>
                        <td class="px-6 py-4">{{ $service->internet_plan->name }}</td>
                        <td class="px-6 py-4 text-white">
                            @if ($service->status === 'active')
                                <span
                                    class="bg-green-500 rounded-sm px-4 py-1 font-semibold uppercase">{{ $service->status }}</span>
                            @elseif ($service->status === 'suspended')
                                <span
                                    class="bg-red-500 rounded-sm px-4 py-1 font-semibold uppercase">{{ $service->status }}</span>
                            @elseif($service->status === 'pending')
                                <span
                                    class="bg-yellow-500 rounded-sm px-4 py-1 font-semibold uppercase">{{ $service->status }}</span>
                            @else
                                <span
                                    class="bg-gray-400 rounded-sm px-4 py-1 font-semibold uppercase">{{ $service->status }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($service->activation_date)->format('d F Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-3">
                                <button type="button" wire:click="viewEdit({{ $service->id }})" title="View Details"
                                    class="text-gray-400 hover:text-cyan-600 cursor-pointer">
                                    <span class="material-symbols-outlined">
                                        visibility
                                    </span>
                                </button>

                                @if ($service->status === 'pending' || $service->status === 'suspended')
                                    <button type="button" wire:click=""
                                        class="text-gray-400 hover:text-green-500 cursor-pointer">
                                        <span class="material-symbols-outlined">
                                            power
                                        </span>
                                    </button>
                                @elseif ($service->status === 'active')
                                    <button type="button" wire:click=""
                                        class="text-gray-400 hover:text-red-500 cursor-pointer">
                                        <span class="material-symbols-outlined">
                                            power_off
                                        </span>
                                    </button>
                                @endif

                                <button type="button" wire:click="confirmDelete({{ $service->id }})"
                                    class="text-gray-400 hover:text-red-500 cursor-pointer">
                                    <span class="material-symbols-outlined">
                                        delete
                                    </span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center">
                            No internet plans found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
