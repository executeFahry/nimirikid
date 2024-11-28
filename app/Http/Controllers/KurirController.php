<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kurir;

class KurirController extends Controller
{
    /**
     * Display a listing of the resource.   
     */
    public function index()
    {
        $kurirs = Kurir::all();
        return view('kurir.index', compact('kurirs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kurir.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kurir' => 'required|string|max:100',
            'no_hp' => 'required|string:max:15',
            'area_pengiriman' => 'required|string|max:100',
            'status' => 'required|in:Aktif,Tidak Aktif'
        ]);

        Kurir::create($validated);
        return redirect()->route('kurir.index')->with('success', 'Data kurir berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kurir $kurir)
    {
        return view('kurir.edit', compact('kurir'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kurir $kurir)
    {
        $validated = $request->validate([
            'nama_kurir' => 'required|string|max:100',
            'no_hp' => 'required|string:max:15',
            'area_pengiriman' => 'required|string|max:100',
            'status' => 'required|in:Aktif,Tidak Aktif'
        ]);

        $kurir->update($validated);
        return redirect()->route('kurir.index')->with('success', 'Data kurir berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kurir $kurir)
    {
        $kurir->delete();
        return redirect()->route('kurir.index')->with('success', 'Data kurir berhasil dihapus');
    }
}
