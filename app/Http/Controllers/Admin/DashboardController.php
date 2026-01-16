<?php
// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\TransaksiPelanggan;
use App\Models\Cabang;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_customers' => Customer::count(),
            'total_transaksi' => TransaksiPelanggan::count(),
            'total_cabang' => Cabang::count(),
            'total_users' => User::count(),
            'transaksi_bulan_ini' => TransaksiPelanggan::whereMonth('tanggal', now()->month)
                ->whereYear('tanggal', now()->year)
                ->count(),
            'customer_baru_bulan_ini' => Customer::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
        ];

        $latest_transaksi = TransaksiPelanggan::with(['customer', 'cabang', 'user'])
            ->latest('tanggal')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'latest_transaksi'));
    }
}
