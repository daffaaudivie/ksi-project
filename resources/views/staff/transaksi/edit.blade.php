@section('title', 'Edit Data')

<x-app-layout>
    <div class="py-8 bg-gray-50">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-lg sm:rounded-xl overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ __('Edit Data Pelanggan') }} - {{ auth()->user()->cabang->nama_cabang ?? 'Nama Cabang' }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Silakan perbarui data transaksi pelanggan.
                    </p>
                </div>

                <form method="POST" action="{{ route('staff.transaksi.update', $transaksi->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="px-8 py-8">
                        <div class="space-y-6">

                            {{-- ROW 1 --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Tanggal Transaksi <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="tanggal" required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        value="{{ old('tanggal', optional($transaksi->tanggal)->format('Y-m-d')) }}">

                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        Tipe Customer <span class="text-red-500">*</span>
                                    </label>
                                    <select name="tipe_customer" id="tipe_customer" required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        @foreach(\App\Enums\TipeCustomer::cases() as $tipe)
                                        <option value="{{ $tipe->value }}"
                                            {{ old('tipe_customer', $transaksi->tipe_customer?->value) === $tipe->value ? 'selected' : '' }}>
                                            {{ $tipe->label() }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- ROMBONGAN --}}
                            <div id="jumlah_rombongan_container" class="hidden bg-yellow-50 p-4 rounded-lg border border-blue-500">
                                <label class="block text-sm font-medium text-yellow-800 mb-2">
                                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2
                                            M7 20H2v-2a3 3 0 015.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Jumlah Orang dalam Rombongan <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="jumlah_rombongan" id="jumlah_rombongan" min="2"
                                    class="w-full rounded-lg border-blue-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    value="{{ old('jumlah_rombongan', $transaksi->jumlah_rombongan) }}">
                            </div>

                            <div class="border-t border-gray-200"></div>

                            {{-- ROW 2 --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Nama Customer <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="nama_customer" required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        value="{{ old('nama_customer', $transaksi->customer->nama_customer ?? '') }}">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13
                                                a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498
                                                a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        No. WhatsApp / HP <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="no_hp" required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        value="{{ old('no_hp', $transaksi->customer->no_hp ?? '') }}">
                                </div>
                            </div>

                            <div class="border-t border-gray-200"></div>

                            {{-- EMAIL & SUMBER --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        Email
                                    </label>
                                    <input type="email" name="email"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        value="{{ old('email', $transaksi->customer->email ?? '') }}">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Sumber Informasi <span class="text-red-500">*</span>
                                    </label>
                                    <select name="sumber_informasi" required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        @foreach(\App\Enums\SumberInformasi::cases() as $sumber)
                                        <option value="{{ $sumber->value }}"
                                            {{ old('sumber_informasi', $transaksi->sumber_informasi) === $sumber->value ? 'selected' : '' }}>
                                            {{ $sumber->label() }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="border-t border-gray-200"></div>

                            {{-- PROVINSI & KOTA --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Provinsi
                                    </label>
                                    <select name="id_provinsi" id="id_provinsi"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></select>
                                    <input type="hidden" name="nama_provinsi" id="nama_provinsi"
                                        value="{{ old('nama_provinsi', $transaksi->customer->nama_provinsi ?? '') }}">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        Kota / Kabupaten
                                    </label>
                                    <select name="id_kota" id="id_kota"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></select>
                                    <input type="hidden" name="nama_kota" id="nama_kota"
                                        value="{{ old('nama_kota', $transaksi->customer->nama_kota ?? '') }}">
                                </div>
                            </div>

                            <div class="border-t border-gray-200"></div>

                            {{-- KETERANGAN --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586l5.414 5.414V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Keterangan
                                </label>
                                <textarea name="keterangan" rows="4"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('keterangan', $transaksi->keterangan) }}</textarea>
                            </div>

                        </div>
                    </div>

                    <div class="px-8 py-6 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                        <a href="{{ route('staff.transaksi.index') }}"
                            class="px-5 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-700 text-sm">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-5 py-2.5 rounded-lg bg-blue-600 text-white font-semibold text-sm hover:bg-blue-700">
                            Update Transaksi
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tipe = document.getElementById('tipe_customer');
            const box = document.getElementById('jumlah_rombongan_container');
            const input = document.getElementById('jumlah_rombongan');
            const ROMBONGAN = 'Rombongan';

            function toggle() {
                if (tipe.value === ROMBONGAN) {
                    box.classList.remove('hidden');
                    input.required = true;
                } else {
                    box.classList.add('hidden');
                    input.required = false;
                    input.value = '';
                }
            }

            toggle();
            tipe.addEventListener('change', toggle);

            const BASE = 'https://www.emsifa.com/api-wilayah-indonesia/api';
            const prov = document.getElementById('id_provinsi');
            const kota = document.getElementById('id_kota');
            const namaProv = document.getElementById('nama_provinsi');
            const namaKota = document.getElementById('nama_kota');

            fetch(`${BASE}/provinces.json`)
                .then(r => r.json())
                .then(d => {
                    prov.innerHTML = '<option value="">Pilih Provinsi</option>';
                    d.forEach(p => {
                        const o = new Option(p.name, p.id);
                        if (p.name === namaProv.value) o.selected = true;
                        prov.add(o);
                    });
                    if (prov.value) prov.dispatchEvent(new Event('change'));
                });

            prov.addEventListener('change', function() {
                namaProv.value = this.options[this.selectedIndex]?.text || '';
                kota.innerHTML = '<option>Memuat...</option>';

                fetch(`${BASE}/regencies/${this.value}.json`)
                    .then(r => r.json())
                    .then(d => {
                        kota.innerHTML = '<option value="">Pilih Kota</option>';
                        d.forEach(c => {
                            const o = new Option(c.name, c.id);
                            if (c.name === namaKota.value) o.selected = true;
                            kota.add(o);
                        });
                    });
            });

            kota.addEventListener('change', function() {
                namaKota.value = this.options[this.selectedIndex]?.text || '';
            });
        });
    </script>
    @endpush
</x-app-layout>