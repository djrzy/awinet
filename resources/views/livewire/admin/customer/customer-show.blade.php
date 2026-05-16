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
                <a href="#" class="block">Suspend Internet Connection</a>
                <a href="#" class="block">Activate Internet Connection</a>
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

                    <div class="space-y-3 px-4 text-sm mt-6">

                        {{-- NAME --}}
                        <div class="w-full flex flex-col lg:items-center">

                            <div class="w-full relative flex flex-col lg:flex-row lg:gap-3">

                                <label for="name" class="lg:w-[20%] lg:text-right">
                                    Name
                                </label>

                                <input type="text" id="name" wire:model.defer="name"
                                    class="border border-black/20 w-full lg:w-[80%] py-1 px-2 rounded-sm focus:outline-none focus:ring-primary focus:ring-2 @error('name') ring-red-500 ring-1 @enderror">

                                @error('name')
                                    <div class="absolute translate-y-1/2 bottom-[30%] lg:bottom-1/2 right-2">
                                        <span class="material-symbols-outlined text-red-600! text-lg!">
                                            report
                                        </span>
                                    </div>
                                @enderror

                            </div>

                            @error('name')
                                <div class="text-end w-full text-xs text-red-500 mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- EMAIL --}}
                        <div class="w-full flex flex-col lg:items-center">

                            <div class="w-full relative flex flex-col lg:flex-row lg:gap-3">

                                <label for="email" class="lg:w-[20%] lg:text-right">
                                    Email
                                </label>

                                <input type="email" id="email" wire:model.defer="email"
                                    class="border border-black/20 w-full lg:w-[80%] py-1 px-2 rounded-sm focus:outline-none focus:ring-primary focus:ring-2 @error('email') ring-red-500 ring-1 @enderror">

                            </div>

                            @error('email')
                                <div class="text-end w-full text-xs text-red-500 mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- PHONE --}}
                        <div class="w-full flex flex-col lg:items-center">

                            <div class="w-full relative flex flex-col lg:flex-row lg:gap-3">

                                <label for="phone" class="lg:w-[20%] lg:text-right">
                                    Phone
                                </label>

                                <input type="text" id="phone" wire:model.defer="phone"
                                    class="border border-black/20 w-full lg:w-[80%] py-1 px-2 rounded-sm focus:outline-none focus:ring-primary focus:ring-2">

                            </div>

                        </div>

                        {{-- NIK --}}
                        <div class="w-full flex flex-col lg:items-center">

                            <div class="w-full relative flex flex-col lg:flex-row lg:gap-3">

                                <label for="nik" class="lg:w-[20%] lg:text-right">
                                    NIK
                                </label>

                                <input type="text" id="nik" wire:model.defer="nik"
                                    class="border border-black/20 w-full lg:w-[80%] py-1 px-2 rounded-sm focus:outline-none focus:ring-primary focus:ring-2">

                            </div>

                        </div>

                        {{-- ADDRESS --}}
                        <div class="w-full flex flex-col lg:items-center">

                            <div class="w-full relative flex flex-col lg:flex-row lg:gap-3">

                                <label for="address" class="lg:w-[20%] lg:text-right">
                                    Address
                                </label>

                                <textarea id="address" rows="5" wire:model.defer="address"
                                    class="border border-black/20 w-full lg:w-[80%] py-1 px-2 rounded-sm focus:outline-none focus:ring-primary focus:ring-2"></textarea>

                            </div>

                        </div>

                        {{-- POSTAL CODE --}}
                        <div class="w-full flex flex-col lg:items-center">

                            <div class="w-full relative flex flex-col lg:flex-row lg:gap-3">

                                <label for="postal_code" class="lg:w-[20%] lg:text-right">
                                    Postal Code
                                </label>

                                <input type="text" id="postal_code" wire:model.defer="postal_code"
                                    class="border border-black/20 w-full lg:w-[80%] py-1 px-2 rounded-sm focus:outline-none focus:ring-primary focus:ring-2">

                            </div>

                        </div>

                    </div>

                </div>

                {{-- MAP --}}
                <div class="border border-black/20 rounded-md p-4">

                    <h1 class="font-semibold text-lg">
                        Location Based On Maps
                    </h1>

                    <div wire:ignore x-data="mapPicker()" x-init="initMap()" class="space-y-2 w-full">

                        <div x-ref="map" class="h-90 rounded-md w-full bg-gray-100">
                        </div>

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

                        <button type="button" @click="confirmSubmit = false" class="px-4 py-2 rounded-md border">

                            Cancel

                        </button>

                        <button type="submit" @click="confirmSubmit = false"
                            class="px-4 py-2 rounded-md bg-primary text-white">

                            Confirm

                        </button>

                    </div>

                </div>

            </div>

            {{-- SUCCESS TOAST --}}
            <div x-show="success" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-x-full opacity-0"
                x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="translate-x-0 opacity-100"
                x-transition:leave-end="translate-x-full opacity-0" x-cloak class="fixed top-15 right-6 z-[9999]">

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

@script
    <script>
        Alpine.data('mapPicker', () => ({

            map: null,
            marker: null,

            lat: @entangle('latitude'),
            lng: @entangle('longitude'),

            defaultLat: @js($customer->latitude),
            defaultLng: @js($customer->longitude),

            defaultZoom: 17,

            initMap() {

                if (this.map) return;

                const lat = this.defaultLat ?? -6.2;
                const lng = this.defaultLng ?? 106.816666;

                this.map = L.map(this.$refs.map).setView(
                    [lat, lng],
                    this.defaultZoom
                );

                L.tileLayer(
                    'https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                    }
                ).addTo(this.map);

                setTimeout(() => {
                    this.map.invalidateSize();
                }, 100);

                if (this.defaultLat && this.defaultLng) {

                    this.createOrUpdateMarker(
                        this.defaultLat,
                        this.defaultLng
                    );
                }

                this.map.on('click', (e) => {

                    this.updateCoordinate(
                        e.latlng.lat,
                        e.latlng.lng
                    );
                });
            },

            updateCoordinate(lat, lng) {

                this.lat = lat;
                this.lng = lng;

                this.createOrUpdateMarker(lat, lng);

                this.map.panTo([lat, lng]);
            },

            createOrUpdateMarker(lat, lng) {

                if (!this.marker) {

                    this.marker = L.marker(
                        [lat, lng], {
                            draggable: true
                        }
                    ).addTo(this.map);

                    this.marker.on('dragend', (e) => {

                        const position = e.target.getLatLng();

                        this.updateCoordinate(
                            position.lat,
                            position.lng
                        );
                    });

                } else {

                    this.marker.setLatLng([lat, lng]);
                }
            }
        }))
    </script>
@endscript
