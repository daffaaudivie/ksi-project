<?php

namespace App\Models;

use App\Enums\TipeCustomer;
use App\Enums\SumberInformasi;
use App\Models\User;
use App\Models\Customer;
use App\Models\Cabang;
use Illuminate\Database\Eloquent\Model;

class TransaksiPelanggan extends Model
{
    protected $table = 'transaksi_pelanggan';

    protected $fillable = [
        'id_customer', 
        'id_cabang',    
        'tanggal',
        'hari',
        'tipe_customer',
        'sumber_informasi',
        'keterangan',
        'created_by'   
    ];

    protected $casts = [
        'tanggal' => 'date',
        'tipe_customer' => TipeCustomer::class,
        'sumber_informasi' => SumberInformasi::class,
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id');
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getHariIndonesiaAttribute()
    {
        $days = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu',
        ];

        return $days[$this->hari] ?? $this->hari;
    }

    public function scopeByCabang($query, $cabangId)
    {
        return $query->where('id_cabang', $cabangId);
    }

    public function scopeByCustomer($query, $customerId)
    {
        return $query->where('id_customer', $customerId);
    }

    public function scopeByTanggal($query, $tanggal)
    {
        return $query->whereDate('tanggal', $tanggal);
    }

    public function scopeByPeriode($query, $startDate, $endDate)
    {
        return $query->whereBetween('tanggal', [$startDate, $endDate]);
    }

    public function scopeByBulan($query, $tahun, $bulan)
    {
        return $query->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan);
    }

    public function scopeByTahun($query, $tahun)
    {
        return $query->whereYear('tanggal', $tahun);
    }

    public function scopeBySumberInformasi($query, SumberInformasi $sumber)
    {
        return $query->where('sumber_informasi', $sumber->value);
    }

    public function scopeByTipeCustomer($query, TipeCustomer $tipe)
    {
        return $query->where('tipe_customer', $tipe->value);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc');
    }
}
