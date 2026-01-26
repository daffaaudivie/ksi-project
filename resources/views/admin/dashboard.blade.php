@section('title', 'Dashboard Admin')

<x-app-layout>

    {{-- HEADER --}}
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 mb-6">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
            {{ __('Dashboard Admin') }}
        </h2>
        <p class="mt-1 text-sm font-semibold text-gray-500">Ringkasan operasional harian.</p>
    </div>

    <div class="pb-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- STATISTICS CARDS --}}

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white overflow-hidden rounded-lg border-2 border-blue-200 shadow-md hover:shadow-lg transition-shadow flex items-start p-5">
                    <div class="flex-shrink-0 p-3 bg-blue-500 rounded-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4 flex-1">
                        <div class="text-sm font-bold text-blue-600 uppercase tracking-wide">Pelanggan</div>
                        <div class="mt-1 text-2xl font-bold text-gray-900">{{ number_format($stats['total_customers']) }}</div>
                        <p class="text-sm font-semibold text-gray-600 mt-1">Total Data Pelanggan</p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden rounded-lg border-2 border-emerald-200 shadow-md hover:shadow-lg transition-shadow flex items-start p-5">
                    <div class="flex-shrink-0 p-3 bg-emerald-500 rounded-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4 flex-1">
                        <div class="text-sm font-bold text-emerald-600 uppercase tracking-wide">Transaksi</div>
                        <div class="mt-1 text-2xl font-bold text-gray-900">{{ number_format($stats['total_transaksi']) }}</div>
                        <p class="text-sm font-semibold text-gray-600 mt-1">Total Seluruh Transaksi</p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden rounded-lg border-2 border-violet-200 shadow-md hover:shadow-lg transition-shadow flex items-start p-5">
                    <div class="flex-shrink-0 p-3 bg-violet-500 rounded-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div class="ml-4 flex-1">
                        <div class="text-sm font-bold text-violet-600 uppercase tracking-wide">Cabang</div>
                        <div class="mt-1 text-2xl font-bold text-gray-900">{{ number_format($stats['total_cabang']) }}</div>
                        <p class="text-sm font-semibold text-gray-600 mt-1">Total Cabang beroperasi</p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden rounded-lg border-2 border-orange-200 shadow-md hover:shadow-lg transition-shadow flex items-start p-5">
                    <div class="flex-shrink-0 p-3 bg-orange-500 rounded-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4 flex-1">
                        <div class="text-sm font-bold text-orange-600 uppercase tracking-wide"> Users</div>
                        <div class="mt-1 text-2xl font-bold text-gray-900">{{ number_format($stats['total_users']) }}</div>
                        <p class="text-sm font-semibold text-gray-600 mt-1">Total Akun Aktif</p>
                    </div>
                </div>

            </div>


            {{-- LATEST TRANSACTIONS TABLE --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-300">
                <div class="p-5 border-b border-gray-300 bg-gray-50">
                    <h3 class="text-lg font-bold text-gray-900">Transaksi Terakhir</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100 border-b border-gray-300">
                                {{-- Border Vertikal dihapus (class 'border-r' dihilangkan) --}}
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Customer</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Cabang</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Tipe</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Sumber</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($latest_transaksi as $transaksi)
                            <tr class="hover:bg-gray-50 transition-colors">
                                {{-- Border Vertikal dihapus (class 'border-r' dihilangkan) --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-medium text-center">
                                    {{ $transaksi->tanggal->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-bold text-left pl-10">
                                    {{ $transaksi->customer->nama_customer }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 text-center">
                                    {{ $transaksi->cabang->nama_cabang }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        {{ $transaksi->tipe_customer->label() }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 text-center">
                                    {{ $transaksi->sumber_informasi->label() }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500 text-sm">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <span class="text-base font-medium text-gray-900">Belum ada data transaksi</span>
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
</x-app-layout>