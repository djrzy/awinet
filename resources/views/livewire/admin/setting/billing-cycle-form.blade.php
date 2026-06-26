<div x-data="toast" x-on:notify.window="showToast($event)"
    class="w-full mx-auto my-8 bg-white p-6 rounded-xl shadow-md border border-gray-100">
    <div class="mb-6 pb-4 border-b border-gray-100">
        <h2 class="text-xl font-bold text-gray-900">Konfigurasi Siklus Penagihan (Billing Cycle)</h2>
        <p class="text-sm text-gray-500 mt-1">
            Tentukan bagaimana sistem otomatisasi massal akan menerbitkan dan mengunci tagihan internet pelanggan Anda.
        </p>
    </div>

    @if (session()->has('warn'))
        <div
            class="mb-6 p-4 bg-amber-50 border-l-4 border-amber-500 rounded-r-md text-amber-700 text-sm flex items-center gap-2">
            <span class="material-symbols-outlined text-amber-500">warning</span>
            <span>{{ session('warn') }}</span>
        </div>
    @endif

    <form id="CreateForm" wire:submit.prevent="save" class="space-y-6">

        <div class="flex flex-col lg:flex-row items-start lg:gap-4">
            <label class="lg:w-[30%] text-right pt-1 font-medium text-gray-700">Tipe Penagihan</label>
            <div class="w-full lg:w-[70%] space-y-3">
                <label
                    class="flex items-start gap-2 cursor-pointer p-3 border rounded-lg hover:bg-gray-50/50 transition @if ($billing_type === 'anniversary') border-green-600 bg-green-50/10 @endif">
                    <input type="radio" wire:model.live="billing_type" value="anniversary"
                        class="mt-1 text-green-600 focus:ring-green-500">
                    <div>
                        <span class="block font-semibold text-gray-900 text-sm">Setiap Tanggal Anniversary (Aktivasi
                            Layanan)</span>
                        <span class="text-xs text-gray-500">Invoice bulanan pelanggan akan rilis otomatis mengikuti
                            tanggal aktivasi layanan masing-masing pelanggan.</span>
                    </div>
                </label>

                <label
                    class="flex items-start gap-2 cursor-pointer p-3 border rounded-lg hover:bg-gray-50/50 transition @if ($billing_type === 'fixed') border-green-600 bg-green-50/10 @endif">
                    <input type="radio" wire:model.live="billing_type" value="fixed"
                        class="mt-1 text-green-600 focus:ring-green-500">
                    <div>
                        <span class="block font-semibold text-gray-900 text-sm">Tanggal Tetap Serentak (Fixed
                            Date)</span>
                        <span class="text-xs text-gray-500">Semua invoice pelanggan Anda akan diterbitkan
                            secara serentak pada satu tanggal spesifik yang Anda tentukan di bawah.</span>
                    </div>
                </label>
            </div>
        </div>

        @if ($billing_type === 'fixed')
            <x-form.form-row label="Tanggal Penagihan Tetap" name="billing_date">
                <div class="w-full sm:w-64">
                    <x-form.input-group id="billing_date" name="billing_date" wire:model="billing_date"
                        :label="false" />
                    <p class="text-xs text-gray-400 mt-1">Sistem akan mengambil nilai tanggal
                        untuk siklus bulanan berkelanjutan.</p>
                </div>
            </x-form.form-row>
        @endif

        <x-form.form-row label="Masa Jatuh Tempo Tagihan" name="due_date">
            <div class="w-full sm:w-48">
                <x-form.input-group type="number" name="due_date" wire:model="due_date" suffix="Hari"
                    :label="false" min="1" />
                <p class="text-xs text-gray-400 mt-1">Jumlah hari batas waktu pembayaran bagi pelanggan terhitung sejak
                    invoice diterbitkan.</p>
            </div>
        </x-form.form-row>

        <x-form.form-row label="Masa Tenggang Isolasi" name="grace_period">
            <div class="w-full sm:w-48">
                <x-form.input-group type="number" name="grace_period" wire:model="grace_period" suffix="Hari"
                    :label="false" min="0" />
                <p class="text-xs text-gray-400 mt-1">Jumlah hari toleransi setelah jatuh tempo sebelum dilakukan
                    pemutusan jaringan (Isolasi).</p>
            </div>
        </x-form.form-row>

    </form>
    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
        <x-button type="submit" variant="primary" form="CreateForm" wire:loading.attr="disabled" loadingTarget="save"
            loadingText="Menyimpan...">
            Simpan Konfigurasi
        </x-button>
    </div>

    <x-toast />
</div>
