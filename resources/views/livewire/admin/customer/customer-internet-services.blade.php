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
                        <td class="px-6 py-4">{{ $service->activation_date }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-3">
                                <button type="button" wire:click="viewEdit({{ $service->id }})" title="View Details"
                                    class="text-gray-400 hover:text-cyan-500 cursor-pointer">
                                    <span class="material-symbols-outlined text-xl!">
                                        edit_square
                                    </span>
                                </button>

                                <button type="button" wire:click="changePlan({{ $service->id }})" title="Change Plan"
                                    class="text-gray-400 hover:text-sky-500 cursor-pointer">
                                    <span class="material-symbols-outlined text-xl!">
                                        sync
                                    </span>
                                </button>

                                @if ($service->status === 'pending' || $service->status === 'suspended')
                                    <button type="button" wire:click="serviceStatus({{ $service->id }},'activate')"
                                        title="Activate Service"
                                        class="text-gray-400 hover:text-green-500 cursor-pointer">
                                        <span class="material-symbols-outlined text-xl!">
                                            power
                                        </span>
                                    </button>
                                @elseif ($service->status === 'active')
                                    <button type="button" wire:click="serviceStatus({{ $service->id }},'suspend')"
                                        title="Suspend Service" class="text-gray-400 hover:text-red-500 cursor-pointer">
                                        <span class="material-symbols-outlined text-xl!">
                                            power_off
                                        </span>
                                    </button>
                                @endif

                                <button type="button" wire:click="routerSettings({{ $service->id }})"
                                    title="Router Settings" class="text-gray-400 hover:text-teal-500 cursor-pointer">
                                    <span class="material-symbols-outlined text-xl!">
                                        settings
                                    </span>
                                </button>

                                {{-- <button type="button" wire:click="confirmDelete({{ $service->id }})"
                                    class="text-gray-400 hover:text-red-500 cursor-pointer">
                                    <span class="material-symbols-outlined">
                                        delete
                                    </span>
                                </button> --}}
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
    <x-modal show="showModal" maxWidth="xl" closeable=0>
        <x-slot:header>
            @if ($modalMode === 'assign')
                <h2 class="text-lg font-semibold">
                    Assign Internet Plan
                </h2>
                <p class="text-xs text-gray-500">
                    Assign internet plan to customer
                </p>
            @endif

            @if ($modalMode === 'view-edit')
                <h2 class="text-lg font-semibold">
                    View Customer Service
                </h2>
                <p class="text-xs text-gray-500">
                    Complete information of customer internet service
                </p>
            @endif

            @if ($modalMode === 'change-plan')
                <h2 class="text-lg font-semibold">
                    Change Internet Plan
                </h2>
                <p class="text-xs text-gray-500">
                    Change current customer internet plan
                </p>
            @endif

            @if ($modalMode === 'service-status')
                <h2 class="text-lg font-semibold">
                    Change Service Status
                </h2>
                <p class="text-xs text-gray-500">
                    Update the service status for this customer
                </p>
            @endif

            @if ($modalMode === 'router-settings')
                <h2 class="text-lg font-semibold">
                    Router Settings
                </h2>
                <p class="text-xs text-gray-500">
                    Manage router settings for this customer
                </p>
            @endif
        </x-slot:header>

        @if ($modalMode === 'assign')
            <form id="CreateServiceForm" wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}"
                class="px-1 lg:px-6 space-y-3 text-sm" x-data="{
                    similarAddress: @entangle('similar_address')
                }">

                <x-form.input-group type="text" name="service_name" wire:model="service_name" />
                <x-form.input-group type="text" name="username" wire:model="username" />
                <x-form.input-group type="password" name="password" wire:model="password" />
                <x-form.select name="internet_plan_id" label="Internet Plan" wire:model="internet_plan_id">
                    <option value="">
                        Select Internet Plan
                    </option>

                    @foreach ($internetPlans as $id => $name)
                        <option value="{{ $id }}">
                            {{ $name }}
                        </option>
                    @endforeach
                </x-form.select>

                <x-form.radio-button name="similar_address" wire:model.live="similar_address" label="Address"
                    direction="vertical" :options="[
                        1 => 'Use Customer Address',
                        0 => 'Different Installation Address',
                    ]" />

                <div x-show="similarAddress == '0'" x-cloak>

                    <x-form.textarea name="installation_address" wire:model="installation_address" rows="3"
                        class="resize-none" />

                    <div class="w-full relative flex flex-col lg:flex-row lg:gap-4 mt-3">
                        <label for="postal_code" class="lg:w-[30%] lg:text-right">Location Base On Map</label>
                        <div wire:ignore x-data="mapPicker({
                        
                            id: 'create-service-map',
                        
                            lat: @entangle('latitude'),
                            lng: @entangle('longitude'),
                        
                            zoom: 17
                        })" x-init="init()"
                            class="space-y-2 w-full lg:w-[70%]">

                            <div x-ref="map" class="h-70 rounded-md w-full bg-gray-100"></div>

                            <input type="hidden" wire:model="latitude" x-model="lat">

                            <input type="hidden" wire:model="longitude" x-model="lng">

                        </div>
                    </div>

                </div>

            </form>
        @endif

        @if ($modalMode === 'view-edit')
            <form id="CreateServiceForm" wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}"
                class="px-1 lg:px-6 space-y-3 text-sm" x-data="{
                    similarAddress: @entangle('similar_address')
                }">

                <x-form.input-group name="Customer Code" type="text" :value="$customer->customer_code" class="bg-gray-100"
                    disabled />
                <x-form.input-group name="Name" type="text" :value="$customer->user->name" class="bg-gray-100" disabled />
                <x-form.input-group type="text" name="service_name" wire:model="service_name" class="bg-gray-100"
                    disabled />
                <x-form.select name="internet_plan_id" label="Internet Plan" wire:model="internet_plan_id" disabled
                    class="appearance-none bg-gray-100">
                    @foreach ($internetPlans as $id => $name)
                        <option value="{{ $id }}">
                            {{ $name }}
                        </option>
                    @endforeach
                </x-form.select>

                <x-form.textarea name="installation_address" wire:model="installation_address" rows="3"
                    class="resize-none bg-gray-100" disabled />

                <div class="w-full relative flex flex-col lg:flex-row lg:gap-4 mt-3">
                    <label for="postal_code" class="lg:w-[30%] lg:text-right">Location Base On Map</label>
                    <div wire:ignore x-data="mapViewer({
                        id: 'customer-map',
                    
                        zoom: 17,
                    
                        markers: [{
                            lat: @js($latitude),
                            lng: @js($longitude),
                    
                            popup: 'Customer location',
                        }]
                    })" x-init="init()"
                        class="space-y-2 w-full lg:w-[70%]">
                        <div x-ref="map" class="h-70 rounded-md w-full bg-gray-100"></div>
                    </div>
                </div>

            </form>
        @endif

        @if ($modalMode === 'change-plan')

            <div class="px-1 lg:px-6 space-y-3 text-sm">

                <div>
                    <p class="text-xs text-gray-400 italic">
                        This action will change the customer's current internet plan to the new selected plan. Please
                        review the information before confirming the change. And the changes will be applied in the next
                        billing cycle.
                    </p>

                </div>
                <div>
                    <p class="text-xs text-gray-500">
                        Current Plan
                    </p>

                    <div class="font-semibold">
                        {{ $selectedService?->internet_plan?->name }}
                    </div>
                </div>

                <x-form.select name="internet_plan_id" label="New Internet Plan" wire:model="internet_plan_id">
                    <option value="">
                        Select Plan
                    </option>

                    @foreach ($internetPlans as $id => $name)
                        <option value="{{ $id }}">
                            {{ $name }}
                        </option>
                    @endforeach

                </x-form.select>

            </div>

        @endif

        @if ($modalMode === 'service-status')
            <div class="px-1 lg:px-6 space-y-3 text-sm">

                <div>
                    <p class="text-sm text-gray-500">
                        Service
                    </p>

                    <div class="font-semibold">
                        {{ $selectedService?->service_name }}
                    </div>
                </div>

                <div class="rounded-lg bg-yellow-50 p-4">

                    Are you sure want to

                    <span class="font-semibold capitalize">
                        {{ $statusAction }}
                    </span>

                    this service?

                </div>

            </div>
        @endif

        @if ($modalMode === 'router-settings')
            <div class="px-1 lg:px-6 space-y-3 text-sm">

                <x-form.select name="router_id" label="Router" wire:model="router_id">
                    <option value="">
                        Select Router
                    </option>
                </x-form.select>
                <x-form.input-group type="text" name="username" wire:model="username" />
                <x-form.input-group type="password" name="password" wire:model="password" />

            </div>
        @endif

        <x-slot:footer>

            <x-button type="button" variant="secondary" wire:click="closeModal">
                {{ $modalMode === 'view-edit' ? 'Close' : 'Cancel' }}
            </x-button>

            @if ($modalMode === 'assign')
                <x-button type="submit" form="CreateServiceForm">
                    Save
                </x-button>
            @elseif($modalMode === 'view-edit')
                {{-- <x-button type="submit" form="CreateServiceForm">
                    Update
                </x-button> --}}
            @elseif($modalMode === 'change-plan')
                <x-button>
                    Change Plan
                </x-button>
            @elseif($modalMode === 'service-status')
                <x-button>
                    Confirm
                </x-button>
            @elseif($modalMode === 'router-settings')
                <x-button>
                    Save Settings
                </x-button>
            @endif

        </x-slot:footer>
    </x-modal>

</div>
