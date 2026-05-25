<div x-data="toast" x-on:notify.window="showToast($event)"
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

        <x-button type="button" wire:click="create" variant="primary">Add Internet Plan</x-button>
    </div>

    {{-- Create Edit Modal --}}
    <x-modal show="showModal" maxWidth="2xl" closeable=1>
        <x-slot:header>
            <h2 class="text-lg font-semibold">
                {{ $isEdit ? 'View/Edit Internet Plan' : 'Add Internet Plan' }}
            </h2>
            <p class="text-xs text-gray-500">
                {{ $isEdit ? 'Complete information of selected internet plan' : 'Create new Internet Plan' }}
            </p>
        </x-slot:header>

        <form id="CreateUpdateForm" wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}"
            class="pb-6 px-6 space-y-3 text-sm">
            @if ($isEdit && $selectedPlan)
                <div class="grid grid-cols-2 gap-4">

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

            <x-form.input-group type="text" name="name" wire:model="name" />
            <x-form.input-group type="text" name="price" prefix="Rp" wire:model="price" />
            <x-form.input-group type="text" name="download_speed" suffix="Mbps" wire:model="download_speed" />
            <x-form.input-group type="text" name="upload_speed" suffix="Mbps" wire:model="upload_speed" />
            <x-form.select name="service_type" wire:model="service_type">
                <option value="">
                    Select Service Type
                </option>

                @foreach ($serviceTypes as $value => $label)
                    <option value="{{ $value }}">
                        {{ $label }}
                    </option>
                @endforeach
            </x-form.select>

            @if ($isEdit)
                <x-form.select name="status" wire:model.live="status">
                    <option value="1">
                        Active
                    </option>

                    <option value="0">
                        Inactive
                    </option>
                </x-form.select>
            @endif

            <x-form.textarea name="description" wire:model="description" rows="4" class="resize-none" />
        </form>

        <x-slot:footer>
            <x-button type="button" variant="secondary" wire:click="closeModal"
                loadingTarget="{{ $isEdit ? 'update' : 'save' }}">
                Cancel
            </x-button>

            <x-button type="submit" variant="primary" form="CreateUpdateForm"
                loadingTarget="{{ $isEdit ? 'update' : 'save' }}"
                loadingText="{{ $isEdit ? 'Updating...' : 'Saving...' }}">
                {{ $isEdit ? 'Update' : 'Save' }}
            </x-button>
        </x-slot:footer>
    </x-modal>

    {{-- Delete Modal --}}
    <x-modal show="showDeleteModal" maxWidth="md" closeable=0>
        <x-slot:header>
            <div class="flex items-center gap-3">
                <div>
                    <h2 class="text-lg font-semibold">
                        Delete Internet Plan
                    </h2>
                    <p class="text-sm text-gray-500">
                        This action cannot be undone.
                    </p>
                </div>
            </div>
        </x-slot:header>

        <p class="text-lg text-gray-600">
            Are you sure you want to delete
            <span class="font-semibold">
                {{ $selectedPlan?->name }}
            </span>?
        </p>

        <x-slot:footer>
            <x-button type="button" variant="secondary" wire:click="closeDeleteModal">Cancel</x-button>
            <x-button type="button" variant="danger" wire:click="delete">Delete</x-button>
        </x-slot:footer>
    </x-modal>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left rounded-lg overflow-hidden">
            <thead class="bg-[#007E41] text-white">
                <tr>
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Price</th>
                    <th class="px-6 py-3">Download/Upload Speed</th>
                    <th class="px-6 py-3">Service Type</th>
                    <th class="px-6 py-3">Description</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Action</th>
                </tr>
            </thead>

            <tbody class="*:even:bg-gray-100">
                @forelse ($plans as $plan)
                    <tr class="hover:bg-[#007E41]/5 transition">
                        <td class="px-6 py-4">{{ $plans->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-4 font-semibold">{{ $plan->name }}</td>
                        <td class="px-6 py-4">{{ $plan->price_formatted }}</td>
                        <td class="px-6 py-4">{{ $plan->download_speed }}/{{ $plan->upload_speed }} Mbps</td>
                        <td class="px-6 py-4 capitalize">
                            {{ $plan->service_type === 'pppoe' ? 'PPPoE' : $plan->service_type }}</td>
                        <td class="px-6 py-4">{{ $plan->description }}</td>
                        <td class="px-6 py-4 text-white">
                            @if ($plan->status)
                                <span class="bg-green-500 rounded-sm px-4 py-1 font-semibold">Active</span>
                            @else
                                <span class="bg-red-500 rounded-sm px-4 py-1 font-semibold">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-3">
                                <button type="button" wire:click="viewEdit({{ $plan->id }})"
                                    class="text-gray-400 hover:text-cyan-600 cursor-pointer">
                                    <span class="material-symbols-outlined">
                                        visibility
                                    </span>
                                </button>

                                <button type="button" wire:click="confirmDelete({{ $plan->id }})"
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

    {{-- Toast --}}
    <x-toast />

    <div class="mt-4">
        {{ $plans->links() }}
    </div>
</div>
