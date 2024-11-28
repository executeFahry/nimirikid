<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StatusPengiriman;
use Illuminate\Http\Request;

class StatusPengirimanController extends Controller
{
    public function index()
    {
        return response()->json(StatusPengiriman::with('paket')->get());
    }

    public function store(Request $request)
    {
        dd('Masuk ke metode store', $request->all());
        $validated = $request->validate([
            'id_paket' => 'required|exists:paket,id_paket',
            'status' => 'required|in:Pending,Diambil,Dalam Pengiriman,Terkirim,Gagal',
            'waktu_status' => 'required|date_format:Y-m-d H:i:s',
            'catatan' => 'nullable|string',
        ]);


        $statusPengiriman = StatusPengiriman::create($validated);
        return response()->json($statusPengiriman, 201);
    }

    public function show($id)
    {
        $statusPengiriman = StatusPengiriman::with('paket')->findOrFail($id);
        return response()->json($statusPengiriman);
    }

    public function update(Request $request, $id)
    {
        $statusPengiriman = StatusPengiriman::findOrFail($id);

        $validated = $request->validate([
            'id_paket' => 'required|exists:paket,id_paket',
            'status' => 'required|in:Diambil,Dalam Pengiriman,Terkirim,Gagal',
            'waktu_status' => 'required|date_format:Y-m-d\TH:i',
            'catatan' => 'nullable|string',
        ]);

        $statusPengiriman->update($validated);

        // Update status paket berdasarkan perubahan status pengiriman
        $statusPengiriman->paket->update([
            'status' => $validated['status']
        ]);

        return response()->json($statusPengiriman);
    }

    public function destroy($id)
    {
        $statusPengiriman = StatusPengiriman::findOrFail($id);
        $statusPengiriman->delete();
        return response()->json(['message' => 'Data status pengiriman berhasil dihapus']);
    }
}
