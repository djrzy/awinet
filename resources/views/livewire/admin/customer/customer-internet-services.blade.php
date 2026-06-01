<div x-data="toast" x-on:notify.window="showToast($event)">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold">
            Internet Services
        </h2>
        <div>
            <x-button type="button" wire:click="assign" variant="primary">
                Assign Service
            </x-button>
        </div>
    </div>
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
                            No services registered.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Toast --}}
    <x-toast />

    {{-- Modal --}}
    <x-modal show="showModal" maxWidth="xl" closeable=1>
        <x-slot:header>
            <h2 class="text-lg font-semibold">
                {{ $isEdit ? 'View/Edit Internet Plan' : 'Assign Internet Plan' }}
            </h2>
            <p class="text-xs text-gray-500">
                {{ $isEdit ? 'Complete information of selected internet plan' : 'Assign internet plan to customer' }}
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

            <x-form.input-group type="text" name="service_name" wire:model="service_name" />
            <x-form.input-group type="text" name="username" wire:model="username" />
            <x-form.input-group type="password" name="password" wire:model="password" />
            <x-form.select name="internet_plan_id" label="Internet Plan" wire:model="internet_plan_id">
                <option value="">
                    Select Internet Plan
                </option>

                @foreach ($this->internetPlans() as $id => $name)
                    <option value="{{ $id }}">
                        {{ $name }}
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

            <x-form.textarea name="installation_address" wire:model="installation_address" rows="3"
                class="resize-none" />
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

</div>
