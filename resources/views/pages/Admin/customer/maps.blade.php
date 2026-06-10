@extends('layout.app')

@section('title', 'Customer Maps')

@section('content')
    <div class="row">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined ">
                groups
            </span>
            <h1 class="text-xl font-normal
            {{-- text-gray-200 --}}
            ">
                @hasSection('title')
                    @yield('title')
                @else
                @endif
            </h1>
        </div>
    </div>

    <div class="row mt-4">
        <div class="bg-white rounded-lg shadow p-4">
            <div class="w-full relative flex flex-col lg:flex-row lg:gap-4 mt-3">
                <div wire:ignore x-data="mapViewer({
                    id: 'all-customer-map',
                
                    zoom: 5,
                
                    markers: @js(
    $customers
        ->flatMap(
            fn($customer) => $customer->services->filter(fn($service) => filled($service->latitude) && filled($service->longitude))->map(
                fn($service) => [
                    'lat' => $service->latitude,
                    'lng' => $service->longitude,

                    // 'popup' => view('admin.customers.partials.popup', [
                    //     'customer' => $customer,
                    //     'service' => $service,
                    // ])->render(),
                ],
            ),
        )
        ->values(),
)
                })" x-init="init()" class="space-y-2 w-full">
                    <div x-ref="map" class="h-90 rounded-md w-full bg-gray-100"></div>
                </div>
            </div>
        </div>

    </div>
@endsection
