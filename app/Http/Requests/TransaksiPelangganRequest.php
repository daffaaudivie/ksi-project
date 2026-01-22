<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransaksiPelangganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_customer' => ['required', 'string', 'max:150'],
            'no_hp' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:100'],
            'alamat' => ['required', 'string', 'max:255'],
            'tipe_customer' => ['required', 'string', 'max:50'],

            'tanggal' => ['required', 'date'],
            'sumber_informasi' => ['required', 'string', 'max:50'],
            'keterangan' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_customer.required' => 'Nama customer wajib diisi',
            'no_hp.required' => 'Nomor HP wajib diisi',
            'tanggal.required' => 'Tanggal transaksi harus diisi',
            'tanggal.date' => 'Format tanggal tidak valid',
            'tipe_customer.required' => 'Tipe customer harus dipilih',
            'sumber_informasi.required' => 'Sumber informasi harus dipilih',
        ];
    }
}
