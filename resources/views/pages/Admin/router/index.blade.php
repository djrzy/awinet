@extends('layout.app')

@section('title', 'Routers')

@section('content')
    <div class="row">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined ">
                router
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
    <div class="p-6 bg-white rounded-xl shadow-xs border border-gray-100 mt-4">
        @livewire('admin.router.router-table')
    </div>
@endsection
