<?php
// app/Enums/TipeCustomer.php

namespace App\Enums;

enum TipeCustomer: string
{
    case PERORANGAN = 'Perorangan';
    case ROMBONGAN = 'Rombongan';
    case FLEET = 'Fleet';

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
            self::PERORANGAN => 'Perorangan',
            self::ROMBONGAN => 'Rombongan',
            self::FLEET => 'Fleet',
        };
    }

    // public function icon(): string
    // {
    //     return match ($this) {
    //         self::PERORANGAN => '👤',
    //         self::ROMBONGAN => '👥',
    //         self::FLEET => '🚗',
    //     };
    // }
}
