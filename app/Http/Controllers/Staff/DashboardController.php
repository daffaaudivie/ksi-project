<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\TransaksiPelanggan;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $cabangId = auth()->user()->id_cabang;

        $stats = [
            'total_transaksi' => TransaksiPelanggan::where('id_cabang', $cabangId)->count(),
            'transaksi_hari_ini' => TransaksiPelanggan::where('id_cabang', $cabangId)
                ->whereDate('tanggal', now())
                ->count(),
            'transaksi_bulan_ini' => TransaksiPelanggan::where('id_cabang', $cabangId)
                ->whereMonth('tanggal', now()->month)
                ->whereYear('tanggal', now()->year)
                ->count(),
            'customer_unik' => TransaksiPelanggan::where('id_cabang', $cabangId)
                ->distinct('id_customer')
                ->count('id_customer'),
        ];

        $latest_transaksi = TransaksiPelanggan::with(['customer', 'creator'])
            ->where('id_cabang', $cabangId)
            ->latest('tanggal')
            ->limit(5)
            ->get();

        return view('staff.dashboard', compact('stats', 'latest_transaksi'));
    }
}
