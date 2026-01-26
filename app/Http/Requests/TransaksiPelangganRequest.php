<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransaksiPelangganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        $rules = [
            // Data Customer
            'nama_customer' => ['required', 'string', 'max:150'],
            'no_hp'         => ['nullable', 'string', 'max:20'],
            'email'         => ['nullable', 'email', 'max:100'],

            // Lokasi (Opsional)
            'id_provinsi'   => ['nullable', 'string', 'max:10'],
            'nama_provinsi' => ['nullable', 'string', 'max:100'],
            'id_kota'       => ['nullable', 'string', 'max:10'],
            'nama_kota'     => ['nullable', 'string', 'max:100'],
            'alamat_detail' => ['nullable', 'string', 'max:255'],

            // Catatan Customer
            'catatan'       => ['nullable', 'string'],

            // Data Transaksi
            'tanggal'          => ['required', 'date'],
            'tipe_customer'    => ['required', 'string', 'in:Perorangan,Rombongan,Fleet'],
            'jumlah_rombongan' => [
                'nullable',
                'integer',
                'min:2',
                Rule::requiredIf(fn() => $this->tipe_customer === 'Rombongan')
            ],
            'sumber_informasi' => ['required', 'string', 'max:50'],
            'keterangan'       => ['nullable', 'string'],
        ];

        if ($this->routeIs('admin.*')) {
            $rules['id_cabang'] = ['required', 'exists:cabang,id'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'id_cabang.required'        => 'Cabang wajib dipilih.',
            'id_cabang.exists'          => 'Cabang tidak valid.',
            'nama_customer.required'    => 'Nama customer wajib diisi',
            'no_hp.required'            => 'Nomor HP wajib diisi',
            'email.email'               => 'Format email tidak valid',
            'tanggal.required'          => 'Tanggal transaksi harus diisi',
            'tanggal.date'              => 'Format tanggal tidak valid',
            'tipe_customer.required'    => 'Tipe customer harus dipilih',
            'tipe_customer.in'          => 'Tipe customer tidak valid',
            'jumlah_rombongan.required' => 'Jumlah rombongan wajib diisi untuk tipe Rombongan',
            'jumlah_rombongan.min'      => 'Jumlah rombongan minimal 2 orang',
            'sumber_informasi.required' => 'Sumber informasi harus dipilih',
        ];
    }
}
