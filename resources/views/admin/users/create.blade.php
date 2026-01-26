@section('title', 'Tambah User')

<x-app-layout>
    <div class="py-8 bg-gray-50">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-lg sm:rounded-xl overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ __('Tambah Data User') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Silakan isi formulir di bawah ini untuk mendaftarkan user baru.
                    </p>
                </div>

                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf

                    <div class="px-8 py-8">

                        {{-- FORMULIR DATA LENGKAP --}}
                        <div class="space-y-6">

                            {{-- ROW 1: NAMA & EMAIL --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Nama Lengkap --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="nama" required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out"
                                        placeholder="Contoh: Staff Desapa"
                                        value="{{ old('nama') }}">
                                    @error('nama')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" name="email" required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out"
                                        placeholder="contoh@email.com"
                                        value="{{ old('email') }}">
                                    @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- DIVIDER --}}
                            <div class="border-t border-gray-200"></div>

                            {{-- ROW 2: PASSWORD & KONFIRMASI PASSWORD --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Password --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        Password <span class="text-red-500">*</span>
                                    </label>
                                    <input type="password" name="password" required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out"
                                        placeholder="Minimal 8 karakter">
                                    @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Konfirmasi Password --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        Konfirmasi Password <span class="text-red-500">*</span>
                                    </label>
                                    <input type="password" name="password_confirmation" required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out"
                                        placeholder="Ketik ulang password">
                                    @error('password_confirmation')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- DIVIDER --}}
                            <div class="border-t border-gray-200"></div>

                            {{-- ROW 3: ROLE & CABANG --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-6">
                                {{-- Role --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        Role / Hak Akses <span class="text-red-500">*</span>
                                    </label>
                                    <select name="role" id="role" required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                                        <option value="" disabled selected>Pilih Role</option>
                                        @foreach($roles as $value => $label)
                                        <option value="{{ $value }}" {{ old('role') == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Admin memiliki akses ke semua cabang
                                    </p>
                                    @error('role')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Cabang --}}
                                <div id="cabang-field">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        Cabang <span class="text-red-500" id="required-mark">*</span>
                                    </label>
                                    <select name="id_cabang" id="id_cabang"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                                        <option value="">Pilih Cabang</option>
                                        @foreach($cabang as $item)
                                        <option value="{{ $item->id }}" {{ old('id_cabang') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_cabang }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <p class="text-xs text-gray-500 mt-1" id="cabang-info">
                                        Wajib dipilih untuk role Staff
                                    </p>
                                    @error('id_cabang')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- FOOTER ACTIONS --}}
                        <div class="px-8 py-6 bg-gray-50 border-t border-gray-200 flex items-center justify-end gap-3">
                            <a href="{{ route('admin.users.index') }}"
                                class="px-5 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-700 font-medium text-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                Batal
                            </a>

                            <button type="submit"
                                class="px-5 py-2.5 rounded-lg bg-blue-600 text-white font-semibold text-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 shadow-md transition-colors">
                                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan User
                            </button>
                        </div>
                </form>

            </div>
        </div>
    </div>

    {{-- JavaScript untuk toggle cabang field --}}
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const cabangField = document.getElementById('cabang-field');
            const cabangSelect = document.getElementById('id_cabang');
            const requiredMark = document.getElementById('required-mark');
            const cabangInfo = document.getElementById('cabang-info');

            function toggleCabangField() {
                const selectedRole = roleSelect.value;

                if (selectedRole === 'admin') {
                    cabangSelect.value = '';
                    cabangSelect.disabled = true;
                    cabangSelect.removeAttribute('required');
                    cabangField.classList.add('opacity-50');
                    requiredMark.classList.add('hidden');
                    cabangInfo.textContent = 'Admin memiliki akses ke semua cabang';
                    cabangInfo.classList.remove('text-gray-500');
                    cabangInfo.classList.add('text-blue-600');
                } else if (selectedRole === 'staff') {
                    cabangSelect.disabled = false;
                    cabangSelect.setAttribute('required', 'required');
                    cabangField.classList.remove('opacity-50');
                    requiredMark.classList.remove('hidden');
                    cabangInfo.textContent = 'Wajib dipilih untuk role Staff';
                    cabangInfo.classList.remove('text-blue-600');
                    cabangInfo.classList.add('text-gray-500');
                } else {
                    cabangSelect.disabled = false;
                    cabangSelect.removeAttribute('required');
                    cabangField.classList.remove('opacity-50');
                    requiredMark.classList.add('hidden');
                    cabangInfo.textContent = 'Pilih cabang jika diperlukan';
                    cabangInfo.classList.remove('text-blue-600');
                    cabangInfo.classList.add('text-gray-500');
                }
            }

            roleSelect.addEventListener('change', toggleCabangField);

            // Initial check on page load
            if (roleSelect.value) {
                toggleCabangField();
            }
        });
    </script>
    @endpush
</x-app-layout>