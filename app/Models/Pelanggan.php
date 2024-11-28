<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'nama_pelanggan',
        'alamat',
        'email',
        'no_hp',
    ];

    // Relasi ke paket sebagai pengirim
    public function paketDikirim()
    {
        return $this->hasMany(Paket::class, 'id_pengirim');
    }

    // Relasi ke paket sebagai penerima
    public function paketDiterima()
    {
        return $this->hasMany(Paket::class, 'id_penerima');
    }

    protected static function boot()
    {
        parent::boot();

        // Ketika pelanggan dihapus, cek apakah masih digunakan sebagai pengirim atau penerima
        static::deleting(function ($pelanggan) {
            if ($pelanggan->paketDikirim()->exists() || $pelanggan->paketDiterima()->exists()) {
                throw new \Exception("Pelanggan tidak bisa dihapus karena masih digunakan sebagai pengirim atau penerima.");
            }
        });
    }
}
