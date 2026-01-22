@section('title', 'Dashboard Admin')

<x-app-layout>

    {{-- HEADER --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 mb-4">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
            {{ __('Dashboard Admin') }}
        </h2>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- STATISTICS CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- Total Customers (Blue) --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-blue-500">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Customers</div>
                        <div class="mt-2 text-3xl font-bold text-gray-900">{{ number_format($stats['total_customers']) }}</div>
                        <div class="text-xs text-green-600 mt-2 font-medium">
                            +{{ number_format($stats['customer_baru_bulan_ini']) }} bulan ini
                        </div>
                    </div>
                </div>

                {{-- Total Transaksi (Green) --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-green-500">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Transaksi</div>
                        <div class="mt-2 text-3xl font-bold text-gray-900">{{ number_format($stats['total_transaksi']) }}</div>
                        <div class="text-xs text-blue-600 mt-2 font-medium">
                            +{{ number_format($stats['transaksi_bulan_ini']) }} bulan ini
                        </div>
                    </div>
                </div>

                {{-- Total Cabang (Purple) --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-purple-500">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Cabang</div>
                        <div class="mt-2 text-3xl font-bold text-gray-900">{{ number_format($stats['total_cabang']) }}</div>
                    </div>
                </div>

                {{-- Total Users (Orange) --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-orange-500">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Users</div>
                        <div class="mt-2 text-3xl font-bold text-gray-900">{{ number_format($stats['total_users']) }}</div>
                    </div>
                </div>

            </div>

            {{-- LATEST TRANSACTIONS TABLE (Full Width) --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900">Transaksi Terakhir</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Customer</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Cabang</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Tipe</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Sumber</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($latest_transaksi as $transaksi)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-medium text-left">
                                    {{ $transaksi->tanggal->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">
                                    {{ $transaksi->customer->nama_customer }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 text-left">
                                    {{ $transaksi->cabang->nama_cabang }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        {{ $transaksi->tipe_customer->label() }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-left">
                                    {{ $transaksi->sumber_informasi->label() }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-500 text-sm">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-10 h-10 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <span class="text-base font-medium">Belum ada data transaksi.</span>
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