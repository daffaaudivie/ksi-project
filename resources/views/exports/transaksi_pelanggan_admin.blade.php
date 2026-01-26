<table>
    <thead>
        {{-- BARIS 1: JUDUL --}}
        <tr>
            <th colspan="10" style="font-size: 16px; font-weight: bold; text-align: center; color: #1F4E78; padding: 15px;">
                FORM PENCATATAN DATA PELANGGAN - {{ strtoupper($cabang) }}
            </th>
        </tr>

        {{-- BARIS 2: PERIODE --}}
        <tr>
            <th colspan="10" style="font-size: 11px; font-style: italic; text-align: center; color: #555555; padding: 8px;">
                {{ $periodeText }}
            </th>
        </tr>

        {{-- BARIS 3: FILTER (Wajib ada agar Header tetap di Baris 5) --}}
        @if($filterText)
        <tr>
            <th colspan="10" style="font-size: 10px; font-weight: bold; text-align: center; color: #0066CC; padding: 5px;">
                Filter: {{ $filterText }}
            </th>
        </tr>
        @else
        <tr>
            <th colspan="10"></th>
        </tr>
        @endif

        {{-- BARIS 4: SPACER --}}
        <tr>
            <th colspan="10" style="height: 5px;"></th>
        </tr>

        {{-- BARIS 5: HEADER TABEL --}}
        <tr>
            <th style="background-color: #305496; color: #FFFFFF; font-weight: bold; border: 1px solid #000000; text-align: center; vertical-align: center; padding: 10px;">No</th>
            <th style="background-color: #305496; color: #FFFFFF; font-weight: bold; border: 1px solid #000000; text-align: center; vertical-align: center; padding: 10px;">Hari</th>
            <th style="background-color: #305496; color: #FFFFFF; font-weight: bold; border: 1px solid #000000; text-align: center; vertical-align: center; padding: 10px;">Tanggal</th>
            <th style="background-color: #305496; color: #FFFFFF; font-weight: bold; border: 1px solid #000000; text-align: center; vertical-align: center; padding: 10px;">Cabang</th>
            <th style="background-color: #305496; color: #FFFFFF; font-weight: bold; border: 1px solid #000000; text-align: center; vertical-align: center; padding: 10px;">Nama Customer</th>
            <th style="background-color: #305496; color: #FFFFFF; font-weight: bold; border: 1px solid #000000; text-align: center; vertical-align: center; padding: 10px;">Tipe</th>
            <th style="background-color: #305496; color: #FFFFFF; font-weight: bold; border: 1px solid #000000; text-align: center; vertical-align: center; padding: 10px;">No. HP</th>
            <th style="background-color: #305496; color: #FFFFFF; font-weight: bold; border: 1px solid #000000; text-align: center; vertical-align: center; padding: 10px;">Alamat</th>
            <th style="background-color: #305496; color: #FFFFFF; font-weight: bold; border: 1px solid #000000; text-align: center; vertical-align: center; padding: 10px;">Sumber Informasi</th>
            <th style="background-color: #305496; color: #FFFFFF; font-weight: bold; border: 1px solid #000000; text-align: center; vertical-align: center; padding: 10px;">Keterangan</th>
        </tr>
    </thead>

    <tbody>
        @forelse($transaksi as $i => $item)
        @php
        $bgColor = ($i % 2 === 0) ? '#FFFFFF' : '#E9EFF7';

        // Ambil Value Enum (String) untuk perbandingan yang aman
        $tipeValue = $item->tipe_customer instanceof \UnitEnum
        ? $item->tipe_customer->value
        : $item->tipe_customer;

        // Set Warna Hitam untuk semua
        $tipeColor = '#000000';

        // Default Label
        $tipeDisplay = $item->tipe_customer instanceof \App\Enums\TipeCustomer
        ? $item->tipe_customer->label()
        : $item->tipe_customer;

        // Logika Rombongan (Menggunakan Value String)
        if ($tipeValue === \App\Enums\TipeCustomer::ROMBONGAN->value && !empty($item->jumlah_rombongan)) {
        $tipeDisplay = "Rombongan ({$item->jumlah_rombongan} Orang)";
        }
        @endphp

        <tr>
            <td style="background-color: {{ $bgColor }}; border: 1px solid #CCCCCC; text-align: center; padding: 8px;">
                {{ $i + 1 }}
            </td>
            <td style="background-color: {{ $bgColor }}; border: 1px solid #CCCCCC; text-align: left; padding: 8px;">
                {{ $item->hari }}
            </td>
            <td style="background-color: {{ $bgColor }}; border: 1px solid #CCCCCC; text-align: center; padding: 8px;">
                {{ $item->tanggal->format('d/m/Y') }}
            </td>
            <td style="background-color: {{ $bgColor }}; border: 1px solid #CCCCCC; text-align: left; padding: 8px;">
                {{ $item->cabang->nama_cabang }}
            </td>
            <td style="background-color: {{ $bgColor }}; border: 1px solid #CCCCCC; text-align: left; padding: 8px; font-weight: bold;">
                {{ $item->customer->nama_customer }}
            </td>

            {{-- KOLOM TIPE CUSTOMER --}}
            <td style="background-color: {{ $bgColor }}; border: 1px solid #CCCCCC; text-align: center; padding: 8px; font-weight: bold; color: {{ $tipeColor }};">
                {{ $tipeDisplay }}
            </td>

            <td style="background-color: {{ $bgColor }}; border: 1px solid #CCCCCC; text-align: left; padding: 8px;">
                {{ $item->customer->no_hp }}
            </td>
            <td style="background-color: {{ $bgColor }}; border: 1px solid #CCCCCC; text-align: left; padding: 8px;">
                {{ $item->customer->nama_kota }}
            </td>
            <td style="background-color: {{ $bgColor }}; border: 1px solid #CCCCCC; text-align: left; padding: 8px;">
                {{ $item->sumber_informasi }}
            </td>
            <td style="background-color: {{ $bgColor }}; border: 1px solid #CCCCCC; text-align: left; padding: 8px;">
                {{ $item->keterangan ?? '-' }}
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10" style="background-color: #FFF3CD; border: 1px solid #CCCCCC; text-align: center; padding: 20px; color: #856404; font-style: italic;">
                Tidak ada data transaksi sesuai filter yang diterapkan
            </td>
        </tr>
        @endforelse
    </tbody>

    @if($transaksi->count() > 0)
    <tfoot>
        <tr>
            <td colspan="10" style="height: 10px;"></td>
        </tr>
        <tr>
            <td colspan="10" style="background-color: #F2F2F2; border: 1px solid #CCCCCC; padding: 10px; font-weight: bold; text-align: right;">
                Total Data: {{ $totalData }} Transaksi
            </td>
        </tr>
        <tr>
            <td colspan="10" style="padding: 15px; font-size: 9px; color: #888888; text-align: center; font-style: italic;">
                Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y - H:i:s') }} WIB
            </td>
        </tr>
    </tfoot>
    @endif
</table>