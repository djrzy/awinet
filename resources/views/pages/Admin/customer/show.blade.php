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
        <div class="flex flex-wrap gap-2">

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

            <button @click="tab = 'devices'"
                :class="tab === 'devices'
                    ?
                    'text-black bg-white rounded-t-lg shadow-[0_-1px_3px_-1px_rgba(0,0,0,0.1)] font-semibold' :
                    'text-gray-500'"
                class="px-4 py-2 transition cursor-pointer">
                Devices
            </button>

        </div>

        {{-- TAB CONTENTS --}}

        {{-- PROFILE --}}
        <div x-show="tab === 'profile'" class="bg-white rounded-b-lg rounded-tr-lg shadow p-4">
            @livewire('admin.customer.customer-show', ['customer' => $customer])
        </div>

        {{-- SERVICES --}}
        <div x-show="tab === 'services'" class="bg-white rounded-lg shadow p-6">
            @livewire('admin.customer.customer-internet-services', ['customer' => $customer])
        </div>

        {{-- INVOICES --}}
        <div x-show="tab === 'invoices'" class="bg-white rounded-lg shadow p-6">
            @livewire('admin.customer.customer-invoice', ['customer' => $customer])
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

        {{-- DEVICES --}}
        <div x-show="tab === 'devices'" class="bg-white rounded-lg shadow p-6">

            <h2 class="text-lg font-semibold mb-4">
                Devices
            </h2>

            <p class="text-gray-500">
                No devices yet.
            </p>

        </div>

        <div x-show="tab === 'profile'" class="row mt-4">
            <div class="bg-white rounded-lg shadow px-6 py-4">
                <p class="font-semibold text-lg">Activity</p>
            </div>
        </div>
    </div>
@endsection
