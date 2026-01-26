@section('title', 'Data User')

<x-app-layout>
    <div class="py-6">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl">
                {{ __('Data Pengguna') }}
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
                    <form method="GET" action="{{ route('admin.users.index') }}">
                        <div class="flex flex-col lg:flex-row lg:items-end gap-3">

                            <div class="flex-1 min-w-[200px]">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Cari User
                                </label>
                                <input type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Nama atau email..."
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div class="w-full lg:w-48">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Role
                                </label>
                                <select name="role" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Semua Role</option>
                                    @foreach(\App\Enums\Role::cases() as $role)
                                    @if(in_array($role, [\App\Enums\Role::ADMIN, \App\Enums\Role::STAFF]))
                                    <option value="{{ $role->value }}" {{ request('role') === $role->value ? 'selected' : '' }}>
                                        {{ $role->label() }}
                                    </option>
                                    @endif
                                    @endforeach
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

                                <a href="{{ route('admin.users.index') }}"
                                    class="inline-flex items-center justify-center px-4 h-[42px] bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 whitespace-nowrap">
                                    Reset
                                </a>
                            </div>

                        </div>
                    </form>
                </div>

                <div class="px-6 py-4 flex justify-end gap-2">
                    <a href="{{ route('admin.users.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah User
                    </a>
                </div>

                <div class="overflow-x-auto border border-gray-300 rounded-sm mb-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-center text-xs font-bold text-gray-600 uppercase w-16">No</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase">Nama User</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase">Role</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase">Cabang</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase">Bergabung</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($users as $index => $user)
                            <tr class="hover:bg-gray-50">

                                {{-- No --}}
                                <td class="px-4 py-3 text-center text-sm text-gray-600">
                                    {{ $users->firstItem() + $index }}
                                </td>

                                {{-- Nama User --}}
                                <td class="px-6 py-3 text-sm font-semibold text-gray-900">
                                    {{ $user->nama }}
                                    <div class="text-xs text-gray-500 font-normal mt-0.5">
                                        {{ $user->email }}
                                    </div>
                                </td>

                                {{-- Role (ENUM) --}}
                                <td class="px-6 py-3 text-center">
                                    @php
                                    $roleStyle = match($user->role) {
                                    \App\Enums\Role::ADMIN => 'bg-blue-50 text-blue-700 border-blue-200',
                                    \App\Enums\Role::STAFF => 'bg-gray-50 text-gray-700 border-gray-200',
                                    default => 'bg-gray-50 text-gray-700 border-gray-200',
                                    };
                                    @endphp
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $roleStyle }} border">
                                        {{ $user->role->label() }}
                                    </span>
                                </td>

                                {{-- Cabang --}}
                                <td class="px-6 py-3 text-sm text-gray-700">
                                    @if($user->role === \App\Enums\Role::ADMIN)
                                    <span class="text-gray-400 italic">Semua Cabang</span>
                                    @else
                                    {{ $user->cabang->nama_cabang ?? '-' }}
                                    @endif
                                </td>

                                {{-- Bergabung --}}
                                <td class="px-6 py-3 text-sm text-gray-600 text-center">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex justify-center items-center space-x-3">

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="text-gray-500 hover:text-indigo-600 transition-colors"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        {{-- Hapus --}}
                                        @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user {{ $user->nama }}? Data yang dihapus tidak dapat dikembalikan.')" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-500 hover:text-red-600 transition-colors pt-1" title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                        @else
                                        <span class="text-gray-300 cursor-not-allowed" title="Tidak dapat menghapus akun sendiri">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </span>
                                        @endif
                                    </div>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        <span class="text-base font-medium">Belum ada data user</span>
                                        <p class="text-sm mt-1">Silakan tambahkan user baru.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($users->hasPages())
                <div class="px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $users->links() }}
                </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>