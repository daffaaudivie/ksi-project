@section('title', 'Tambah Cabang')

<x-app-layout>
    <div class="py-8 bg-gray-50">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-lg sm:rounded-xl overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ __('Tambah Data Cabang') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Silakan isi formulir di bawah ini untuk mendaftarkan cabang baru.
                    </p>
                </div>

                <form method="POST" action="{{ route('admin.cabang.store') }}">
                    @csrf

                    <div class="px-8 py-8">

                        <div class="space-y-6">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        Nama Cabang <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="nama_cabang" required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out"
                                        placeholder="Contoh: Desapa Resto"
                                        value="{{ old('nama_cabang') }}">
                                    @error('nama_cabang')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        Jenis Bisnis <span class="text-red-500">*</span>
                                    </label>
                                    <select name="jenis_bisnis" required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                                        <option value="" disabled selected>Pilih Jenis Bisnis</option>
                                        @foreach($jenis_bisnis as $jenis)
                                        <option value="{{ $jenis->value }}" {{ old('jenis_bisnis') == $jenis->value ? 'selected' : '' }}>
                                            {{ $jenis->label() }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('jenis_bisnis')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="border-t border-gray-200"></div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        Telepon / Kontak
                                    </label>
                                    <input type="text" name="telepon"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out"
                                        placeholder="Contoh: 081234xxx"
                                        value="{{ old('telepon') }}">
                                    @error('telepon')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Status Operasional
                                    </label>
                                    <select name="is_active" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                                        <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </div>
                            </div>

                            <div class="border-t border-gray-200"></div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Provinsi <span class="text-red-500">*</span>
                                    </label>
                                    <select name="id_provinsi" id="id_provinsi" required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out bg-white">
                                        <option value="">Pilih Provinsi</option>
                                    </select>
                                    <input type="hidden" name="nama_provinsi" id="nama_provinsi" value="{{ old('nama_provinsi') }}">
                                    @error('id_provinsi')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        Kota / Kabupaten <span class="text-red-500">*</span>
                                    </label>
                                    <select name="id_kota" id="id_kota" disabled required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out bg-gray-100 cursor-not-allowed">
                                        <option value="">Pilih Provinsi Terlebih Dahulu</option>
                                    </select>
                                    <input type="hidden" name="nama_kota" id="nama_kota" value="{{ old('nama_kota') }}">
                                    @error('nama_kota')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    Alamat Lengkap <span class="text-red-500">*</span>
                                </label>
                                <textarea name="alamat" rows="3" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out"
                                    placeholder="Masukkan nama jalan, gedung, no rumah...">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-200 flex items-center justify-end gap-3">
                            <a href="{{ route('admin.cabang.index') }}"
                                class="px-5 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-700 font-medium text-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                Batal
                            </a>

                            <button type="submit"
                                class="px-5 py-2.5 rounded-lg bg-blue-600 text-white font-semibold text-sm
           hover:bg-blue-700 shadow-md flex items-center justify-center">
                                Simpan Cabang
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const provinsiSelect = document.getElementById('id_provinsi');
            const provinsiNamaInput = document.getElementById('nama_provinsi');
            const kotaSelect = document.getElementById('id_kota');
            const kotaNamaInput = document.getElementById('nama_kota');

            const BASE_URL_API = 'https://www.emsifa.com/api-wilayah-indonesia/api';

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