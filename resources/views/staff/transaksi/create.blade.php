@section('title', 'Tambah Data')

<x-app-layout>
    <div class="py-8 bg-gray-50">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-lg sm:rounded-xl overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ __('Tambah Data Pelanggan') }} - {{ auth()->user()->cabang->nama_cabang ?? 'Nama Cabang' }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Silakan isi formulir di bawah ini untuk mencatat transaksi baru.
                    </p>
                </div>

                <form method="POST" action="{{ route('staff.transaksi.store') }}">
                    @csrf

                    <div class="px-8 py-8">

                        {{-- FORMULIR DATA LENGKAP --}}
                        <div class="space-y-6">

                            {{-- ROW 1: TANGGAL TRANSAKSI & TIPE CUSTOMER --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Tanggal Transaksi <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="tanggal" required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out"
                                        value="{{ old('tanggal', now()->toDateString()) }}">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        Tipe Customer <span class="text-red-500">*</span>
                                    </label>
                                    <select name="tipe_customer" id="tipe_customer" required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                                        <option value="" disabled selected>Pilih Tipe</option>
                                        @foreach(\App\Enums\TipeCustomer::cases() as $tipe)
                                        <option value="{{ $tipe->value }}" {{ old('tipe_customer') == $tipe->value ? 'selected' : '' }}>
                                            {{ $tipe->label() }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- CONDITIONAL: JUMLAH ROMBONGAN --}}
                            {{-- Default hidden, logic tampil ada di Javascript bawah --}}
                            <div id="jumlah_rombongan_container" class="hidden bg-yellow-50 p-4 rounded-lg border border-blue-500">
                                <label class="block text-sm font-medium text-yellow-800 mb-2">
                                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Jumlah Orang dalam Rombongan <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="jumlah_rombongan" id="jumlah_rombongan" min="2"
                                    class="w-full rounded-lg border-blue-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out"
                                    placeholder="Masukkan jumlah orang"
                                    value="{{ old('jumlah_rombongan') }}">
                                <p class="text-xs text-yellow-600 mt-1">* Wajib diisi jika tipe customer adalah Rombongan.</p>
                            </div>

                            <div class="border-t border-gray-200"></div>

                            {{-- ROW 2: NAMA & NO HP --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Nama Customer <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="nama_customer" required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out"
                                        placeholder="Masukkan nama lengkap"
                                        value="{{ old('nama_customer') }}">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        No. WhatsApp / HP <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="no_hp" required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out"
                                        placeholder="08xxxxxxxxxx"
                                        value="{{ old('no_hp') }}">
                                </div>
                            </div>

                            <div class="border-t border-gray-200"></div>

                            {{-- ROW 3: EMAIL & SUMBER INFORMASI --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        Email <span class="text-gray-400 font-normal">(Opsional)</span>
                                    </label>
                                    <input type="email" name="email"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out"
                                        placeholder="email@example.com"
                                        value="{{ old('email') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Sumber Informasi <span class="text-red-500">*</span>
                                    </label>
                                    <select name="sumber_informasi" required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                                        <option value="" disabled selected>Pilih Sumber</option>
                                        @foreach(\App\Enums\SumberInformasi::cases() as $sumber)
                                        <option value="{{ $sumber->value }}" {{ old('sumber_informasi') == $sumber->value ? 'selected' : '' }}>
                                            {{ $sumber->label() }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="border-t border-gray-200"></div>

                            {{-- ROW 4: PROVINSI & KOTA (API BARU) --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Provinsi <span class="text-gray-400 font-normal">(Opsional)</span>
                                    </label>
                                    <select name="id_provinsi" id="id_provinsi"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out bg-white">
                                        <option value="">Pilih Provinsi</option>
                                    </select>
                                    <input type="hidden" name="nama_provinsi" id="nama_provinsi">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        Kota/Kabupaten <span class="text-gray-400 font-normal">(Opsional)</span>
                                    </label>
                                    <select name="id_kota" id="id_kota" disabled
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out bg-gray-100 cursor-not-allowed">
                                        <option value="">Pilih Provinsi Terlebih Dahulu</option>
                                    </select>
                                    <input type="hidden" name="nama_kota" id="nama_kota">
                                </div>
                            </div>

                            <div class="border-t border-gray-200"></div>

                            {{-- ROW 6: KETERANGAN & CATATAN --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Keterangan <span class="text-gray-400 font-normal">(Opsional)</span>
                                    </label>

                                    <textarea name="keterangan" rows="4"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out"
                                        placeholder="Tulis detail pesanan atau catatan transaksi...">{{ old('keterangan') }}</textarea>
                                </div>

                            </div>


                        </div>

                    </div>

                    <div class="px-8 py-6 bg-gray-50 border-t border-gray-200 flex items-center justify-end gap-3">
                        <a href="{{ route('staff.transaksi.index') }}"
                            class="px-5 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-700 font-medium text-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                            Batal
                        </a>

                        <button type="submit"
                            class="px-5 py-2.5 rounded-lg bg-blue-600 text-white font-semibold text-sm
           hover:bg-blue-700 shadow-md flex items-center justify-center">
                            Simpan Transaksi
                        </button>

                    </div>
                </form>

            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /* =====================================================
             * 1. LOGIC TIPE CUSTOMER (ROMBONGAN)
             * ===================================================== */
            const tipeCustomerSelect = document.getElementById('tipe_customer');
            const jumlahRombonganContainer = document.getElementById('jumlah_rombongan_container');
            const jumlahRombonganInput = document.getElementById('jumlah_rombongan');

            const ROMBONGAN_VALUE = 'Rombongan';

            function toggleRombongan() {
                if (tipeCustomerSelect && tipeCustomerSelect.value === ROMBONGAN_VALUE) {
                    jumlahRombonganContainer.classList.remove('hidden');
                    jumlahRombonganInput.required = true;
                } else {
                    jumlahRombonganContainer.classList.add('hidden');
                    jumlahRombonganInput.required = false;
                    jumlahRombonganInput.value = '';
                }
            }

            if (tipeCustomerSelect) {
                toggleRombongan();
                tipeCustomerSelect.addEventListener('change', toggleRombongan);
            }

            /* =====================================================
             * 2. API WILAYAH INDONESIA (EMSIFA)
             * ===================================================== */
            const provinsiSelect = document.getElementById('id_provinsi');
            const provinsiNamaInput = document.getElementById('nama_provinsi');
            const kotaSelect = document.getElementById('id_kota');
            const kotaNamaInput = document.getElementById('nama_kota');

            const BASE_URL_API = 'https://www.emsifa.com/api-wilayah-indonesia/api';

            /* ---------- LOAD PROVINSI ---------- */
            fetch(`${BASE_URL_API}/provinces.json`)
                .then(res => res.json())
                .then(provinces => {
                    provinsiSelect.innerHTML = '<option value="">Pilih Provinsi</option>';

                    provinces.forEach(province => {
                        const option = document.createElement('option');
                        option.value = province.id;
                        option.textContent = province.name;
                        provinsiSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Gagal memuat provinsi:', error);
                    provinsiSelect.innerHTML = '<option value="">Gagal memuat provinsi</option>';
                });

            /* ---------- EVENT PROVINSI CHANGE ---------- */
            provinsiSelect.addEventListener('change', function() {
                const provinceId = this.value;
                const provinceName = this.options[this.selectedIndex]?.text || '';

                provinsiNamaInput.value = provinceId ? provinceName : '';

                kotaSelect.innerHTML = '<option value="">Memuat kota...</option>';
                kotaSelect.disabled = true;
                kotaSelect.classList.add('bg-gray-100', 'cursor-not-allowed');
                kotaSelect.classList.remove('bg-white');
                kotaNamaInput.value = '';

                if (!provinceId) {
                    kotaSelect.innerHTML = '<option value="">Pilih Provinsi Terlebih Dahulu</option>';
                    return;
                }

                fetch(`${BASE_URL_API}/regencies/${provinceId}.json`)
                    .then(res => res.json())
                    .then(regencies => {
                        kotaSelect.innerHTML = '<option value="">Pilih Kota / Kabupaten</option>';

                        regencies.forEach(city => {
                            const option = document.createElement('option');
                            option.value = city.id;
                            option.textContent = city.name;
                            kotaSelect.appendChild(option);
                        });

                        kotaSelect.disabled = false;
                        kotaSelect.classList.remove('bg-gray-100', 'cursor-not-allowed');
                        kotaSelect.classList.add('bg-white');
                    })
                    .catch(error => {
                        console.error('Gagal memuat kota:', error);
                        kotaSelect.innerHTML = '<option value="">Gagal memuat kota</option>';
                    });
            });

            kotaSelect.addEventListener('change', function() {
                const kotaName = this.options[this.selectedIndex]?.text || '';
                kotaNamaInput.value = this.value ? kotaName : '';
            });

        });
    </script>

    @endpush
</x-app-layout>