<?php

namespace App\Http\Controllers;

use App\Models\Kurir;
use App\Models\Paket;
use App\Models\Pelanggan;

class HomeController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        // Jika admin, kirimkan data untuk admin
        if ($user->isAdmin()) {
            // Ambil data untuk admin
            $pelanggans = Pelanggan::count();
            $kurirs = Kurir::count();
            $paketsNotDelivered = Paket::where('status', '!=', 'Terkirim')->count();

            return view('dashboard', compact('pelanggans', 'kurirs', 'paketsNotDelivered'))->with('role', 'admin');
        }

        // Jika kurir, kirimkan data untuk kurir
        if ($user->isKurir()) {
            $paketsForKurir = Paket::where('id_kurir', $user->kurir->id_kurir)->where('status', '!=', 'Terkirim')->count();

            return view('dashboard', compact('paketsForKurir'))->with('role', 'kurir');
        }

        // Jika pelanggan, kirimkan data untuk pelanggan
        if ($user->isPelanggan()) {
            $paketsForPelanggan = Paket::where('id_pengirim', $user->pelanggan->id_pelanggan)->where('status', '!=', 'Terkirim')->count();

            return view('dashboard', compact('paketsForPelanggan'))->with('role', 'pelanggan');
        }

        // Jika bukan admin, kurir, atau pelanggan, akses ditolak
        abort(403, 'Akses ditolak!');
    }
}
