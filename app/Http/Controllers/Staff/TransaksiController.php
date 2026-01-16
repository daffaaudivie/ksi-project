<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\TransaksiPelanggan;
use App\Models\Customer;
use App\Http\Requests\TransaksiPelangganRequest;
use App\Exports\TransaksiPelangganExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = TransaksiPelanggan::with(['customer', 'cabang', 'creator'])
            ->byCabang($user->id_cabang)
            ->recent();

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

        $transaksi = $query->paginate(15)->withQueryString();

        return view('staff.transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        return view('staff.transaksi.create');
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

            if (!$customer) {
                $customer = Customer::create([
                    'nama_customer' => $request->nama_customer,
                    'no_hp' => $request->no_hp,
                    'alamat_utama' => $request->alamat,
                    'tipe_default' => $request->tipe_customer,
                    'email' => $request->email,
                ]);
            } else {

                $customer->update([
                    'alamat_utama' => $request->alamat,
                    'email' => $request->email,
                ]);
            }

            TransaksiPelanggan::create([
                'id_customer' => $customer->id,
                'id_cabang' => $user->id_cabang,
                'created_by' => $user->id,
                'tanggal' => $request->tanggal,
                'hari' => Carbon::parse($request->tanggal)->locale('id')->dayName,
                'tipe_customer' => $request->tipe_customer,
                'sumber_informasi' => $request->sumber_informasi,
                'keterangan' => $request->keterangan,
            ]);
        });

        return redirect()
            ->route('staff.transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan');
    }


    public function show(TransaksiPelanggan $transaksi)
    {
        // Check if transaksi belongs to user's cabang
        if ($transaksi->id_cabang !== auth()->user()->id_cabang) {
            abort(403, 'Unauthorized action.');
        }

        $transaksi->load(['customer', 'cabang', 'creator']);

        return view('staff.transaksi.show', compact('transaksi'));
    }

    public function edit(TransaksiPelanggan $transaksi)
    {
        // Check if transaksi belongs to user's cabang
        if ($transaksi->id_cabang !== auth()->user()->id_cabang) {
            abort(403, 'Unauthorized action.');
        }

        return view('staff.transaksi.edit', compact('transaksi'));
    }

    public function update(TransaksiPelangganRequest $request, TransaksiPelanggan $transaksi)
    {
        if ($transaksi->id_cabang !== auth()->user()->id_cabang) {
            abort(403, 'Unauthorized action.');
        }

        $transaksi->update([
            'id_customer' => $request->id_customer,
            'tanggal' => $request->tanggal,
            'hari' => Carbon::parse($request->tanggal)->locale('id')->dayName,
            'tipe_customer' => $request->tipe_customer,
            'alamat' => $request->alamat,
            'sumber_informasi' => $request->sumber_informasi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('staff.transaksi.index')
            ->with('success', 'Transaksi berhasil diupdate');
    }

    public function destroy(TransaksiPelanggan $transaksi)
    {
        if ($transaksi->id_cabang !== auth()->user()->id_cabang) {
            abort(403, 'Unauthorized action.');
        }

        $transaksi->delete();

        return redirect()
            ->route('staff.transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus');
    }
    public function export(Request $request)
    {
        return Excel::download(
            new TransaksiPelangganExport($request),
            'data-transaksi-pelanggan.xlsx'
        );
    }
}
