@extends('layout.app')

@section('title', 'Customer Details')

@section('content')
    <div class="row">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined ">
                groups
            </span>
            <div class="flex flex-col">
                <p class="text-base font-normal
                {{-- text-gray-200 --}}
                ">
                    @hasSection('title')
                        @yield('title')
                    @else
                    @endif
                </p>
                <h1 class="text-xl font-semibold">
                    {{ $customer->user->name }} ({{ $customer->customer_code }})
                </h1>
            </div>
        </div>
    </div>
    <div x-data="{ tab: 'profile' }" class="row mt-4">

        {{-- TABS --}}
        <div class="flex gap-2">

            <button @click="tab = 'profile'"
                :class="tab === 'profile'
                    ?
                    'text-black bg-white rounded-t-lg shadow-[0_-1px_3px_-1px_rgba(0,0,0,0.1)] font-semibold' :
                    'text-gray-500'"
                class="px-4 py-2 transition cursor-pointer">
                Information
            </button>

            <button @click="tab = 'services'"
                :class="tab === 'services'
                    ?
                    'text-black bg-white rounded-t-lg shadow-[0_-1px_3px_-1px_rgba(0,0,0,0.1)] font-semibold' :
                    'text-gray-500'"
                class="px-4 py-2 transition cursor-pointer">
                Internet Services
            </button>

            <button @click="tab = 'invoices'"
                :class="tab === 'invoices'
                    ?
                    'text-black bg-white rounded-t-lg shadow-[0_-1px_3px_-1px_rgba(0,0,0,0.1)] font-semibold' :
                    'text-gray-500'"
                class="px-4 py-2 transition cursor-pointer">
                Invoices
            </button>

            <button @click="tab = 'tickets'"
                :class="tab === 'tickets'
                    ?
                    'text-black bg-white rounded-t-lg shadow-[0_-1px_3px_-1px_rgba(0,0,0,0.1)] font-semibold' :
                    'text-gray-500'"
                class="px-4 py-2 transition cursor-pointer">
                Tickets
            </button>

        </div>

        {{-- TAB CONTENTS --}}

        {{-- PROFILE --}}
        <div x-show="tab === 'profile'" class="bg-white rounded-b-lg rounded-tr-lg shadow p-4">

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
            </div>
            <div class="grid grid-cols-2 gap-6 px-2">
                <div class="border border-black/20 rounded-md p-4">
                    <h1 class="font-semibold text-lg">General Information</h1>
                    <div x-data="{ confirmSubmit: false, success: false }"
                        x-on:customer-created.window="success = true; setTimeout(() => success = false, 3000)"
                        class="bg-white w-full rounded-lg mt-6">
                        <form @submit.prevent="confirmSubmit = true">
                            <div class="ml-auto space-y-3 px-4 text-sm">
                                <div class="w-full flex flex-col lg:items-center">
                                    <div class="w-full relative flex flex-col lg:flex-row lg:gap-3">
                                        <label for="name" class="lg:w-[20%] lg:text-right">Name</label>
                                        <input type="text" wire:model="name" id="name"
                                            value="{{ $customer->user->name }}"
                                            class="border border-black/20 w-full lg:w-[80%] py-1 px-2 rounded-sm focus:outline-none focus:ring-primary focus:ring-2 @error('name') ring-red-500 ring-1 @enderror">
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
                                        <label for="email" class="lg:w-[20%] lg:text-right">Email</label>
                                        <input type="text" wire:model="email" id="email"
                                            value="{{ $customer->user->email }}"
                                            class="border border-black/20 w-full lg:w-[80%] py-1 px-2 rounded-sm focus:outline-none focus:ring-primary focus:ring-2 @error('email') ring-red-500 ring-1 @enderror">
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
                                        <label for="phone" class="lg:w-[20%] lg:text-right">Phone</label>
                                        <input type="text" wire:model="phone" id="phone"
                                            value="{{ $customer->user->phone }}"
                                            class="border border-black/20 w-full lg:w-[80%] py-1 px-2 rounded-sm focus:outline-none focus:ring-primary focus:ring-2 @error('phone') ring-red-500 ring-1 @enderror">
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
                                        <label for="nik" class="lg:w-[20%] lg:text-right">NIK</label>
                                        <input type="text" wire:model="nik" id="nik" value="{{ $customer->nik }}"
                                            class="border border-black/20 w-full lg:w-[80%] py-1 px-2 rounded-sm focus:outline-none focus:ring-primary focus:ring-2 @error('nik') ring-red-500 ring-1 @enderror">
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
                                        <label for="address" class="lg:w-[20%] lg:text-right">Address</label>
                                        <textarea wire:model="address" id="address" cols="30" rows="5"
                                            class="border border-black/20 w-full lg:w-[80%] py-1 px-2 rounded-sm focus:outline-none focus:ring-primary focus:ring-2 @error('address') ring-red-500 ring-1 @enderror">{{ $customer->address }}</textarea>
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
                                        <label for="postal_code" class="lg:w-[20%] lg:text-right">Postal Code</label>
                                        <input type="text" wire:model="postal_code" id="postal_code"
                                            value="{{ $customer->postal_code }}"
                                            class="border border-black/20 w-full lg:w-[80%] py-1 px-2 rounded-sm focus:outline-none focus:ring-primary focus:ring-2 @error('postal_code') ring-red-500 ring-1 @enderror">
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
                            </div>
                        </form>
                        <div x-show="confirmSubmit" x-transition x-cloak
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

                            <div @click.outside="confirmSubmit = false"
                                class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md">

                                <h2 class="text-lg font-semibold">
                                    Are you sure you want to create this customer?
                                </h2>

                                <p class="text-sm text-gray-500 mt-2">
                                    Please make sure all the data you have provided is correct.
                                </p>

                                <div class="flex justify-end gap-2 mt-6">

                                    <button type="button" @click="confirmSubmit = false"
                                        class="px-4 py-2 rounded-md border">
                                        Cancel
                                    </button>

                                    <button type="button" @click="confirmSubmit = false; wire.save();"
                                        class="px-4 py-2 rounded-md bg-primary text-white">
                                        Confirm
                                    </button>

                                </div>

                            </div>
                        </div>
                        <div x-show="success" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="translate-x-full opacity-0"
                            x-transition:enter-end="translate-x-0 opacity-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="translate-x-0 opacity-100"
                            x-transition:leave-end="translate-x-full opacity-0" x-cloak
                            class="fixed top-15 right-6 z-9999">
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
                </div>
                <div class="border border-black/20 rounded-md p-4">
                    <h1 class="font-semibold text-lg">Location Based On Maps</h1>
                    <div x-data="{ confirmSubmit: false, success: false }"
                        x-on:customer-created.window="success = true; setTimeout(() => success = false, 3000)"
                        class="bg-white w-full rounded-lg mt-6">
                        <form @submit.prevent="confirmSubmit = true">
                            <div class="ml-auto space-y-3 px-4 text-sm">
                                <div class="w-full flex flex-col lg:items-center">
                                    <div class="w-full relative flex flex-col lg:flex-row lg:gap-3">
                                        <div wire:ignore x-data="mapPicker()" x-init="initMap()"
                                            class="space-y-2 w-full">

                                            <div id="map" class="h-90 rounded-md w-full bg-gray-100"></div>

                                            <div class="grid grid-cols-2 gap-2">
                                                <input type="hidden" wire:model="latitude" x-model="lat"
                                                    class="border p-2">

                                                <input type="hidden" wire:model="longitude" x-model="lng"
                                                    class="border p-2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div x-show="confirmSubmit" x-transition x-cloak
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

                            <div @click.outside="confirmSubmit = false"
                                class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md">

                                <h2 class="text-lg font-semibold">
                                    Are you sure you want to create this customer?
                                </h2>

                                <p class="text-sm text-gray-500 mt-2">
                                    Please make sure all the data you have provided is correct.
                                </p>

                                <div class="flex justify-end gap-2 mt-6">

                                    <button type="button" @click="confirmSubmit = false"
                                        class="px-4 py-2 rounded-md border">
                                        Cancel
                                    </button>

                                    <button type="button" @click="confirmSubmit = false; wire.save();"
                                        class="px-4 py-2 rounded-md bg-primary text-white">
                                        Confirm
                                    </button>

                                </div>

                            </div>
                        </div>
                        <div x-show="success" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="translate-x-full opacity-0"
                            x-transition:enter-end="translate-x-0 opacity-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="translate-x-0 opacity-100"
                            x-transition:leave-end="translate-x-full opacity-0" x-cloak
                            class="fixed top-15 right-6 z-9999">
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
                </div>


                {{-- <div>
                    <label class="text-sm text-gray-500">
                        Email
                    </label>

                    <p>
                        {{ $customer->user->email }}
                    </p>
                </div>

                <div>
                    <label class="text-sm text-gray-500">
                        NIK
                    </label>

                    <p>
                        {{ $customer->nik }}
                    </p>
                </div>

                <div>
                    <label class="text-sm text-gray-500">
                        Address
                    </label>

                    <p>
                        {{ $customer->address }}
                    </p>
                </div>

                <div>
                    <label class="text-sm text-gray-500">
                        Status
                    </label>

                    <p>
                        {{ $customer->status }}
                    </p>
                </div> --}}

            </div>
            <div class="flex justify-end pr-2 pb-4">
                <button type="submit" class="bg-primary text-white px-4 py-1.5 rounded-md cursor-pointer mt-6">
                    Update Customer
                </button>
            </div>
        </div>

        {{-- SERVICES --}}
        <div x-show="tab === 'services'" class="bg-white rounded-lg shadow p-6">

            <h2 class="text-lg font-semibold mb-4">
                Internet Services
            </h2>

            <p class="text-gray-500">
                No services yet.
            </p>

        </div>

        {{-- INVOICES --}}
        <div x-show="tab === 'invoices'" class="bg-white rounded-lg shadow p-6">

            <h2 class="text-lg font-semibold mb-4">
                Invoices
            </h2>

            <p class="text-gray-500">
                No invoices yet.
            </p>

        </div>

        {{-- TICKETS --}}
        <div x-show="tab === 'tickets'" class="bg-white rounded-lg shadow p-6">

            <h2 class="text-lg font-semibold mb-4">
                Tickets
            </h2>

            <p class="text-gray-500">
                No tickets yet.
            </p>

        </div>

    </div>
    <div class="row mt-4">
        <div class="bg-white rounded-lg px-6 py-4">
            <p class="font-semibold text-lg">Activity</p>
        </div>
    </div>
@endsection

@push('script')
    <script>
        Alpine.data('mapPicker', () => ({
            map: null,
            marker: null,

            lat: null,
            lng: null,

            defaultLat: {{ $customer->latitude }},
            defaultLng: {{ $customer->longitude }},
            defaultZoom: 17,

            initMap() {

                this.map = L.map('map').setView(
                    [this.defaultLat, this.defaultLng],
                    this.defaultZoom
                );

                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                }).addTo(this.map);

                // tampilkan marker dari database
                if (this.defaultLat && this.defaultLng) {

                    this.updateCoordinate(
                        this.defaultLat,
                        this.defaultLng
                    );
                }

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

                this.map.panTo([lat, lng]);

                if (!this.marker) {

                    this.marker = L.marker([lat, lng], {
                        draggable: true
                    }).addTo(this.map);

                    this.marker.on('dragend', (e) => {

                        const position = e.target.getLatLng();

                        this.lat = position.lat;
                        this.lng = position.lng;
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
@endpush
