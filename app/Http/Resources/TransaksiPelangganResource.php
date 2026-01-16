<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransaksiPelangganResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id_transaksi,
            'tanggal' => $this->tanggal->format('d/m/Y'),
            'tanggal_iso' => $this->tanggal->format('Y-m-d'),
            'hari' => $this->hari,
            'customer' => [
                'id' => $this->customer->id,
                'nama' => $this->customer->nama_customer,
                'telepon' => $this->customer->no_telepon ?? '-',
            ],
            'cabang' => [
                'id' => $this->cabang->id,
                'nama' => $this->cabang->nama_cabang,
            ],
            'tipe_customer' => $this->tipe_customer,
            'alamat' => $this->alamat ?? '-',
            'sumber_informasi' => $this->sumber_informasi,
            'keterangan' => $this->keterangan ?? '-',
            'created_by' => $this->creator ? $this->creator->name : '-',
            'created_at' => $this->created_at->format('d/m/Y H:i'),
        ];
    }
}
