<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class   User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Menambahkan kolom 'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Pastikan hubungan dengan Kurir sudah benar
    public function kurir()
    {
        return $this->hasOne(Kurir::class, 'user_id'); // Hubungan one-to-one ke tabel Kurir
    }

    // Menambahkan relasi untuk pelanggan
    public function pelanggan()
    {
        return $this->hasOne(Pelanggan::class, 'user_id'); // Hubungan one-to-one ke tabel Pelanggan
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isKurir()
    {
        return $this->role === 'kurir';
    }

    public function isPelanggan()
    {
        return $this->role === 'pelanggan';
    }
}
