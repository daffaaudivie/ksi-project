<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Statistics Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

                {{-- Total Customers --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm text-gray-500">Total Customers</div>
                        <div class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_customers']) }}</div>
                        <div class="text-xs text-green-600 mt-2">
                            +{{ number_format($stats['customer_baru_bulan_ini']) }} bulan ini
                        </div>
                    </div>
                </div>

                {{-- Total Transaksi --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm text-gray-500">Total Transaksi</div>
                        <div class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_transaksi']) }}</div>
                        <div class="text-xs text-blue-600 mt-2">
                            {{ number_format($stats['transaksi_bulan_ini']) }} bulan ini
                        </div>
                    </div>
                </div>

                {{-- Total Cabang --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm text-gray-500">Total Cabang</div>
                        <div class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_cabang']) }}</div>
                    </div>
                </div>

                {{-- Total Users --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm text-gray-500">Total Users</div>
                        <div class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_users']) }}</div>
                    </div>
                </div>

            </div>

            {{-- Latest Transaksi --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Transaksi Terakhir</h3>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cabang</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sumber</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Input By</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($latest_transaksi as $transaksi)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    {{ $transaksi->tanggal->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    {{ $transaksi->customer->nama_customer }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    {{ $transaksi->cabang->nama_cabang }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    {{ $transaksi->sumber_informasi->label() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    {{ $transaksi->user->name }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>