@section('title', 'Data Cabang')

<x-app-layout>
    <div class="py-6">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl">
                {{ __('Data Cabang') }}
            </h2>
        </div>

        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
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

            @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6 border-b border-gray-200">
                    <form method="GET" action="{{ route('admin.cabang.index') }}">
                        <div class="flex flex-col lg:flex-row lg:items-end gap-3">

                            <div class="flex-1 min-w-[200px]">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Cari Cabang / Kota
                                </label>
                                <input type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Nama cabang atau kota..."
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div class="w-full lg:w-48">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Jenis Bisnis
                                </label>
                                <select name="jenis_bisnis" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Semua Jenis</option>
                                    @foreach(\App\Enums\JenisBisnis::cases() as $jenis)
                                    <option value="{{ $jenis->value }}"
                                        {{ request('jenis_bisnis') === $jenis->value ? 'selected' : '' }}>
                                        {{ $jenis->label() }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-full lg:w-40">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Status
                                </label>
                                <select name="is_active" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Semua Status</option>
                                    <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </div>

                            <div class="flex gap-2">
                                <button type="submit"
                                    class="inline-flex items-center justify-center px-4 h-[42px] bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 whitespace-nowrap">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Filter
                                </button>

                                <a href="{{ route('admin.cabang.index') }}"
                                    class="inline-flex items-center justify-center px-4 h-[42px] bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 whitespace-nowrap">
                                    Reset
                                </a>
                            </div>

                        </div>
                    </form>
                </div>

                <div class="px-6 py-4 flex justify-end gap-2"> {{-- Hapus border-b disini agar tidak double line --}}
                    {{-- Tambah --}}
                    <a href="{{ route('admin.cabang.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Cabang
                    </a>
                </div>

                {{-- MODIFIKASI: Menambahkan border, rounded, dan margin --}}
                <div class="overflow-x-auto border border-gray-300 rounded-sm mb-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-center text-xs font-bold text-gray-600 uppercase w-16">No</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase">Nama Cabang</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase">Jenis Bisnis</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase">Kota</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase">Telepon</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($cabangs as $index => $item)
                            <tr class="hover:bg-gray-50">

                                {{-- No --}}
                                <td class="px-4 py-3 text-center text-sm text-gray-600">
                                    {{ $cabangs->firstItem() + $index }}
                                </td>

                                {{-- Nama Cabang --}}
                                <td class="px-6 py-3 text-sm font-semibold text-gray-900">
                                    {{ $item->nama_cabang }}
                                    <div class="text-xs text-gray-500 font-normal mt-0.5 truncate max-w-xs" title="{{ $item->alamat }}">
                                        {{ Str::limit($item->alamat, 40) }}
                                    </div>
                                </td>

                                {{-- Jenis Bisnis (ENUM) --}}
                                <td class="px-6 py-3 text-center">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-50 text-blue-700 border border-blue-200">
                                        {{ $item->jenis_bisnis->label() }}
                                    </span>
                                </td>

                                {{-- Kota --}}
                                <td class="px-6 py-3 text-sm text-gray-700">
                                    {{ $item->kota }}
                                </td>

                                {{-- Telepon --}}
                                <td class="px-6 py-3 text-sm text-gray-600">
                                    {{ $item->telepon ?? '-' }}
                                </td>

                                {{-- Status (Boolean) --}}
                                <td class="px-6 py-3 text-center">
                                    @if($item->is_active)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                    @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Nonaktif
                                    </span>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex justify-center items-center space-x-3">
                                        {{-- Detail --}}
                                        <a href="{{ route('admin.cabang.show', $item->id) }}"
                                            class="text-gray-500 hover:text-blue-600 transition-colors"
                                            title="Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.cabang.edit', $item->id) }}"
                                            class="text-gray-500 hover:text-indigo-600 transition-colors"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        {{-- Hapus --}}
                                        <form action="{{ route('admin.cabang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus cabang {{ $item->nama_cabang }}? Data yang dihapus tidak dapat dikembalikan.')" class="inline-block">
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
                                <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        <span class="text-base font-medium">Belum ada data cabang</span>
                                        <p class="text-sm mt-1">Silakan tambahkan cabang baru.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($cabangs->hasPages())
                <div class="px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $cabangs->links() }}
                </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>