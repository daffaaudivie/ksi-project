<x-app-layout>
    <div class="py-6">
        <!-- Header -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <a href="{{ route('staff.transaksi.index') }}"
                        class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 mb-3 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali ke Data Pelanggan
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">
                        Detail Pelanggan
                    </h1>
                </div>

                <div class="flex gap-3">
                    <form action="{{ route('staff.transaksi.destroy', $transaksi->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus data pelanggan ini?')"
                        class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2.5 bg-white border border-red-300 rounded-lg font-medium text-sm text-red-600 hover:bg-red-50 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus Data
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Customer Profile Card -->
                    <div class="bg-white rounded-lg shadow border border-gray-200">
                        <!-- Header -->
                        <div class="px-6 py-5 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="w-16 h-16 bg-gray-900 rounded-lg flex items-center justify-center">
                                        <span class="text-2xl font-bold text-white">
                                            {{ strtoupper(substr($transaksi->customer->nama_customer, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div>
                                        <h2 class="text-2xl font-bold text-gray-900">
                                            {{ $transaksi->customer->nama_customer }}
                                        </h2>
                                        <p class="text-sm text-gray-500 mt-1">
                                            Dicatat: {{ $transaksi->created_at->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                                @php
                                $tipe = $transaksi->tipe_customer;
                                $badgeStyle = match ($tipe) {
                                \App\Enums\TipeCustomer::PERORANGAN => 'bg-gray-100 text-gray-700 border-gray-200',
                                \App\Enums\TipeCustomer::ROMBONGAN => 'bg-gray-100 text-gray-700 border-gray-200',
                                \App\Enums\TipeCustomer::FLEET => 'bg-gray-100 text-gray-700 border-gray-200',
                                };
                                @endphp
                                <span class="px-4 py-2 text-sm font-medium rounded-lg border {{ $badgeStyle }}">
                                    {{ $tipe->label() }}
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <!-- Contact Section -->
                            <div class="mb-8">
                                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">
                                    Informasi Kontak
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Phone -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            No. Handphone
                                        </label>
                                        <a href="tel:{{ $transaksi->customer->no_hp }}"
                                            class="inline-flex items-center text-base font-semibold text-gray-900 hover:text-blue-600 transition-colors">
                                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                            {{ $transaksi->customer->no_hp }}
                                        </a>
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Email
                                        </label>
                                        @if($transaksi->customer->email)
                                        <a href="mailto:{{ $transaksi->customer->email }}"
                                            class="inline-flex items-center text-base font-semibold text-gray-900 hover:text-blue-600 transition-colors">
                                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                            {{ $transaksi->customer->email }}
                                        </a>
                                        @else
                                        <p class="text-sm text-gray-400">-</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="mb-8">
                                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">
                                    Lokasi
                                </h3>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="text-base text-gray-900">
                                        {{ $transaksi->customer->alamat_utama ?? 'Tidak ada data' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Transaction Details -->
                            <div class="pt-6 border-t border-gray-200">
                                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">
                                    Informasi Kunjungan
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <!-- Date -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Tanggal
                                        </label>
                                        <p class="text-base font-semibold text-gray-900">
                                            {{ $transaksi->tanggal->format('d M Y') }}
                                        </p>
                                        <p class="text-sm text-gray-500 mt-0.5">{{ $transaksi->hari }}</p>
                                    </div>

                                    <!-- Source -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Sumber Informasi
                                        </label>
                                        <p class="text-base font-semibold text-gray-900">
                                            {{ $transaksi->sumber_informasi }}
                                        </p>
                                    </div>

                                    <!-- Default Type -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Tipe Default
                                        </label>
                                        <p class="text-base font-semibold text-gray-900">
                                            {{ $transaksi->customer->tipe_default->label() }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Notes -->
                                @if($transaksi->keterangan)
                                <div class="mt-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Keterangan
                                    </label>
                                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                        <p class="text-sm text-gray-900 leading-relaxed">
                                            {{ $transaksi->keterangan }}
                                        </p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-6">

                    <!-- Branch Info -->
                    <div class="bg-white rounded-lg shadow border border-gray-200">
                        <div class="px-5 py-4 border-b border-gray-200">
                            <h3 class="text-sm font-semibold text-gray-900">Cabang</h3>
                        </div>
                        <div class="p-5">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-base font-semibold text-gray-900">
                                        {{ $transaksi->cabang->nama_cabang }}
                                    </h4>
                                    @if($transaksi->cabang->alamat)
                                    <p class="text-sm text-gray-600 mt-1">
                                        {{ $transaksi->cabang->alamat }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Creator Info -->
                    <div class="bg-white rounded-lg shadow border border-gray-200">
                        <div class="px-5 py-4 border-b border-gray-200">
                            <h3 class="text-sm font-semibold text-gray-900">Dicatat Oleh</h3>
                        </div>
                        <div class="p-5">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center">
                                        <span class="text-sm font-bold text-white">
                                            {{ strtoupper(substr($transaksi->creator->name, 0, 1)) }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $transaksi->creator->name }}
                                    </p>
                                    <p class="text-xs text-gray-500 mt-0.5">
                                        {{ $transaksi->created_at->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- System Info -->
                    <div class="bg-white rounded-lg shadow border border-gray-200">
                        <div class="px-5 py-4 border-b border-gray-200">
                            <h3 class="text-sm font-semibold text-gray-900">Informasi Sistem</h3>
                        </div>
                        <div class="p-5 space-y-3">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600">Dibuat</span>
                                <span class="font-medium text-gray-900">
                                    {{ $transaksi->created_at->format('d/m/Y H:i') }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600">Diperbarui</span>
                                <span class="font-medium text-gray-900">
                                    {{ $transaksi->updated_at->format('d/m/Y H:i') }}
                                </span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>