<?php

namespace App\Enums;

enum SumberInformasi: string
{
    case INSTAGRAM = 'Instagram';
    case TIKTOK = 'TikTok';
    case FACEBOOK = 'Facebook';
    case GOOGLE = 'Google';
    case WEBSITE = 'Website';
    case WALK_IN = 'Walk in';
    case WHATSAPP = 'Whatsapp';
    case REKOMENDASI_TEMAN = 'Rekomendasi teman';
    case PELANGGAN_LAMA = 'Pelanggan lama';
    case IKLAN_CETAK = 'Iklan cetak';
    case BANNER = 'Banner';
    case BROSUR = 'Brosur';
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
        return $this->value;
    }

    // public function icon(): string
    // {
    //     return match ($this) {
    //         self::INSTAGRAM => '📷',
    //         self::TIKTOK => '🎵',
    //         self::FACEBOOK => '👍',
    //         self::GOOGLE => '🔍',
    //         self::WEBSITE => '🌐',
    //         self::WALK_IN => '🚶',
    //         self::WHATSAPP => '💬',
    //         self::REKOMENDASI_TEMAN => '👋',
    //         self::PELANGGAN_LAMA => '⭐',
    //         self::IKLAN_CETAK => '📰',
    //         self::BANNER => '🎉',
    //         self::LAINNYA => '📌',
    //     };
    // }

    public function group(): string
    {
        return match ($this) {
            self::INSTAGRAM, self::TIKTOK, self::FACEBOOK => 'Social Media',
            self::GOOGLE, self::WEBSITE => 'Online',
            self::WALK_IN, self::REKOMENDASI_TEMAN, self::IKLAN_CETAK, self::BANNER, self::BROSUR => 'Offline',
            self::WHATSAPP, self::PELANGGAN_LAMA => 'Direct',
            default => 'Lainnya',
        };
    }
}
