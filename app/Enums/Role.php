<?php
// app/Enums/Role.php

namespace App\Enums;

enum Role: string
{
    case SUPER_ADMIN = 'super_admin';
    case ADMIN = 'admin';
    case MANAGER = 'manager';
    case STAFF = 'staff';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function options(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value] = $case->label();
        }
        return $options;
    }

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::MANAGER => 'Manager',
            self::STAFF => 'Staff',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::ADMIN => 'Akses penuh ke semua fitur dan cabang',
            self::MANAGER => 'Lihat laporan dan kelola transaksi',
            self::STAFF => 'Input data pelanggan dan transaksi',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'red',
            self::ADMIN => 'blue',
            self::MANAGER => 'green',
            self::STAFF => 'gray',
        };
    }

    public function canAccessAllCabang(): bool
    {
        return $this === self::ADMIN;
    }

    public function canManageUsers(): bool
    {
        return in_array($this, [self::ADMIN]);
    }

    public function canViewReports(): bool
    {
        return true;
    }

    public function canInputData(): bool
    {
        return true; 
    }

    public function canDeleteData(): bool
    {
        return in_array($this, [self::ADMIN, self::MANAGER]);
    }

    public function level(): int
    {
        return match ($this) {
            self::ADMIN => 3,
            self::MANAGER => 2,
            self::STAFF => 1,
        };
    }
    public function isHigherThan(Role $role): bool
    {
        return $this->level() > $role->level();
    }
    public function isSameOrHigherThan(Role $role): bool
    {
        return $this->level() >= $role->level();
    }
}
