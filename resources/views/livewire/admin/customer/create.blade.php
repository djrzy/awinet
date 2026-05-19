<div x-data="{ confirmSubmit: false, success: false }" x-on:internet-plan-created.window="success = true; setTimeout(() => success = false, 3000)"
    class="bg-white w-full rounded-lg p-2 shadow-sm">
    <form @submit.prevent="confirmSubmit = true">
        <div class="mx-auto space-y-3 py-4 px-6 text-sm lg:w-[75%] 2xl:w-[45%]">
            <div class="w-full flex flex-col lg:items-center">
                <div class="w-full relative flex flex-col lg:flex-row lg:gap-3">
                    <label for="name" class="lg:w-[15%] lg:text-right">Name</label>
                    <input type="text" wire:model="name" id="name"
                        class="border border-black/20 w-full lg:w-[85%] py-1 px-2 rounded-sm focus:outline-none focus:ring-primary focus:ring-2 @error('name')
                            ring-red-500 ring-1
                        @enderror">
                    <div class="absolute translate-y-1/2 bottom-[30%] lg:bottom-1/2 right-2">
                        @error('name')
                            <span class="material-symbols-outlined text-red-600! text-lg!">
                                report
                            </span>
                        @enderror
                    </div>
                </div>
                @error('name')
                    <div class="text-end w-full text-xs text-red-500 mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="w-full flex flex-col lg:items-center">
                <div class="w-full relative flex flex-col lg:flex-row lg:gap-3">
                    <label for="email" class="lg:w-[15%] lg:text-right">Email</label>
                    <input type="text" wire:model="email" id="email"
                        class="border border-black/20 w-full lg:w-[85%] py-1 px-2 rounded-sm focus:outline-none focus:ring-primary focus:ring-2 @error('email')
                            ring-red-500 ring-1
                        @enderror">
                    <div class="absolute translate-y-1/2 bottom-[30%] lg:bottom-1/2 right-2">
                        @error('email')
                            <span class="material-symbols-outlined text-red-600! text-lg!">
                                report
                            </span>
                        @enderror
                    </div>
                </div>
                @error('email')
                    <div class="text-end w-full text-xs text-red-500 mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="w-full flex flex-col lg:items-center">
                <div class="w-full relative flex flex-col lg:flex-row lg:gap-3">
                    <label for="phone" class="lg:w-[15%] lg:text-right">Phone</label>
                    <input type="text" wire:model="phone" id="phone"
                        class="border border-black/20 w-full lg:w-[85%] py-1 px-2 rounded-sm focus:outline-none focus:ring-primary focus:ring-2
                        @error('phone')
                            ring-red-500 ring-1
                        @enderror">
                    <div class="absolute translate-y-1/2 bottom-[30%] lg:bottom-1/2 right-2">
                        @error('phone')
                            <span class="material-symbols-outlined text-red-600! text-lg!">
                                report
                            </span>
                        @enderror
                    </div>
                </div>
                @error('phone')
                    <div class="text-end w-full text-xs text-red-500 mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="w-full flex flex-col lg:items-center">
                <div class="w-full relative flex flex-col lg:flex-row lg:gap-3">
                    <label for="nik" class="lg:w-[15%] lg:text-right">NIK</label>
                    <input type="text" wire:model="nik" id="nik"
                        class="border border-black/20 w-full lg:w-[85%] py-1 px-2 rounded-sm focus:outline-none focus:ring-primary focus:ring-2
                        @error('nik')
                            ring-red-500 ring-1
                        @enderror">
                    <div class="absolute translate-y-1/2 bottom-[30%] lg:bottom-1/2 right-2">
                        @error('nik')
                            <span class="material-symbols-outlined text-red-600! text-lg!">
                                report
                            </span>
                        @enderror
                    </div>
                </div>
                @error('nik')
                    <div class="text-end w-full text-xs text-red-500 mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="w-full flex flex-col lg:items-center">
                <div class="w-full relative flex flex-col lg:flex-row lg:gap-3">
                    <label for="address" class="lg:w-[15%] lg:text-right">Address</label>
                    <textarea wire:model="address" id="address" cols="30" rows="5"
                        class="border border-black/20 w-full lg:w-[85%] py-1 px-2 rounded-sm focus:outline-none focus:ring-primary focus:ring-2
                        @error('address')
                            ring-red-500 ring-1
                        @enderror"></textarea>
                    <div class="absolute translate-y-1/2 bottom-[30%] lg:bottom-1/2 right-2">
                        @error('address')
                            <span class="material-symbols-outlined text-red-600! text-lg!">
                                report
                            </span>
                        @enderror
                    </div>
                </div>
                @error('address')
                    <div class="text-end w-full text-xs text-red-500 mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="w-full flex flex-col lg:items-center">
                <div class="w-full relative flex flex-col lg:flex-row lg:gap-3">
                    <label for="postal_code" class="lg:w-[15%] lg:text-right">Postal Code</label>
                    <input type="text" wire:model="postal_code" id="postal_code"
                        class="border border-black/20 w-full lg:w-[85%] py-1 px-2 rounded-sm focus:outline-none focus:ring-primary focus:ring-2
                        @error('postal_code')
                            ring-red-500 ring-1
                        @enderror">
                    <div class="absolute translate-y-1/2 bottom-[30%] lg:bottom-1/2 right-2">
                        @error('postal_code')
                            <span class="material-symbols-outlined text-red-600! text-lg!">
                                report
                            </span>
                        @enderror
                    </div>
                </div>
                @error('postal_code')
                    <div class="text-end w-full text-xs text-red-500 mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="w-full flex flex-col lg:items-center">
                <div class="w-full relative flex flex-col lg:flex-row lg:gap-3">
                    <label for="postal_code" class="lg:w-[15%] lg:text-right">Location Base On Map</label>
                    <div wire:ignore x-data="mapPicker()" x-init="initMap()"
                        class="space-y-2 w-full lg:w-[85%] ">

                        <div id="map" class="h-100 rounded-md w-full"></div>

                        <div class="grid grid-cols-2 gap-2">
                            <input type="hidden" wire:model="latitude" x-model="lat" class="border p-2">

                            <input type="hidden" wire:model="longitude" x-model="lng" class="border p-2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end pr-6 pb-4">
            <button type="submit" class="bg-primary text-white px-4 py-1.5 rounded-md cursor-pointer">
                Add Customer
            </button>
        </div>
    </form>
    <div x-show="confirmSubmit" x-transition x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

        <div @click.outside="confirmSubmit = false" class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md">

            <h2 class="text-lg font-semibold">
                Are you sure you want to create this customer?
            </h2>

            <p class="text-sm text-gray-500 mt-2">
                Please make sure all the data you have provided is correct.
            </p>

            <div class="flex justify-end gap-2 mt-6">

                <button type="button" @click="confirmSubmit = false"
                    class="px-4 py-2 rounded-md border cursor-pointer">
                    Cancel
                </button>

                <button type="button"
                    @click="
                    confirmSubmit = false;
                    $wire.save();
                "
                    class="px-4 py-2 rounded-md bg-primary text-white cursor-pointer">
                    Confirm
                </button>

            </div>

        </div>
    </div>
    <div x-show="success" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="translate-x-full opacity-0" x-cloak class="fixed top-15 right-6 z-9999">
        <div class="bg-white px-4 py-3 rounded-lg shadow-lg flex gap-3 items-center">
            <span class="material-symbols-outlined text-green-500! text-3xl!">
                check_circle
            </span>
            <div class="flex flex-col">
                <p class="font-semibold text-sm uppercase">Customer created</p>
                <p class="">Customer created successfully.</p>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        Alpine.data('mapPicker', () => ({
            map: null,
            marker: null,

            lat: null,
            lng: null,

            defaultLat: -1.5489,
            defaultLng: 122.0149,
            defaultZoom: 4,

            initMap() {

                this.map = L.map('map').setView(
                    [this.defaultLat, this.defaultLng],
                    this.defaultZoom
                );

                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                }).addTo(this.map);

                this.map.on('click', (e) => {

                    const {
                        lat,
                        lng
                    } = e.latlng;

                    this.updateCoordinate(lat, lng);
                });

                window.addEventListener('customer-created', () => {

                    this.resetMap();
                });
            },

            updateCoordinate(lat, lng) {

                this.lat = lat;
                this.lng = lng;

                $wire.set('latitude', this.lat, false);
                $wire.set('longitude', this.lng, false);

                if (!this.marker) {

                    this.marker = L.marker([lat, lng], {
                        draggable: true
                    }).addTo(this.map);

                    this.marker.on('dragend', (e) => {

                        const position = e.target.getLatLng();

                        this.lat = position.lat;
                        this.lng = position.lng;

                        $wire.set('latitude', this.lat, false);
                        $wire.set('longitude', this.lng, false);
                    });

                } else {

                    this.marker.setLatLng([lat, lng]);
                }
            },

            resetMap() {

                this.lat = null;
                this.lng = null;

                if (this.marker) {

                    this.map.removeLayer(this.marker);

                    this.marker = null;
                }

                this.map.setView(
                    [this.defaultLat, this.defaultLng],
                    this.defaultZoom
                );
            }
        }))
    </script>
@endscript
