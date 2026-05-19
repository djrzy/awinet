<div>
    <h2 class="text-lg font-semibold mb-4">
        Internet Services
    </h2>

    @if (!$service)
        <p class="text-gray-500">
            No services yet.
        </p>

        <div class="mt-2">
            <button
                class="flex items-center gap-1 bg-primary text-white rounded-md px-3 py-2 cursor-pointer hover:bg-primary/70">
                <span class="text-sm">
                    Add Service
                </span>
            </button>
        </div>
    @else
        <div>
            Customer sudah berlangganan

            {{ $service->username }}
            {{ $service->status }}
        </div>
    @endif

</div>
