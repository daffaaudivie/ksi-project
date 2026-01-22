<?php
// app/Enums/JenisBisnis.php

namespace App\Enums;

enum JenisBisnis: string
{
    case BENGKEL = 'Bengkel';
    case RESTORAN = 'Restoran';
    case WISATA = 'Wisata';
    case LAINNYA = 'Lainnya';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function options(): array
    {
        return array_combine(
            array_column(self::cases(), 'value'),
            array_column(self::cases(), 'value')
        );
    }

    public function label(): string
    {
        return match ($this) {
            self::BENGKEL => 'Bengkel',
            self::RESTORAN => 'Restoran',
            self::WISATA => 'Wisata',
            self::LAINNYA => 'Lainnya',
        };
    }

    // public function color(): string
    // {
    //     return match ($this) {
    //         self::TOKO_ROTI => 'blue',
    //         self::TOKO_KUE => 'pink',
    //         self::CAFE => 'green',
    //         self::RESTORAN => 'orange',
    //         self::LAINNYA => 'gray',
    //     };
    // }
}
