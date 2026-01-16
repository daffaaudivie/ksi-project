<?php

namespace App\Models;

use App\Enums\TipeCustomer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $table = 'customers';

    protected $fillable = [
        'nama_customer',
        'no_hp',
        'alamat_utama',
        'tipe_default',
        'email',
        'catatan'
    ];

    protected $casts = [
        'tipe_default' => TipeCustomer::class,
    ];

    public function transaksi()
    {
        return $this->hasMany(TransaksiPelanggan::class, 'id_customer');
    }

    public function getTotalTransaksiAttribute()
    {
        return $this->transaksi()->count();
    }

    public function getTransaksiTerakhirAttribute()
    {
        return $this->transaksi()->latest('tanggal')->first();
    }

    public function scopeByNoHP($query, $noHP)
    {
        return $query->where('no_hp', $noHP);
    }

    public function scopeByTipe($query, TipeCustomer $tipe)
    {
        return $query->where('tipe_default', $tipe->value);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('nama_customer', 'like', "%{$search}%")
                ->orWhere('no_hp', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        });
    }
}
