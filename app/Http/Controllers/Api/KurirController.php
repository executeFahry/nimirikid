<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kurir;
use Illuminate\Http\Request;

class KurirController extends Controller
{
    public function index()
    {
        return response()->json(Kurir::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kurir' => 'required|string|max:100',
            'no_hp' => 'required|string|max:15|unique:kurirs,no_hp',
            'area_pengiriman' => 'required|string|max:100',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $kurir = Kurir::create($validated);
        return response()->json($kurir, 201);
    }

    public function show($id)
    {
        $kurir = Kurir::findOrFail($id);
        return response()->json($kurir);
    }

    public function update(Request $request, $id)
    {
        $kurir = Kurir::findOrFail($id);

        $validated = $request->validate([
            'nama_kurir' => 'required|string|max:100',
            'no_hp' => 'required|string|max:15|unique:kurirs,no_hp,' . $id,
            'area_pengiriman' => 'required|string|max:100',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $kurir->update($validated);
        return response()->json($kurir);
    }

    public function destroy($id)
    {
        $kurir = Kurir::findOrFail($id);
        $kurir->delete();
        return response()->json(['message' => 'Data kurir berhasil dihapus']);
    }

    // melihat semua paket yang ditangani oleh kurir tertentu
    public function paket($id)
    {
        $kurir = Kurir::with('paket')->findOrFail($id);
        return response()->json($kurir->paket);
    }
}
