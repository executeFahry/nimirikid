<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $table = 'paket';
    protected $primaryKey = 'id_paket';
    public $timestamps = false;

    protected $fillable = [
        'id_pengirim',
        'id_penerima',
        'id_kurir',
        'status',
        'tanggal_pengiriman'
    ];

    // Relasi ke pengirim
    public function pengirim()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pengirim');
    }

    // Relasi ke penerima
    public function penerima()
    {
        return $this->belongsTo(Pelanggan::class, 'id_penerima');
    }

    // Relasi ke kurir
    public function kurir()
    {
        return $this->belongsTo(Kurir::class, 'id_kurir');
    }

    // Relasi ke status pengiriman
    public function statusPengiriman()
    {
        return $this->hasMany(StatusPengiriman::class, 'id_paket');
    }

    // Event listenet untuk otoamatisasi status pengiriman
    protected static function boot()
    {
        parent::boot();

        // Ketika paket baru dibuat
        static::created(function ($paket) {
            // Membuat status pengiriman pertama
            StatusPengiriman::create([
                'id_paket' => $paket->id_paket,
                'status' => 'Pending',
                'waktu_status' => now(),
                'catatan' => 'Paket baru dibuat dan menunggu proses pengambilan oleh kurir',
            ]);
        });

        // Ketika paket dihapus
        static::deleted(function ($paket) {
            $paket->statusPengiriman()->delete();
        });
    }

    public function generateStatusNote()
    {
        $kurirName = $this->kurir->nama_kurir ?? 'Kurir';
        switch ($this->status) {
            case 'Pending':
                return 'Paket baru dibuat dan menunggu proses pengambilan oleh kurir';
            case 'Diambil':
                return "Paket baru diambil oleh {$kurirName} dan akan dikirimkan ke lokasi tujuan";
            case 'Dalam Pengiriman':
                return "{$kurirName} sedang menuju ke lokasi Anda";
            case 'Terkirim':
                return 'Paket telah sampai ke lokasi tujuan';
            case 'Gagal':
                return 'Paket Anda gagal dikirim karena ada kendala pengiriman';
            default:
                return 'Status tidak dikenali';
        }
    }
}
