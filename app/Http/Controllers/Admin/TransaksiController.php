<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransaksiPelanggan;
use App\Models\Customer;
use App\Models\Cabang;
use App\Http\Requests\TransaksiPelangganRequest;
use App\Exports\TransaksiPelangganAdminExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = TransaksiPelanggan::with(['customer', 'cabang', 'creator'])
            ->recent();

        if ($request->filled('id_cabang')) {
            $query->where('id_cabang', $request->id_cabang);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->byPeriode($request->start_date, $request->end_date);
        } elseif ($request->filled('start_date')) {
            $query->byTanggal($request->start_date);
        } elseif ($request->filled('end_date')) {
            $query->byTanggal($request->end_date);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('customer', function ($q) use ($search) {
                $q->where('nama_customer', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        if ($request->filled('tipe_customer')) {
            $query->where('tipe_customer', $request->tipe_customer);
        }

        if ($request->filled('sumber_informasi')) {
            $query->where('sumber_informasi', $request->sumber_informasi);
        }

        $transaksi = $query->paginate(10)->withQueryString();

        $cabangs = Cabang::all();

        return view('admin.transaksi.index', compact('transaksi', 'cabangs'));
    }

    public function create()
    {
        $cabangs = Cabang::all();
        return view('admin.transaksi.create', compact('cabangs'));
    }

    public function store(TransaksiPelangganRequest $request)
    {
        $user = auth()->user();

        DB::transaction(function () use ($request, $user) {

            $customer = Customer::withTrashed()
                ->where('no_hp', $request->no_hp)
                ->first();

            if ($customer && $customer->trashed()) {
                $customer->restore();
            }

            $customerData = [
                'nama_customer' => $request->nama_customer,
                'no_hp' => $request->no_hp,
                'id_provinsi' => $request->id_provinsi,
                'nama_provinsi' => $request->nama_provinsi,
                'id_kota' => $request->id_kota,
                'nama_kota' => $request->nama_kota,
                'alamat_detail' => $request->alamat_detail,
                'email' => $request->email,
                'catatan' => $request->catatan,
            ];

            if (!$customer) {
                $customerData['tipe_default'] = $request->tipe_customer;
                $customer = Customer::create($customerData);
            } else {
                $customer->update($customerData);
            }

            TransaksiPelanggan::create([
                'id_customer' => $customer->id,
                'id_cabang' => $request->id_cabang,
                'created_by' => $user->id,
                'tanggal' => $request->tanggal,
                'tipe_customer' => $request->tipe_customer,
                'jumlah_rombongan' => $request->tipe_customer === 'Rombongan' ? $request->jumlah_rombongan : null,
                'sumber_informasi' => $request->sumber_informasi,
                'keterangan' => $request->keterangan,
            ]);
        });

        return redirect()
            ->route('admin.transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function show(TransaksiPelanggan $transaksi)
    {
        $transaksi->load(['customer', 'cabang', 'creator']);

        return view('admin.transaksi.show', compact('transaksi'));
    }

    public function edit(TransaksiPelanggan $transaksi)
    {
        $cabangs = Cabang::all();

        return view('admin.transaksi.edit', compact('transaksi', 'cabangs'));
    }

    public function update(TransaksiPelangganRequest $request, TransaksiPelanggan $transaksi)
    {

        DB::transaction(function () use ($request, $transaksi) {

            if ($transaksi->customer) {
                $transaksi->customer->update([
                    'nama_customer' => $request->nama_customer,
                    'no_hp' => $request->no_hp,
                    'id_provinsi' => $request->id_provinsi,
                    'nama_provinsi' => $request->nama_provinsi,
                    'id_kota' => $request->id_kota,
                    'nama_kota' => $request->nama_kota,
                    'alamat_detail' => $request->alamat_detail,
                    'email' => $request->email,
                    'catatan' => $request->catatan,
                ]);
            }

            $transaksi->update([
                'id_cabang' => $request->id_cabang, // Admin bisa memindah cabang transaksi
                'tanggal' => $request->tanggal,
                'tipe_customer' => $request->tipe_customer,
                'jumlah_rombongan' => $request->tipe_customer === 'Rombongan' ? $request->jumlah_rombongan : null,
                'sumber_informasi' => $request->sumber_informasi,
                'keterangan' => $request->keterangan,
            ]);
        });

        return redirect()
            ->route('admin.transaksi.index')
            ->with('success', 'Transaksi berhasil diupdate');
    }

    public function destroy(TransaksiPelanggan $transaksi)
    {
        $transaksi->delete();

        return redirect()
            ->route('admin.transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus');
    }

    public function export(Request $request)
    {
        return Excel::download(
            new TransaksiPelangganAdminExport($request),
            'data-transaksi-pelanggan-admin.xlsx'
        );
    }
}
