<?php

namespace App\Models;

use App\Enums\JenisBisnis;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 1. Import SoftDeletes

class Cabang extends Model
{
    use SoftDeletes; 

    protected $table = 'cabang';

    protected $fillable = [
        'nama_cabang',
        'jenis_bisnis',
        'alamat',
        'telepon',
        'is_active',
        'id_provinsi',
        'nama_provinsi',
        'id_kota',
        'nama_kota',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $casts = [
        'jenis_bisnis' => JenisBisnis::class,
        'is_active' => 'boolean',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_cabang');
    }

    public function transaksiPelanggan()
    {
        return $this->hasMany(TransaksiPelanggan::class, 'id_cabang');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function destroyer()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
