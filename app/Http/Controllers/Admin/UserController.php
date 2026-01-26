<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\Cabang;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = User::query()
            ->with('cabang:id,nama_cabang')
            ->whereIn('role', [Role::STAFF->value, Role::ADMIN->value])
            ->latest()
            ->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $cabang = Cabang::select('id', 'nama_cabang')
            ->orderBy('nama_cabang')
            ->get();

        $roles = [
            Role::ADMIN->value => Role::ADMIN->label(),
            Role::STAFF->value => Role::STAFF->label(),
        ];

        return view('admin.users.create', compact('cabang', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        // dd([
        //     'input' => $request->all(),
        //     'validated' => $request->validated(),
        //     'role_value' => $request->input('role'),
        //     'role_staff_value' => Role::STAFF->value,
        //     'role_admin_value' => Role::ADMIN->value,
        // ]);

        try {
            DB::beginTransaction();

            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);

            if ($data['role'] === 'admin') {
                $data['id_cabang'] = null;
            }

            User::create($data);

            DB::commit();

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'User berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        $user->load('cabang:id,nama_cabang,alamat');

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        $cabang = Cabang::select('id', 'nama_cabang')
            ->orderBy('nama_cabang')
            ->get();

        $roles = [
            Role::ADMIN->value => Role::ADMIN->label(),
            Role::STAFF->value => Role::STAFF->label(),
        ];

        return view('admin.users.edit', compact('user', 'cabang', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();

            // Update password hanya jika diisi
            if (empty($data['password'])) {
                unset($data['password']);
            } else {
                $data['password'] = Hash::make($data['password']);
            }

            // Admin tidak perlu cabang
            if ($data['role'] === Role::ADMIN->value) {
                $data['id_cabang'] = null;
            }

            $user->update($data);

            DB::commit();

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'User berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    public function destroy(User $user): RedirectResponse
    {
        try {
            // Prevent self-deletion
            if ($user->id === auth()->id()) {
                return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
            }

            DB::beginTransaction();

            $user->delete();

            DB::commit();

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'User berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
