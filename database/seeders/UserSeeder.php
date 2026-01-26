<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cabang;
use App\Enums\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('abcd1234'),
            'id_cabang' => null, 
            'role' => Role::ADMIN,
            'email_verified_at' => now(),
        ]);

        $cabangDesapa = Cabang::where('nama_cabang', 'Desapa Resto')->firstOrFail();
        $cabangKsiMalang = Cabang::where('nama_cabang', 'KSI AC Mobil Malang')->firstOrFail();
        $cabangCobanKethak = Cabang::where('nama_cabang', 'Coban Kethak')->firstOrFail();

        User::create([
            'nama' => 'Staff Desapa',
            'email' => 'desapa@gmail.com',
            'password' => Hash::make('abcd1234'),
            'id_cabang' => $cabangDesapa->id,
            'role' => Role::STAFF,
            'email_verified_at' => now(),
        ]);

        User::create([
            'nama' => 'Staff KSI Malang',
            'email' => 'ksimalang@gmail.com',
            'password' => Hash::make('abcd1234'),
            'id_cabang' => $cabangKsiMalang->id,
            'role' => Role::STAFF,
            'email_verified_at' => now(),
        ]);

        User::create([
            'nama' => 'Staff Coban kethak',
            'email' => 'kethak@gmail.com',
            'password' => Hash::make('abcd1234'),
            'id_cabang' => $cabangCobanKethak->id,
            'role' => Role::STAFF,
            'email_verified_at' => now(),
        ]);
    }
}
