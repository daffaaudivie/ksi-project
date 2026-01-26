@section('title', 'Detail Cabang')

<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER CARD WITH BREADCRUMB & STATISTICS --}}
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl overflow-hidden mb-6">
                {{-- (Bagian Header & Statistik tetap sama, tidak saya ubah untuk menyingkat jawaban) --}}
                {{-- ... Code Header & Statistik Anda sebelumnya ... --}}
                <div class="px-6 pt-6 pb-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <nav class="flex mb-2" aria-label="Breadcrumb">
                            <ol class="flex items-center space-x-2">
                                <li><a href="{{ route('admin.cabang.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">Data Cabang</a></li>
                                <li><svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg></li>
                                <li class="text-sm font-medium text-gray-900" aria-current="page">{{ $cabang->nama_cabang }}</li>
                            </ol>
                        </nav>
                        <h1 class="text-2xl font-bold text-gray-900 sm:truncate">{{ $cabang->nama_cabang }}</h1>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.cabang.edit', $cabang->id) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Edit
                        </a>
                        <form action="{{ route('admin.cabang.destroy', $cabang->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus cabang ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-medium text-sm text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
                {{-- STATISTICS CARDS --}}
                <div class="px-6 pb-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        {{-- Card Total Pelanggan --}}
                        <div class="bg-white overflow-hidden rounded-lg border-2 border-blue-200 shadow-md p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 p-3 bg-blue-500 rounded-lg"><svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg></div>
                                <div class="ml-4 flex-1">
                                    <div class="text-xs font-semibold text-blue-600 uppercase tracking-wide">Total Pelanggan</div>
                                    <div class="mt-1 text-2xl font-bold text-gray-900">{{ $totalCustomers ?? 0 }}</div>
                                </div>
                            </div>
                        </div>
                        {{-- Card Total Transaksi --}}
                        <div class="bg-white overflow-hidden rounded-lg border-2 border-emerald-200 shadow-md p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 p-3 bg-emerald-500 rounded-lg"><svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg></div>
                                <div class="ml-4 flex-1">
                                    <div class="text-xs font-semibold text-emerald-600 uppercase tracking-wide">Total Transaksi</div>
                                    <div class="mt-1 text-2xl font-bold text-gray-900">{{ $totalTransactions ?? 0 }}</div>
                                </div>
                            </div>
                        </div>
                        {{-- Card Bulan Ini --}}
                        <div class="bg-white overflow-hidden rounded-lg border-2 border-violet-200 shadow-md p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 p-3 bg-violet-500 rounded-lg"><svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg></div>
                                <div class="ml-4 flex-1">
                                    <div class="text-xs font-semibold text-violet-600 uppercase tracking-wide">Bulan Ini</div>
                                    <div class="mt-1 text-2xl font-bold text-gray-900">{{ $transactionsThisMonth ?? 0 }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--
                GRID SECTION
                Hanya berisi Informasi Cabang (Kiri) dan Sidebar (Kanan).
                Tabel Transaksi dipindah ke bawah grid ini.
            --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

                {{-- MAIN INFORMATION (Left Column - Wider) --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden h-full">
                        {{-- Section Header --}}
                        <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-white">
                            <h3 class="text-base font-semibold leading-6 text-gray-900">Informasi Cabang</h3>
                        </div>

                        {{-- Data Grid (Description List) --}}
                        <div class="px-6 py-6">
                            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-6">
                                {{-- Nama Cabang --}}
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 mb-2">Nama Cabang</dt>
                                    <dd class="text-base font-semibold text-gray-900">{{ $cabang->nama_cabang }}</dd>
                                </div>
                                {{-- Jenis Bisnis --}}
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 mb-2">Jenis Bisnis</dt>
                                    <dd class="text-sm text-gray-900">
                                        <span class="inline-flex items-center rounded-md bg-blue-50 px-3 py-1.5 text-sm font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                                            {{ $cabang->jenis_bisnis->label() }}
                                        </span>
                                    </dd>
                                </div>
                                {{-- Kota --}}

                                <div class="mb-8">
                                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">
                                        Alamat
                                    </h3>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>

                                        <span class="text-base text-gray-900">
                                            {{ $cabang->nama_provinsi ?? '' }}

                                            <span class="mx-2 text-gray-400 font-bold">-</span>

                                            {{ $cabang->nama_kota ?? '' }}
                                        </span>
                                    </div>
                                </div>
                                {{-- Telepon --}}
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 mb-2">Kontak / Telepon</dt>
                                    <dd class="text-base text-gray-900">
                                        @if($cabang->telepon)
                                        <a href="tel:{{ $cabang->telepon }}" class="hover:text-blue-600 hover:underline flex items-center gap-2 font-medium">
                                            {{ $cabang->telepon }}
                                        </a>
                                        @else
                                        <span class="text-gray-400 italic">Tidak tersedia</span>
                                        @endif
                                    </dd>
                                </div>
                                {{-- Alamat (Full Width) --}}
                                <div class="sm:col-span-2 border-t border-gray-100 pt-5 mt-2">
                                    <dt class="text-sm font-medium text-gray-500 mb-2 flex items-center justify-between">
                                        <span>Alamat Lengkap</span>
                                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($cabang->alamat . ' ' . $cabang->kota) }}" target="_blank" class="inline-flex items-center gap-1 text-xs text-blue-600 hover:text-blue-800 font-medium">
                                            Lihat di Google Maps
                                        </a>
                                    </dt>
                                    <dd class="text-base leading-relaxed text-gray-900 bg-gray-50 p-4 rounded-lg border border-gray-200">
                                        {{ $cabang->alamat }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>

                {{-- META INFORMATION (Right Column - Sidebar) --}}
                <div class="lg:col-span-1 space-y-6">
                    {{-- System Info Card --}}
                    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-100 bg-white">
                            <h3 class="text-sm font-semibold text-gray-900">Informasi Sistem</h3>
                        </div>
                        <div class="px-5 py-5 space-y-4">
                            <div>
                                <div class="text-xs font-medium text-gray-500 uppercase tracking-wide">Terdaftar Pada</div>
                                <div class="mt-1 text-sm font-medium text-gray-900">{{ $cabang->created_at->format('d F Y') }}</div>
                                <div class="text-xs text-gray-400">Pukul {{ $cabang->created_at->format('H:i') }} WIB</div>
                            </div>
                            <hr class="border-gray-100">
                            <div>
                                <div class="text-xs font-medium text-gray-500 uppercase tracking-wide">Diupdate Pada</div>
                                <div class="mt-1 text-sm font-medium text-gray-900">{{ $cabang->updated_at->format('d F Y') }}</div>
                                <div class="text-xs text-gray-400">Pukul {{ $cabang->updated_at->format('H:i') }} WIB</div>
                            </div>
                        </div>
                    </div>

                    {{-- Additional Info Card --}}
                    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-100 bg-white">
                            <h3 class="text-sm font-semibold text-gray-900">Status Operasional</h3>
                        </div>
                        <div class="px-5 py-5 space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Status Cabang</span>
                                @if($cabang->is_active ?? true)
                                <span class="inline-flex items-center text-xs font-semibold text-green-700">
                                    <span class="w-2 h-2 rounded-full bg-green-600 mr-1.5"></span> Aktif
                                </span>
                                @else
                                <span class="inline-flex items-center text-xs font-semibold text-red-700">
                                    <span class="w-2 h-2 rounded-full bg-red-600 mr-1.5"></span> Non-Aktif
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div> {{-- END GRID --}}

            {{--
                LATEST TRANSACTIONS 
                Sekarang berada di luar grid, otomatis Full Width 
            --}}
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 bg-white flex justify-between items-center">
                    <h3 class="text-base font-semibold leading-6 text-gray-900">Transaksi Terakhir dari Cabang Ini</h3>
                    @if($latestTransactions->isNotEmpty())
                    <a href="{{ route('admin.transaksi.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">Lihat Semua →</a>
                    @endif
                </div>

                <div class="w-full overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Nama Customer</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Tipe</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Sumber</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($latestTransactions as $transaction)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $transaction->tanggal ? \Carbon\Carbon::parse($transaction->tanggal)->format('d M Y') : '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900 truncate max-w-xs">{{ $transaction->customer->nama_customer ?? '-' }}</div>
                                        <div class="text-xs text-gray-500 truncate max-w-xs">{{ $transaction->customer->no_hp ?? '' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $transaction->tipe_transaksi == 'jual' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ ($transaction->tipe_customer ?? '-') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ ($transaction->sumber_informasi ?? '-') }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500 text-sm">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <span class="text-base font-medium text-gray-900">Belum ada transaksi dari cabang ini</span>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>