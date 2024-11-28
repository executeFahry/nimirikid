<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        return response()->json(Pelanggan::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:pelanggan,email',
            'no_hp' => 'required|string|max:15',
        ]);

        // Check for duplicate email
        if (Pelanggan::where('email', $validated['email'])->exists()) {
            return response()->json(['message' => 'Email sudah terdaftar'], 409);
        }

        $pelanggan = Pelanggan::create($validated);
        return response()->json($pelanggan, 201);
    }

    public function show($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return response()->json($pelanggan);
    }

    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:pelanggan,email,' . $id . ',id_pelanggan',
            'no_hp' => 'required|string|max:15',
        ]);

        $pelanggan->update($validated);
        return response()->json($pelanggan);
    }

    public function destroy($id)
    {
        try {
            $pelanggan = Pelanggan::findOrFail($id);
            $pelanggan->delete();
            return response()->json(['message' => 'Data pelanggan berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus pelanggan: ' . $e->getMessage()], 500);
        }
    }

    // melihat paket yang dikirim oleh pelanggan tertentu
    public function paketDikirim($id)
    {
        $pelanggan = Pelanggan::with('paketDikirim')->findOrFail($id);
        return response()->json($pelanggan->paketDikirim);
    }
}
