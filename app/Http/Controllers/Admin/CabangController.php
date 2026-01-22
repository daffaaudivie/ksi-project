<?php

namespace App\Http\Controllers\Admin;

use App\Enums\JenisBisnis;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Cabang\StoreCabangRequest;
use App\Http\Requests\Admin\Cabang\UpdateCabangRequest;
use App\Models\Cabang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CabangController extends Controller
{
    public function index(Request $request): View
    {
        $user = auth()->user();

        $cabangs = Cabang::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_cabang', 'like', "%{$search}%")
                        ->orWhere('kota', 'like', "%{$search}%");
                });
            })
            ->when($request->jenis_bisnis, function ($query, $jenis) {
                $query->where('jenis_bisnis', $jenis);
            })
            ->when($request->filled('is_active'), function ($query) use ($request) {
                $query->where('is_active', $request->is_active);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.cabang.index', compact('user', 'cabangs'));
    }

    public function create(): View
    {
        return view('admin.cabang.create', [
            'jenis_bisnis' => JenisBisnis::cases() 
        ]);
    }

    public function store(StoreCabangRequest $request): RedirectResponse
    {
        try {
            DB::transaction(function () use ($request) {
                Cabang::create($request->validated());
            });

            return redirect()
                ->route('admin.cabang.index')
                ->with('success', 'Cabang berhasil ditambahkan.');
        } catch (\Exception $e) {

            Log::error('Error storing cabang: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    public function show(Cabang $cabang): View
    {
        return view('admin.cabang.show', compact('cabang'));
    }

    public function edit(Cabang $cabang): View
    {
        return view('admin.cabang.edit', [
            'cabang' => $cabang,
            'jenis_bisnis' => JenisBisnis::cases()
        ]);
    }

    public function update(UpdateCabangRequest $request, Cabang $cabang): RedirectResponse
    {
        try {
            DB::transaction(function () use ($request, $cabang) {
                $cabang->update($request->validated());
            });

            return redirect()
                ->route('admin.cabang.index')
                ->with('success', 'Data cabang berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating cabang ID ' . $cabang->id . ': ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data.');
        }
    }

    public function destroy(Cabang $cabang): RedirectResponse
    {
        try {
            DB::transaction(function () use ($cabang) {
                $cabang->delete();
            });

            return redirect()
                ->route('admin.cabang.index')
                ->with('success', 'Cabang berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting cabang ID ' . $cabang->id . ': ' . $e->getMessage());

            return back()->with('error', 'Gagal menghapus data.');
        }
    }
}
