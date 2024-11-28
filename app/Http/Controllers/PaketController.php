<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pelanggan;
use App\Models\Kurir;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::with(['pengirim', 'penerima', 'kurir'])->get();
        return view('paket.index', compact('pakets'));
    }

    public function indexKurir()
    {
        $user = auth()->user();

        // Pastikan user adalah kurir yang sesuai
        if (!$user->isKurir() || !$user->kurir) {
            abort(403, 'Access denied.');
        }

        // Ambil paket berdasarkan id_kurir yang diberikan
        $pakets = Paket::where('id_kurir', $user->kurir->id_kurir)->get();

        return view('paket.index', [
            'pakets' => $pakets,
        ]);
    }

    public function indexPelanggan()
    {
        $user = auth()->user();

        // Pastikan user adalah pelanggan dan memiliki data pelanggan
        if (!$user->isPelanggan() || !$user->pelanggan) {
            abort(403, 'Access denied.');
        }

        // Ambil paket berdasarkan id_pengirim dari pelanggan
        $pakets = Paket::where('id_pengirim', $user->pelanggan->id_pelanggan)->get();

        return view('paket.index', [
            'pakets' => $pakets,
        ]);
    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
        $kurirs = Kurir::all();
        return view('paket.create', compact('pelanggans', 'kurirs'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Access denied.');
        }

        $validated = $request->validate([
            'id_pengirim' => 'required|exists:pelanggan,id_pelanggan',
            'id_penerima' => 'required|exists:pelanggan,id_pelanggan',
            'id_kurir' => 'required|exists:kurir,id_kurir',
            'status' => 'required|in:Pending,Diambil,Dalam Pengiriman,Terkirim,Gagal',
            'tanggal_pengiriman' => 'required|date',
        ]);

        $paket = Paket::create($validated);

        return redirect()->route('paket.index')->with('success', 'Data paket berhasil ditambahkan.');
    }

    // Menampilkan paket yang dapat diakses oleh admin dan kurir
    public function edit(Paket $paket)
    {
        $user = auth()->user();

        // Admin memiliki akses penuh
        if ($user->isAdmin()) {
            $pelanggans = Pelanggan::all();
            $kurirs = Kurir::all();
            return view('paket.edit', compact('paket', 'pelanggans', 'kurirs'));
        }

        // Kurir hanya bisa mengakses paket yang ditugaskan kepada mereka
        if ($user->isKurir() && $paket->id_kurir === $user->kurir->id_kurir) {
            $pelanggans = Pelanggan::all();
            $kurirs = Kurir::all();
            return view('paket.edit', compact('paket', 'pelanggans', 'kurirs'));
        }

        // Akses ditolak jika bukan admin atau kurir yang menangani paket
        abort(403, 'Access denied.');
    }

    // Mengupdate status paket
    public function update(Request $request, Paket $paket)
    {
        $user = auth()->user();

        // Validasi status paket
        $validated = $request->validate([
            'status' => 'required|in:Pending,Diambil,Dalam Pengiriman,Terkirim,Gagal',
        ]);

        // Admin dapat mengupdate status apa pun
        if ($user->isAdmin()) {
            $paket->update($validated);

            // Tambahkan status baru ke riwayat pengiriman
            $paket->statusPengiriman()->create([
                'status' => $validated['status'],
                'waktu_status' => now(),
                'catatan' => $paket->generateStatusNote(),
            ]);

            return redirect()->route('paket.index')->with('success', 'Data paket berhasil diperbarui.');
        }

        // Kurir hanya bisa mengupdate paket yang mereka tangani
        if ($user->isKurir() && $paket->id_kurir === $user->kurir->id_kurir) {
            // Update status paket yang ditangani oleh kurir
            $paket->update(['status' => $validated['status']]);

            // Tambahkan status baru ke riwayat pengiriman
            $paket->statusPengiriman()->create([
                'status' => $validated['status'],
                'waktu_status' => now(),
                'catatan' => $paket->generateStatusNote(),
            ]);

            return redirect()->route('paket.kurir')->with('success', 'Status paket berhasil diperbarui.');
        }

        // Akses ditolak jika bukan admin atau kurir yang menangani paket
        abort(403, 'Access denied.');
    }

    public function destroy(Paket $paket)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Access denied.');
        }

        $paket->delete();
        return redirect()->route('paket.index')->with('success', 'Data paket berhasil dihapus.');
    }
}
