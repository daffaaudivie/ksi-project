<?php

namespace App\Http\Controllers\Admin;

use App\Enums\JenisBisnis;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Cabang\StoreCabangRequest;
use App\Http\Requests\Admin\Cabang\UpdateCabangRequest;
use App\Models\Cabang;
use App\Models\Customer;
use App\Models\TransaksiPelanggan;

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
                        ->orWhere('nama_kota', 'like', "%{$search}%") // Gunakan nama_kota
                        ->orWhere('nama_provinsi', 'like', "%{$search}%");
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
                $data = $request->validated();
                $data['created_by'] = auth()->id();
                // $data['kota'] = $request->nama_kota;

                Cabang::create($data);
            });

            return redirect()
                ->route('admin.cabang.index')
                ->with('success', 'Cabang berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error storing cabang: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $cabang = Cabang::findOrFail($id);

        $totalCustomers = Customer::whereHas('transaksi', function ($query) use ($cabang) {
            $query->where('id_cabang', $cabang->id);
        })->count();

        $totalTransactions = TransaksiPelanggan::where('id_cabang', $cabang->id)->count();

        $transactionsThisMonth = TransaksiPelanggan::where('id_cabang', $cabang->id)
            ->whereYear('tanggal', date('Y'))
            ->whereMonth('tanggal', date('m'))
            ->count();

        $latestTransactions = TransaksiPelanggan::with('customer:id,nama_customer,no_hp')
            ->where('id_cabang', $cabang->id)
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.cabang.show', compact(
            'cabang',
            'totalCustomers',
            'totalTransactions',
            'transactionsThisMonth',
            'latestTransactions'
        ));
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
                $data = $request->validated();
                $data['updated_by'] = auth()->id();

                $cabang->update($data);
            });

            return redirect()
                ->route('admin.cabang.index')
                ->with('success', 'Data cabang berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating cabang ID ' . $cabang->id . ': ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy(Cabang $cabang): RedirectResponse
    {
        try {
            DB::transaction(function () use ($cabang) {
                $cabang->update(['deleted_by' => auth()->id()]);

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
