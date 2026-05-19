<div x-data="{
    showForm: false,
    showViewModal: @entangle('showViewModal'),
    success: false,
    successDelete: false
}"
    x-on:internet-plan-created.window="
        showForm = false;
        success = true;
        setTimeout(() => success = false, 3000)
    "
    x-on:internet-plan-deleted.window="
        successDelete = true;
        setTimeout(() => successDelete = false, 3000)
    "
    class="relative bg-neutral-primary-soft shadow-xs rounded-base p-2">
    {{-- Header --}}
    <div class="mt-2 mb-2 flex flex-wrap justify-between items-center px-1 gap-3">
        <div>
            <label class="text-sm">Show</label>

            <select wire:model.live="perPage" class="border border-black/20 rounded p-2 text-sm mx-1">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>

            <label class="text-sm">entries.</label>
        </div>

        <button type="button" @click="showForm = true"
            class="bg-primary rounded-md text-white py-2 px-4 hover:bg-primary/80 focus:outline-none focus:ring-2 focus:ring-primary/50 transition cursor-pointer">
            Add Internet Plan
        </button>
    </div>

    {{-- Modal --}}
    <div x-show="showForm" x-transition x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4">
        <div @click.outside="showForm = false" class="bg-white rounded-lg shadow-xl w-full max-w-2xl overflow-hidden">
            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4">
                <h2 class="text-lg font-semibold">
                    Add Internet Plan
                </h2>

                <button type="button" @click="showForm = false"
                    class="text-gray-500 hover:text-gray-700 cursor-pointer">
                    <span class="material-symbols-outlined">
                        close
                    </span>
                </button>
            </div>

            {{-- Form --}}
            <form wire:submit.prevent="save" class="pt-3 pb-6 px-12 space-y-3 text-sm">

                {{-- Name --}}
                <div class="flex items-start gap-4">
                    <label for="name" class="w-[30%] text-right pt-2">
                        Name
                    </label>

                    <div class="w-[70%]">
                        <input type="text" id="name" wire:model="name"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">

                        @error('name')
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                {{-- Price --}}
                <div class="flex items-start gap-4">
                    <label for="price" class="w-[30%] text-right pt-2">
                        Price
                    </label>

                    <div class="w-[70%]">
                        <div class="flex">
                            <span
                                class="bg-gray-200 px-3 flex items-center rounded-l-md border border-r-0 border-gray-300">
                                Rp
                            </span>

                            <input type="text" id="price" wire:model="price"
                                class="w-full border border-gray-300 rounded-r-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>

                        @error('price')
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                {{-- Download Speed --}}
                <div class="flex items-start gap-4">
                    <label class="w-[30%] text-right pt-2">
                        Download Speed
                    </label>

                    <div class="w-[70%]">
                        <div class="flex">
                            <input type="text" wire:model="download_speed"
                                class="w-full border border-gray-300 rounded-l-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">

                            <span
                                class="bg-gray-200 px-3 flex items-center rounded-r-md border border-l-0 border-gray-300">
                                Mbps
                            </span>
                        </div>

                        @error('download_speed')
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                {{-- Upload Speed --}}
                <div class="flex items-start gap-4">
                    <label class="w-[30%] text-right pt-2">
                        Upload Speed
                    </label>

                    <div class="w-[70%]">
                        <div class="flex">
                            <input type="text" wire:model="upload_speed"
                                class="w-full border border-gray-300 rounded-l-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">

                            <span
                                class="bg-gray-200 px-3 flex items-center rounded-r-md border border-l-0 border-gray-300">
                                Mbps
                            </span>
                        </div>

                        @error('upload_speed')
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                {{-- Service Type --}}
                <div class="flex items-start gap-4">
                    <label class="w-[30%] text-right pt-2">
                        Service Type
                    </label>

                    <div class="w-[70%]">
                        <select wire:model="service_type"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="">Select Service Type</option>
                            <option value="pppoe">PPPoE</option>
                            <option value="dedicated">Dedicated</option>
                            <option value="static">Static</option>
                            <option value="hotspot">Hotspot</option>
                        </select>

                        @error('service_type')
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                {{-- Description --}}
                <div class="flex items-start gap-4">
                    <label class="w-[30%] text-right pt-2">
                        Description
                    </label>

                    <textarea wire:model="description" rows="3"
                        class="w-[70%] border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
                </div>

                {{-- Footer --}}
                <div class="flex justify-end gap-2 pt-6 -mx-6">
                    <button type="button" @click="showForm = false"
                        class="border rounded-md px-4 py-2 hover:bg-gray-100 transition cursor-pointer">
                        Cancel
                    </button>

                    <button type="submit"
                        class="bg-primary text-white rounded-md px-4 py-2 hover:bg-primary/80 transition cursor-pointer">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Success Toast --}}
    <div x-show="success" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="translate-x-full opacity-0" x-cloak class="fixed top-16 right-6 z-9999">
        <div class="bg-white px-4 py-3 rounded-lg shadow-lg flex gap-3 items-center max-w-sm">
            <span class="material-symbols-outlined text-green-500! text-3xl!">
                check_circle
            </span>

            <div>
                <p class="font-semibold text-sm uppercase">
                    Internet Plan Created
                </p>
                <p class="text-sm">
                    A new Internet Plan successfully created.
                </p>
            </div>
        </div>
    </div>

    {{-- Delete Toast --}}
    <div x-show="successDelete" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="translate-x-full opacity-0" x-cloak class="fixed top-16 right-6 z-9999">
        <div class="bg-white px-4 py-3 rounded-lg shadow-lg flex gap-3 items-center max-w-sm">
            <span class="material-symbols-outlined text-green-500! text-3xl!">
                check_circle
            </span>

            <div>
                <p class="font-semibold text-sm uppercase">
                    Internet Plan Deleted
                </p>
                <p class="text-sm">
                    The Internet Plan was successfully deleted.
                </p>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left rounded-lg overflow-hidden">
            <thead class="bg-[#007E41] text-white">
                <tr>
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Price</th>
                    <th class="px-6 py-3">Download</th>
                    <th class="px-6 py-3">Upload</th>
                    <th class="px-6 py-3">Service Type</th>
                    <th class="px-6 py-3">Description</th>
                    <th class="px-6 py-3">Action</th>
                </tr>
            </thead>

            <tbody class="*:even:bg-gray-100">
                @foreach ($plans as $plan)
                    <tr class="hover:bg-[#007E41]/5 transition">
                        <td class="px-6 py-4">
                            {{ $plans->firstItem() + $loop->index }}
                        </td>

                        <td class="px-6 py-4 font-semibold">
                            {{ $plan->name }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $plan->price_formatted }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $plan->download_speed }} Mbps
                        </td>

                        <td class="px-6 py-4">
                            {{ $plan->upload_speed }} Mbps
                        </td>

                        <td class="px-6 py-4 capitalize">
                            {{ $plan->service_type === 'pppoe' ? 'PPPoE' : $plan->service_type }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $plan->description }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex gap-3">
                                <button type="button" wire:click="viewPlan({{ $plan->id }})"
                                    class="text-gray-400 hover:text-cyan-600 cursor-pointer">
                                    <span class="material-symbols-outlined">
                                        visibility
                                    </span>
                                </button>

                                <button type="button" wire:click="delete({{ $plan->id }})"
                                    class="text-gray-400 hover:text-red-500 cursor-pointer">
                                    <span class="material-symbols-outlined">
                                        delete
                                    </span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- View Internet Plan Modal --}}
    <div x-show="showViewModal" x-transition x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4">
        <div @click.outside="showViewModal = false"
            class="bg-white rounded-lg shadow-xl w-full max-w-2xl overflow-hidden">
            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4">
                <div>
                    <h2 class="text-lg font-semibold">
                        View/Edit Internet Plan Detail
                    </h2>
                    <p class="text-xs text-gray-500">
                        Complete information of selected internet plan
                    </p>
                </div>

                <button type="button" @click="showViewModal = false"
                    class="text-gray-500 hover:text-gray-700 cursor-pointer">
                    <span class="material-symbols-outlined">
                        close
                    </span>
                </button>
            </div>

            {{-- Content --}}
            <div class="px-6 text-sm">

                @if ($selectedPlan)
                    <div class="grid grid-cols-2 gap-4">

                        {{-- Name --}}
                        <div class="space-y-1">
                            <p class="text-gray-700 text-xs uppercase">
                                Name
                            </p>

                            <input type="text" wire:model="name"
                                class="w-full border border-gray-300 border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary transition" />
                        </div>

                        {{-- Price --}}
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase">
                                Price
                            </p>

                            <div class="flex">
                                <span
                                    class="bg-gray-200 px-3 flex items-center rounded-l-md border border-r-0 border-gray-300">
                                    Rp
                                </span>

                                <input type="text" wire:model="price"
                                    class="w-full border border-gray-300 rounded-r-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary transition">
                            </div>
                        </div>

                        {{-- Download --}}
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase">
                                Download Speed
                            </p>

                            <div class="flex">
                                <input type="text" wire:model="download_speed"
                                    class="w-full border border-gray-300 rounded-l-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary transition" />
                                <span
                                    class="bg-gray-200 px-3 flex items-center rounded-r-md border border-l-0 border-gray-300">
                                    Mbps
                                </span>
                            </div>
                        </div>

                        {{-- Upload --}}
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase">
                                Upload Speed
                            </p>

                            <div class="flex">
                                <input type="text" wire:model="upload_speed"
                                    class="w-full border border-gray-300 rounded-l-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary transition" />
                                <span
                                    class="bg-gray-200 px-3 flex items-center rounded-r-md border border-l-0 border-gray-300">
                                    Mbps
                                </span>
                            </div>
                        </div>

                        {{-- Service Type --}}
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase">
                                Service Type
                            </p>

                            <select wire:model="service_type"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary transition">
                                <option value="pppoe">PPPoE</option>
                                <option value="dedicated">Dedicated</option>
                                <option value="static">Static</option>
                                <option value="hotspot">Hotspot</option>
                            </select>
                        </div>

                        {{-- Status --}}
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase">
                                Status
                            </p>

                            <select wire:model="status"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary transition">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                    </div>

                    {{-- Description --}}
                    <div class="mt-4 space-y-1">
                        <p class="text-gray-500 text-xs uppercase">
                            Description
                        </p>

                        <textarea wire:model="description" rows="4"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary transition"></textarea>
                    </div>

                    {{-- Metadata --}}
                    <div class="grid grid-cols-2 gap-4 mt-4">

                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase">
                                Created At
                            </p>

                            <div class="px-3">
                                {{ $selectedPlan->created_at?->format('d M Y H:i') }}
                            </div>
                        </div>

                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase">
                                Updated At
                            </p>

                            <div class="px-3">
                                {{ $selectedPlan->updated_at?->format('d M Y H:i') }}
                            </div>
                        </div>

                    </div>
                @endif
            </div>

            {{-- Footer --}}
            <div class="px-6
                                    py-4 flex justify-end space-x-3">
                <button type="button" @click="showViewModal = false"
                    class="border rounded-md px-4 py-2 hover:bg-gray-100 transition cursor-pointer">
                    Close
                </button>

                <button type="button" wire:click="update" wire:loading.attr="disabled" wire:target="update"
                    class="bg-primary text-white rounded-md px-4 py-2 hover:bg-primary/80 transition cursor-pointer">
                    <span wire:loading.remove wire:target="update">
                        Update
                    </span>

                    <span wire:loading wire:target="update">
                        Updating...
                    </span>
                </button>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $plans->links() }}
    </div>
</div>
