<?php

namespace App\Exports;

use App\Models\TransaksiPelanggan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class TransaksiPelangganExport implements FromView, WithColumnWidths, WithStyles
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $user = auth()->user();

        $query = TransaksiPelanggan::with(['customer', 'cabang', 'creator'])
            ->byCabang($user->id_cabang)
            ->recent();

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

        return view('exports.transaksi_pelanggan', [
            'transaksi' => $data,
            'cabang' => $user->cabang->nama_cabang,
            'periodeText' => $this->getPeriodeText(),
            'filterText' => $this->getFilterText(),
            'totalData' => $data->count(),
        ]);
    }

    private function getPeriodeText(): string
    {
        if ($this->request->filled('start_date') && $this->request->filled('end_date')) {
            $start = Carbon::parse($this->request->start_date)->translatedFormat('d F Y');
            $end = Carbon::parse($this->request->end_date)->translatedFormat('d F Y');

            if ($this->request->start_date === $this->request->end_date) {
                return "Data Pada Tanggal {$start}";
            }

            return "Data Periode {$start} - {$end}";
        } elseif ($this->request->filled('start_date')) {
            $tanggal = Carbon::parse($this->request->start_date)->translatedFormat('d F Y');
            return "Data Pada Tanggal {$tanggal}";
        } elseif ($this->request->filled('end_date')) {
            $tanggal = Carbon::parse($this->request->end_date)->translatedFormat('d F Y');
            return "Data Pada Tanggal {$tanggal}";
        }

        return "Data Keseluruhan Per " . Carbon::now()->translatedFormat('d F Y');
    }

    private function getFilterText(): ?string
    {
        $filters = [];

        if ($this->request->filled('tipe_customer')) {
            $tipeLabel = \App\Enums\TipeCustomer::from($this->request->tipe_customer)->label();
            $filters[] = "Tipe: {$tipeLabel}";
        }

        if ($this->request->filled('sumber_informasi')) {
            $sumberInformasi = \App\Enums\SumberInformasi::from($this->request->sumber_informasi)->label();
            $filters[] = "Sumber Informasi: {$sumberInformasi}";
        }

        if ($this->request->filled('search')) {
            $filters[] = "Pencarian: \"{$this->request->search}\"";
        }

        return !empty($filters) ? implode(' | ', $filters) : null;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,   // No
            'B' => 12,  // Hari
            'C' => 15,  // Tanggal
            'D' => 20,  // Cabang
            'E' => 25,  // Nama Customer
            'F' => 12,  // Tipe
            'G' => 16,  // No. HP
            'H' => 30,  // Alamat
            'I' => 25,  // Sumber Informasi
            'J' => 35,  // Keterangan
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Auto-fit row heights
        foreach ($sheet->getRowIterator() as $row) {
            $sheet->getRowDimension($row->getRowIndex())->setRowHeight(-1);
        }

        // Set minimum row height untuk header
        $sheet->getRowDimension(4)->setRowHeight(25);

        return [
            // Judul utama
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 16,
                    'color' => ['rgb' => '1F4E78'],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            // Subtitle periode
            2 => [
                'font' => [
                    'italic' => true,
                    'size' => 11,
                    'color' => ['rgb' => '555555'],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
            // Filter info
            3 => [
                'font' => [
                    'bold' => true,
                    'size' => 10,
                    'color' => ['rgb' => '0066CC'],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
            // Header tabel
            4 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                    'size' => 11,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '305496'],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
            ],
        ];
    }
}
