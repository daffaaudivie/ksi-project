<?php

namespace Database\Seeders;

use App\Models\Cabang;
use App\Enums\JenisBisnis;
use Illuminate\Database\Seeder;

class CabangSeeder extends Seeder
{
    public function run(): void
    {
        Cabang::create([
            'nama_cabang' => 'Desapa Resto',
            'jenis_bisnis' => JenisBisnis::RESTORAN,
            'alamat' => 'Jl. Kasembon No. 123, Malang',
            'telepon' => '450722',
            'kota' => 'Malang',
            'is_active' => true,
        ]);

        Cabang::create([
            'nama_cabang' => 'KSI AC Mobil Malang',
            'jenis_bisnis' => JenisBisnis::BENGKEL,
            'alamat' => 'Jl. Sawojajar No. 45, Malang',
            'telepon' => '031234567',
            'kota' => 'Malang',
            'is_active' => true,
        ]);

        Cabang::create([
            'nama_cabang' => 'Coban Kethak',
            'jenis_bisnis' => JenisBisnis::WISATA,
            'alamat' => 'Jl. Kasembon No. 78, Malang',
            'telepon' => '021-345678',
            'kota' => 'Malang',
            'is_active' => true,
        ]);
    }
}
