<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurir extends Model
{
    use HasFactory;

    protected $table = 'kurir';
    protected $primaryKey = 'id_kurir';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'nama_kurir',
        'no_hp',
        'area_pengiriman',
        'status',
    ];

    // Relasi ke paket  
    public function paket()
    {
        return $this->hasMany(Paket::class, 'id_kurir');
    }

    protected static function boot()
    {
        parent::boot();

        // Ketika kurir dihapus, cek apakah masih mengirim paket
        static::deleting(function ($kurir) {
            if ($kurir->paketDikirim()->exists() || $kurir->paketDiterima()->exists()) {
                throw new \Exception("Kurir tidak bisa dihapus karena masih mengirim atau menerima paket");
            }
        });
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class); // Relasi many-to-one ke user
    }

    // Ambil email kurir lewat user
    public function getEmail()
    {
        return $this->user->email;  // Mengambil email dari model User terkait
    }
}
