<?php

namespace App\Exports;

use App\Models\TransaksiPelanggan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class TransaksiPelangganAdminExport implements FromView, WithColumnWidths, WithStyles
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $query = TransaksiPelanggan::with(['customer', 'cabang', 'creator'])
            ->recent();

        if ($this->request->filled('id_cabang')) {
            $query->where('id_cabang', $this->request->id_cabang);
            $namaCabang = \App\Models\Cabang::find($this->request->id_cabang)->nama_cabang;
        } else {
            $namaCabang = "SEMUA CABANG";
        }

        if ($this->request->filled('start_date') && $this->request->filled('end_date')) {
            $query->byPeriode($this->request->start_date, $this->request->end_date);
        } elseif ($this->request->filled('start_date')) {
            $query->byTanggal($this->request->start_date);
        } elseif ($this->request->filled('end_date')) {
            $query->byTanggal($this->request->end_date);
        }

        if ($this->request->filled('search')) {
            $search = $this->request->search;
            $query->whereHas('customer', function ($q) use ($search) {
                $q->where('nama_customer', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        if ($this->request->filled('tipe_customer')) {
            $query->where('tipe_customer', $this->request->tipe_customer);
        }

        if ($this->request->filled('sumber_informasi')) {
            $query->where('sumber_informasi', $this->request->sumber_informasi);
        }

        $data = $query->get();

        return view('exports.transaksi_pelanggan_admin', [
            'transaksi' => $data,
            'cabang' => $namaCabang,
            'periodeText' => $this->getPeriodeText(),
            'filterText' => $this->getFilterText(),
            'totalData' => $data->count(),
        ]);
    }

    // ... Copy paste function getPeriodeText & getFilterText dari Export sebelumnya ...
    private function getPeriodeText(): string
    {
        if ($this->request->filled('start_date') && $this->request->filled('end_date')) {
            $start = Carbon::parse($this->request->start_date)->translatedFormat('d F Y');
            $end = Carbon::parse($this->request->end_date)->translatedFormat('d F Y');
            if ($this->request->start_date === $this->request->end_date) return "Data Pada Tanggal {$start}";
            return "Data Periode {$start} - {$end}";
        } elseif ($this->request->filled('start_date')) {
            return "Data Pada Tanggal " . Carbon::parse($this->request->start_date)->translatedFormat('d F Y');
        } elseif ($this->request->filled('end_date')) {
            return "Data Pada Tanggal " . Carbon::parse($this->request->end_date)->translatedFormat('d F Y');
        }
        return "Data Keseluruhan Per " . Carbon::now()->translatedFormat('d F Y');
    }

    private function getFilterText(): ?string
    {
        $filters = [];
        if ($this->request->filled('tipe_customer')) {
            $filters[] = "Tipe: " . \App\Enums\TipeCustomer::from($this->request->tipe_customer)->label();
        }
        if ($this->request->filled('sumber_informasi')) {
            $filters[] = "Sumber Informasi: " . \App\Enums\SumberInformasi::from($this->request->sumber_informasi)->label();
        }
        if ($this->request->filled('search')) {
            $filters[] = "Pencarian: \"{$this->request->search}\"";
        }
        return !empty($filters) ? implode(' | ', $filters) : null;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,  // No
            'B' => 12, // Hari
            'C' => 15, // Tanggal
            'D' => 25, // Cabang (LEBIH LEBAR)
            'E' => 25, // Nama
            'F' => 25, // Tipe
            'G' => 16, // No HP
            'H' => 25, // Alamat
            'I' => 25, // Sumber Info
            'J' => 35, // Keterangan
        ];
    }

    public function styles(Worksheet $sheet)
    {
        foreach ($sheet->getRowIterator() as $row) {
            $sheet->getRowDimension($row->getRowIndex())->setRowHeight(-1);
        }
        $sheet->getRowDimension(5)->setRowHeight(40);

        return [
            1 => ['font' => ['bold' => true, 'size' => 16, 'color' => ['rgb' => '1F4E78']], 'alignment' => ['horizontal' => 'center', 'vertical' => 'center']],
            2 => ['font' => ['italic' => true, 'size' => 11, 'color' => ['rgb' => '555555']], 'alignment' => ['horizontal' => 'center']],
            3 => ['font' => ['bold' => true, 'size' => 10, 'color' => ['rgb' => '0066CC']], 'alignment' => ['horizontal' => 'center']],
            5 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
                'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '305496']],
                'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => ['rgb' => '000000']]],
            ],
        ];
    }
}
