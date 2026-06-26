@extends('layout.app')

@section('title', 'Billing Cycle')

@section('content')
    <div class="row">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined ">
                settings
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
        @livewire('admin.setting.billing-cycle-form')
    </div>
@endsection
