<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'id_cabang', 
        'role',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'role' => Role::class,
    ];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id');
    }

    public function transaksiPelanggan()
    {
        return $this->hasMany(TransaksiPelanggan::class, 'created_by');
    }

    public function isAdmin(): bool
    {
        return $this->role === Role::ADMIN;
    }

    public function isManager(): bool
    {
        return $this->role === Role::MANAGER;
    }

    public function isStaff(): bool
    {
        return $this->role === Role::STAFF;
    }

    public function canAccessAllCabang(): bool
    {
        return $this->role->canAccessAllCabang();
    }

    public function canManageUsers(): bool
    {
        return $this->role->canManageUsers();
    }

    public function canDeleteData(): bool
    {
        return $this->role->canDeleteData();
    }

    public function scopeByRole($query, Role $role)
    {
        return $query->where('role', $role->value);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCabang($query, $cabangId)
    {
        return $query->where('id', $cabangId);
    }
}
