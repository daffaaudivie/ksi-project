<x-app-layout>
    <div class="py-6">
        <!-- Header -->
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl">
                {{ __('Data Pelanggan') }} - {{ auth()->user()->cabang->nama_cabang ?? 'Nama Cabang' }}
            </h2>
        </div>

        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <!-- Filter Section -->
                <div class="p-6 border-b border-gray-200">
                    <form method="GET" action="{{ route('staff.transaksi.index') }}">
                        <div class="flex flex-col lg:flex-row lg:items-end gap-3">

                            <!-- Cari Customer -->
                            <div class="flex-1 min-w-[200px]">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Cari Customer
                                </label>
                                <input type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Nama customer..."
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- Dari Tanggal -->
                            <div class="w-full lg:w-40">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Dari Tanggal
                                </label>
                                <input type="date"
                                    name="start_date"
                                    value="{{ request('start_date') }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- Sampai Tanggal -->
                            <div class="w-full lg:w-40">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Sampai Tanggal
                                </label>
                                <input type="date"
                                    name="end_date"
                                    value="{{ request('end_date') }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- Tipe Customer -->
                            <div class="w-full lg:w-40">
                                <select name="tipe_customer" class="w-full rounded-md ...">
                                    <option value="">Semua Tipe</option>
                                    @foreach(\App\Enums\TipeCustomer::cases() as $tipe)
                                    <option value="{{ $tipe->value }}"
                                        {{ request('tipe_customer') === $tipe->value ? 'selected' : '' }}>
                                        {{ $tipe->label() }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Sumber Informasi -->
                            <div class="w-full lg:w-40">
                                <select name="sumber_informasi" class="w-full rounded-md ...">
                                    <option value="">Sumber Informasi</option>
                                    @foreach(\App\Enums\SumberInformasi::cases() as $informasi)
                                    <option value="{{ $informasi->value }}"
                                        {{ request('sumber_informasi') === $informasi->value ? 'selected' : '' }}>
                                        {{ $informasi->label() }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Button Actions -->
                            <div class="flex gap-2">
                                <button type="submit"
                                    class="inline-flex items-center justify-center px-4 h-[42px] bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 whitespace-nowrap">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Filter
                                </button>

                                <a href="{{ route('staff.transaksi.index') }}"
                                    class="inline-flex items-center justify-center px-4 h-[42px] bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 whitespace-nowrap">
                                    Reset
                                </a>
                            </div>

                        </div>
                    </form>
                </div>

                <!-- Action Button Above Table -->
                <div class="px-6 py-4 border-b border-gray-200 flex justify-end gap-2">
                    {{-- Export Excel --}}
                    <a href="{{ route('staff.transaksi.export', request()->query()) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 transition">

                        {{-- Icon Excel (File Spreadsheet) --}}
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>

                        <span>Export Excel</span>
                    </a>

                    {{-- Tambah --}}
                    <a href="{{ route('staff.transaksi.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Transaksi
                    </a>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-center text-xs font-bold text-gray-600 uppercase">No</th>
                                <th class="px-4 py-3 text-center text-xs font-bold text-gray-600 uppercase">Hari</th>
                                <th class="px-4 py-3 text-center text-xs font-bold text-gray-600 uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase">Nama Customer</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase">Tipe Customer</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase">No. HP</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase">Alamat</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase">Sumber Informasi</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($transaksi as $index => $item)
                            <tr class="hover:bg-gray-50">

                                {{-- No --}}
                                <td class="px-4 py-3 text-center text-sm text-gray-600">
                                    {{ $transaksi->firstItem() + $index }}
                                </td>

                                {{-- Hari --}}
                                <td class="px-4 py-3 text-center text-sm text-gray-600">
                                    {{ $item->hari }}
                                </td>

                                {{-- Tanggal --}}
                                <td class="px-4 py-3 text-center text-sm text-gray-700 font-medium">
                                    {{ $item->tanggal->format('d/m/Y') }}
                                </td>

                                {{-- Nama Customer --}}
                                <td class="px-6 py-3 text-sm font-semibold text-gray-900">
                                    {{ $item->customer->nama_customer }}
                                </td>

                                {{-- Tipe Customer (ENUM) --}}
                                <td class="px-6 py-3 text-center">
                                    @php
                                    $tipe = $item->tipe_customer;
                                    $badge = match ($tipe) {
                                    \App\Enums\TipeCustomer::PERORANGAN => 'bg-gray-100 text-gray-800',
                                    \App\Enums\TipeCustomer::ROMBONGAN => 'bg-gray-100 text-gray-800',
                                    \App\Enums\TipeCustomer::FLEET => 'bg-gray-100 text-gray-800',
                                    };
                                    @endphp
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $badge }}">
                                        {{ $tipe->label() }}
                                    </span>
                                </td>

                                {{-- No HP --}}
                                <td class="px-6 py-3 text-sm text-gray-700">
                                    {{ $item->customer->no_hp }}
                                </td>

                                {{-- Alamat --}}
                                <td class="px-6 py-3 text-sm text-gray-600 max-w-xs truncate"
                                    title="{{ $item->customer->alamat_utama }}">
                                    {{ $item->customer->alamat_utama ?? '-' }}
                                </td>

                                {{-- Sumber Informasi --}}
                                <td class="px-6 py-3 text-left text-sm text-gray-600">
                                    {{ $item->sumber_informasi }}
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex justify-center items-center space-x-3">
                                        {{-- Detail --}}
                                        <a href="{{ route('staff.transaksi.show', $item->id) }}"
                                            class="text-gray-500 hover:text-blue-600 transition-colors"
                                            title="Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        {{-- Edit --}}
                                        <!-- <a href="{{ route('staff.transaksi.edit', $item->id) }}"
                                            class="text-gray-500 hover:text-indigo-600 transition-colors"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a> -->

                                        {{-- Hapus --}}
                                        <form action="{{ route('staff.transaksi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-500 hover:text-red-600 transition-colors pt-1" title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="px-6 py-10 text-center text-gray-500">
                                    Belum ada data pelanggan
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($transaksi->hasPages())
                <div class="px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $transaksi->links() }}
                </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>