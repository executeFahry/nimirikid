<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kurir;
use App\Models\Pelanggan;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,kurir,pelanggan'],
            'no_hp' => $request->role === 'kurir' ? ['required', 'string', 'max:15'] : [],
            'area_pengiriman' => $request->role === 'kurir' ? ['required', 'string', 'max:255'] : [],
            'no_hp_pelanggan' => $request->role === 'pelanggan' ? ['required', 'string', 'max:15'] : [],
            'alamat' => $request->role === 'pelanggan' ? ['required', 'string', 'max:255'] : [],
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Menyimpan data tambahan jika role kurir atau pelanggan
        if ($request->role === 'kurir') {
            Kurir::create([
                'user_id' => $user->id,
                'nama_kurir' => $request->name,
                'no_hp' => $request->no_hp,
                'area_pengiriman' => $request->area_pengiriman,
            ]);
        } elseif ($request->role === 'pelanggan') {
            Pelanggan::create([
                'user_id' => $user->id,
                'nama_pelanggan' => $request->name,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'no_hp' => $request->no_hp_pelanggan,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        // Redirect berdasarkan role
        if ($user->isAdmin()) {
            return redirect()->route('dashboard');
        } elseif ($user->isKurir()) {
            return redirect()->route('dashboard.kurir');
        } else {
            return redirect()->route('dashboard.pelanggan');
        }
    }
}
