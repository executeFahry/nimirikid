<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use App\Models\StatusPengiriman;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        return response()->json(Paket::with(['pengirim', 'penerima', 'kurir'])->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pengirim' => 'required|exists:pelanggan,id_pelanggan',
            'id_penerima' => 'required|exists:pelanggan,id_pelanggan',
            'id_kurir' => 'required|exists:kurir,id_kurir',
            'status' => 'required|in:Pending,Diambil,Dalam Pengiriman,Terkirim,Gagal',
            'tanggal_pengiriman' => 'required|date',
        ]);

        $paket = Paket::create($validated);
        return response()->json($paket, 201);
    }

    public function show($id)
    {
        $paket = Paket::with(['pengirim', 'penerima', 'kurir', 'statusPengiriman'])->findOrFail($id);
        return response()->json($paket);
    }

    public function update(Request $request, $id)
    {
        $paket = Paket::findOrFail($id);

        $validated = $request->validate([
            'id_pengirim' => 'required|exists:pelanggan,id_pelanggan',
            'id_penerima' => 'required|exists:pelanggan,id_pelanggan',
            'id_kurir' => 'required|exists:kurir,id_kurir',
            'status' => 'required|in:Pending,Diambil,Dalam Pengiriman,Terkirim,Gagal',
            'tanggal_pengiriman' => 'required|date',
        ]);

        $paket->update($validated);
        return response()->json($paket);
    }

    public function destroy($id)
    {
        $paket = Paket::findOrFail($id);
        if ($paket->statusPengiriman()->exists()) {
            $paket->statusPengiriman()->delete();
        }
        $paket->delete();
        return response()->json(['message' => 'Data paket berhasil dihapus']);
    }

    // Mengubah status pengiriman paket secara otomatis
    public function ubahStatus(Request $request, $id)
    {
        $paket = Paket::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:Pending,Diambil,Dalam Pengiriman,Terkirim,Gagal',
        ]);

        if ($paket->status !== $validated['status']) {
            $paket->update(['status' => $validated['status']]);

            // Tambahkan status baru ke riwayat pengiriman
            StatusPengiriman::create([
                'id_paket' => $paket->id_paket,
                'status' => $validated['status'],
                'waktu_status' => now(),
                'catatan' => $paket->generateStatusNote(),
            ]);
        }

        return response()->json([
            'message' => 'Status pengiriman berhasil diperbarui',
            'paket' => $paket,
        ]);
    }
}
