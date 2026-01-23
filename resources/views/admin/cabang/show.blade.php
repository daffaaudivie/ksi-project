@section('title', 'Detail Cabang')

<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- 1. HEADER SECTION & BREADCRUMB --}}
            <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <nav class="flex mb-1" aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-2">
                            <li>
                                <a href="{{ route('admin.cabang.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">
                                    Data Cabang
                                </a>
                            </li>
                            <li>
                                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </li>
                            <li class="text-sm font-medium text-gray-900" aria-current="page">
                                {{ $cabang->nama_cabang }}
                            </li>
                        </ol>
                    </nav>
                    <h1 class="text-2xl font-bold text-gray-900 sm:truncate">
                        {{ $cabang->nama_cabang }}
                    </h1>
                </div>

                <div class="flex items-center gap-3">
                    {{-- Edit --}}
                    <a href="{{ route('admin.cabang.edit', $cabang->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                        Edit
                    </a>

                    {{-- Hapus --}}
                    <form action="{{ route('admin.cabang.destroy', $cabang->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus cabang ini? Data yang terkait mungkin akan terpengaruh.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-medium text-sm text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- 2. MAIN INFORMATION (Left Column - Wider) --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden">

                        {{-- Section Header --}}
                        <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                            <h3 class="text-base font-semibold leading-6 text-gray-900">Informasi Cabang</h3>

                            {{-- Status Badge --}}
                            @if($cabang->is_active)
                            <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset bg-green-50 text-green-700 ring-green-600/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-600 mr-1.5"></span>
                                Aktif Operasional
                            </span>
                            @else
                            <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset bg-red-50 text-red-700 ring-red-600/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-600 mr-1.5"></span>
                                Non-Aktif
                            </span>
                            @endif
                        </div>

                        {{-- Data Grid (Description List) --}}
                        <div class="px-6 py-6">
                            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">

                                {{-- Nama Cabang --}}
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Nama Cabang</dt>
                                    <dd class="mt-1 text-sm font-semibold text-gray-900">{{ $cabang->nama_cabang }}</dd>
                                </div>

                                {{-- Jenis Bisnis --}}
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Jenis Bisnis</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                                            {{ $cabang->jenis_bisnis->label() }}
                                        </span>
                                    </dd>
                                </div>

                                {{-- Kota --}}
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Kota</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $cabang->kota }}</dd>
                                </div>

                                {{-- Telepon --}}
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Kontak / Telepon</dt>
                                    <dd class="mt-1 text-sm text-gray-900 font-mono">
                                        @if($cabang->telepon)
                                        <a href="tel:{{ $cabang->telepon }}" class="hover:text-blue-600 hover:underline flex items-center gap-1">
                                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                            {{ $cabang->telepon }}
                                        </a>
                                        @else
                                        <span class="text-gray-400 italic">Tidak tersedia</span>
                                        @endif
                                    </dd>
                                </div>

                                {{-- Alamat (Full Width) --}}
                                <div class="sm:col-span-2 border-t border-gray-100 pt-4 mt-2">
                                    <dt class="text-sm font-medium text-gray-500 flex items-center gap-1">
                                        Alamat Lengkap
                                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($cabang->alamat . ' ' . $cabang->kota) }}" target="_blank" class="text-xs text-blue-600 hover:text-blue-800 ml-2" title="Lihat di Google Maps">
                                            (Lihat Peta &nearr;)
                                        </a>
                                    </dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-900">
                                        {{ $cabang->alamat }}
                                    </dd>
                                </div>

                            </dl>
                        </div>
                    </div>
                </div>

                {{-- 3. META INFORMATION (Right Column - Sidebar) --}}
                <div class="lg:col-span-1 space-y-6">

                    {{-- System Info Card --}}
                    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50">
                            <h3 class="text-sm font-semibold text-gray-900">Informasi Sistem</h3>
                        </div>
                        <div class="px-5 py-5 space-y-4">

                            {{-- Created At --}}
                            <div>
                                <div class="text-xs font-medium text-gray-500 uppercase tracking-wide">Terdaftar Pada</div>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ $cabang->created_at->format('d F Y') }}
                                </div>
                                <div class="text-xs text-gray-400">
                                    Pukul {{ $cabang->created_at->format('H:i') }} WIB
                                </div>
                            </div>

                            <hr class="border-gray-100">

                            {{-- Updated At --}}
                            <div>
                                <div class="text-xs font-medium text-gray-500 uppercase tracking-wide">Terakhir Diupdate</div>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ $cabang->updated_at->diffForHumans() }}
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>