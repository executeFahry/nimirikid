<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPengiriman extends Model
{
    use HasFactory;
    protected $table = 'status_pengiriman';
    protected $primaryKey = 'id_status';
    public $timestamps = false;

    protected $fillable = [
        'id_paket',
        'status',
        'waktu_status',
        'catatan'
    ];

    // Relasi ke paket
    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket');
    }
}
