<div x-data="toast" x-on:notify.window="showToast($event)">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold">Router Devices</h2>
        <div>
            <x-button type="button" wire:click="openCreateModal" variant="primary">
                Add New Router
            </x-button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left rounded-lg overflow-hidden">
            <thead class="bg-[#007E41] text-white">
                <tr>
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Router Name</th>
                    <th class="px-6 py-3">Host / IP Address</th>
                    <th class="px-6 py-3">API Port</th>
                    <th class="px-6 py-3">API Username</th>
                    <th class="px-6 py-3">Description</th>
                    <th class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody class="*:even:bg-gray-100">
                @forelse ($routers as $router)
                    <tr class="hover:bg-[#007E41]/5 transition">
                        <td class="px-6 py-4">{{ $loop->iteration + ($routers->firstItem() - 1) }}</td>
                        <td class="px-6 py-4 font-semibold">{{ $router->name }}</td>
                        <td class="px-6 py-4"><code>{{ $router->host }}</code></td>
                        <td class="px-6 py-4">{{ $router->port }}</td>
                        <td class="px-6 py-4">{{ $router->username }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $router->description ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-3">
                                <button type="button" wire:click="openEditModal({{ $router->id }})"
                                    title="Edit Router" class="text-gray-400 hover:text-cyan-500 cursor-pointer">
                                    <span class="material-symbols-outlined text-xl!">edit_square</span>
                                </button>
                                <button type="button" wire:click="delete({{ $router->id }})"
                                    wire:confirm="Are you sure you want to delete this router? This will affect connected services."
                                    title="Delete Router" class="text-gray-400 hover:text-red-500 cursor-pointer">
                                    <span class="material-symbols-outlined text-xl!">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center">No router devices registered yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $routers->links() }}
    </div>

    {{-- Toast Global Notification --}}
    <x-toast />

    {{-- Modal Form Create / Edit --}}
    <x-modal show="showModal" maxWidth="xl" closeable=0>
        <x-slot:header>
            <h2 class="text-lg font-semibold">
                {{ $isEdit ? 'Edit Router Credentials' : 'Register New Mikrotik Router' }}
            </h2>
            <p class="text-xs text-gray-500">
                Ensure Mikrotik IP/Host is reachable and RouterOS API service (port 8728) is enabled.
            </p>
        </x-slot:header>

        <form id="RouterForm" wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}"
            class="px-1 lg:px-6 space-y-3 text-sm">
            <x-form.input-group type="text" name="name" label="Router Name" wire:model="name"
                placeholder="e.g. Router Core Pusat" />

            <x-form.input-group type="text" name="host" label="IP Host / DDNS" wire:model="host"
                placeholder="e.g. 192.168.88.1" />
            <x-form.input-group type="number" name="port" label="API Port" wire:model="port" placeholder="e.g. 8728"
                step="1" />

            <x-form.input-group type="text" name="username" label="API Username" wire:model="username" />
            <x-form.input-group type="password" name="password" label="API Password" wire:model="password" />

            <x-form.textarea name="description" label="Description / Location Notes" wire:model="description"
                rows="2" class="resize-none" />
        </form>

        <x-slot:footer>
            <x-button type="button" variant="secondary" wire:click="$set('showModal', false)">
                Cancel
            </x-button>
            <x-button type="submit" form="RouterForm" variant="primary">
                {{ $isEdit ? 'Update Router' : 'Save Router' }}
            </x-button>
        </x-slot:footer>
    </x-modal>
</div>
