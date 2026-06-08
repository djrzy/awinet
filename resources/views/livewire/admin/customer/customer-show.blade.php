<div>
    <div x-data="{ actionOpen: false }" class="w-full bg-gray-200 flex justify-end rounded-md mb-6">
        <div class="relative">
            <button @click="actionOpen = !actionOpen"
                class='pr-2 pl-4 py-1 my-2 mr-2 border rounded-lg bg-white flex items-center gap-1 cursor-pointer'>
                Actions
                <span class="material-symbols-outlined">
                    arrow_drop_down
                </span>
            </button>
            <div x-show="actionOpen" @click.away="actionOpen = false"
                class="absolute bg-white overflow-hidden *:px-4 *:py-2 shadow-md text-sm rounded-md w-[160%] right-2 z-20 *:hover:bg-primary *:hover:text-white">
                <a href="#" class="block">Disable User Login</a>
            </div>
        </div>
        <div>
            <button wire:click="delete" wire:confirm="Are you sure?"
                class='px-4 py-1 my-2 mr-2 border border-black rounded-lg bg-red-500 text-white cursor-pointer'>
                Delete Customer
            </button>
        </div>
    </div>

    <div x-data="{
        confirmSubmit: false,
        success: false
    }"
        x-on:customer-updated.window="
            success = true;

            setTimeout(() => {
                success = false
            }, 3000)
        ">

        <form wire:submit="save">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- GENERAL INFORMATION --}}
                <div class="border border-black/20 rounded-md p-4">

                    <h1 class="font-semibold text-lg">
                        General Information
                    </h1>

                    <div class="space-y-3 lg:px-4 text-sm mt-6">

                        {{-- NAME --}}
                        <x-form.input-group name="name" label="Name" wire:model.defer="name" />

                        {{-- EMAIL --}}

                        <x-form.input-group name="email" label="Email" type="email" wire:model.defer="email" />

                        {{-- PHONE --}}
                        <x-form.input-group name="phone" label="Phone" wire:model.defer="phone" />

                        {{-- NIK --}}
                        <x-form.input-group name="nik" label="NIK" wire:model.defer="nik" />

                        {{-- ADDRESS --}}
                        <x-form.textarea name="address" label="Address" wire:model.defer="address" rows="4"
                            class="resize-none" />

                        {{-- POSTAL CODE --}}
                        {{-- <div class="w-full flex flex-col lg:items-center">

                            <div class="w-full relative flex flex-col lg:flex-row lg:gap-3">

                                <label for="postal_code" class="lg:w-[20%] lg:text-right">
                                    Postal Code
                                </label>

                                <input type="text" id="postal_code" wire:model.defer="postal_code"
                                    class="border border-black/20 w-full lg:w-[80%] py-1 px-2 rounded-sm focus:outline-none focus:ring-primary focus:ring-2">

                            </div>

                        </div> --}}
                        <x-form.input-group name="postal_code" label="Postal Code" wire:model.defer="postal_code" />

                    </div>

                </div>

                {{-- MAP --}}
                <div class="border border-black/20 rounded-md p-4">

                    <h1 class="font-semibold text-lg">
                        Location Based On Maps
                    </h1>

                    <div wire:ignore x-data="mapPicker({

                        id: 'customer-map',

                        lat: @entangle('latitude'),
                        lng: @entangle('longitude'),

                        zoom: 17
                    })" x-init="init()" class="space-y-2 w-full">

                        <div x-ref="map" class="h-90 rounded-md w-full bg-gray-100"></div>

                        <input type="hidden" wire:model="latitude" x-model="lat">

                        <input type="hidden" wire:model="longitude" x-model="lng">

                    </div>

                </div>

            </div>

            {{-- ACTION BUTTON --}}
            <div class="flex justify-end pr-2 pb-4">

                <button type="button" @click="confirmSubmit = true"
                    class="bg-primary text-white px-4 py-1.5 rounded-md cursor-pointer mt-6">

                    Update Customer

                </button>

            </div>

            {{-- CONFIRM MODAL --}}
            <div x-show="confirmSubmit" x-transition x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

                <div @click.outside="confirmSubmit = false" class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md">

                    <h2 class="text-lg font-semibold">
                        Update customer?
                    </h2>

                    <p class="text-sm text-gray-500 mt-2">
                        Please make sure all data is correct.
                    </p>

                    <div class="flex justify-end gap-2 mt-6">

                        <button type="button" @click="confirmSubmit = false"
                            class="px-4 py-2 rounded-md border cursor-pointer">

                            Cancel

                        </button>

                        <button type="submit" @click="confirmSubmit = false"
                            class="px-4 py-2 rounded-md bg-primary text-white cursor-pointer">

                            Confirm

                        </button>

                    </div>

                </div>

            </div>

            {{-- SUCCESS TOAST --}}
            <div x-show="success" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-full opacity-0"
                x-cloak class="fixed top-15 right-6 z-9999">

                <div class="bg-white px-4 py-3 rounded-lg shadow-lg flex gap-3 items-center">

                    <span class="material-symbols-outlined text-green-500! text-3xl!">
                        check_circle
                    </span>

                    <div class="flex flex-col">

                        <p class="font-semibold text-sm uppercase">
                            Customer updated
                        </p>

                        <p>
                            Customer updated successfully.
                        </p>

                    </div>

                </div>

            </div>

        </form>

    </div>
</div>
