<?php

namespace App\Http\Controllers;

use App\Models\StatusPengiriman;
use App\Models\Paket;
use Illuminate\Http\Request;

class StatusPengirimanController extends Controller
{
    public function index()
    {
        // Ambil data status pengiriman dari paket yang dikirim oleh user
        $user = auth()->user();

        if ($user->isPelanggan()) {
            // Hanya status pengiriman untuk paket yang dikirim oleh pengguna ini
            $statusPengiriman = StatusPengiriman::with(['paket'])
                ->whereHas('paket', function ($query) use ($user) {
                    $query->where('id_pengirim', $user->pelanggan->id_pelanggan);
                })
                ->orderBy('id_paket')
                ->orderByDesc('waktu_status') // Status terbaru muncul lebih dulu
                ->get()
                ->groupBy('id_paket');
        } else {
            $statusPengiriman = StatusPengiriman::with(['paket'])
                ->orderBy('id_paket')
                ->orderByDesc('waktu_status')
                ->get()
                ->groupBy('id_paket');
        }

        return view('status-pengiriman.index', compact('statusPengiriman'));
    }


    public function edit(StatusPengiriman $statusPengiriman)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Access denied.');
        }

        $pakets = Paket::all();
        return view('status-pengiriman.edit', compact('statusPengiriman', 'pakets'));
    }

    public function update(Request $request, StatusPengiriman $statusPengiriman)
    {
        // Pastikan hanya admin yang dapat mengupdate status pengiriman
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Access denied.');
        }

        $validated = $request->validate([
            'id_paket' => 'required|exists:paket,id_paket',
            'status' => 'required|in:Pending,Diambil,Dalam Pengiriman,Terkirim,Gagal',
            'waktu_status' => 'required|date_format:Y-m-d\TH:i',
            'catatan' => 'nullable|string',
        ]);


        $statusPengiriman->update($validated);

        // Update status paket berdasarkan perubahan status pengiriman
        $statusPengiriman->paket->update([
            'status' => $validated['status']
        ]);

        return redirect()->route('status-pengiriman.index')->with('success', 'Data status pengiriman berhasil diubah.');
    }

    // public function destroy(StatusPengiriman $statusPengiriman)
    // {
    //     $statusPengiriman->delete();
    //     return redirect()->route('status-pengiriman.index')->with('success', 'Data status pengiriman berhasil dihapus.');
    // }
}
