@extends('layout.app')

@section('title', 'Customers')

@section('content')
    <div class="row">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined ">
                home
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
        <div class="bg-white w-full rounded-lg p-2 shadow-sm">
            @livewire('admin.customer.customer-table')
        </div>
    </div>
@endsection
