<?php

namespace App\Models;

use App\Enums\JenisBisnis;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $table = 'cabang';
    protected $primaryKey = 'id_cabang';

    protected $fillable = [
        'nama_cabang',
        'jenis_bisnis',
        'alamat',
        'telepon',
        'kota',
        'is_active'
    ];

    protected $casts = [
        'jenis_bisnis' => JenisBisnis::class,
        'is_active' => 'boolean',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_cabang', 'id_cabang');
    }

    public function transaksiPelanggan()
    {
        return $this->hasMany(TransaksiPelanggan::class, 'id_cabang', 'id_cabang');
    }
}
