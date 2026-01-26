<?php

namespace App\Models;

use App\Enums\TipeCustomer;
use App\Enums\SumberInformasi;
use App\Models\User;
use App\Models\Customer;
use App\Models\Cabang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class TransaksiPelanggan extends Model
{
    use SoftDeletes;

    protected $table = 'transaksi_pelanggan';

    protected $fillable = [
        'id_customer',
        'id_cabang',
        'tanggal',
        'tipe_customer',
        'jumlah_rombongan',
        'sumber_informasi',
        'keterangan',
        'created_by'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah_rombongan' => 'integer',
        'tipe_customer' => TipeCustomer::class,
        'sumber_informasi' => SumberInformasi::class,
        'deleted_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            if (!$model->isForceDeleting()) {
                $model->deleted_by = auth()->id();
                $model->saveQuietly();
            }
        });
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id');
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
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


    public function getIsRombonganAttribute()
    {
        return $this->tipe_customer === TipeCustomer::ROMBONGAN->value ||
            $this->tipe_customer === 'Rombongan';
    }

    public function getHariAttribute()
    {
        if (!$this->tanggal) {
            return '-';
        }

        return Carbon::parse($this->tanggal)->locale('id')->dayName;
    }
}
