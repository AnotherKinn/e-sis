<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View|RedirectResponse
    {
        // Jika sudah login, langsung arahkan ke dashboard sesuai role
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'siswa') {
                return redirect()->route('siswa.dashboard');
            }
        }

        if (Auth::guard('petugas')->check()) {
            return redirect()->route('admin.dashboard');
        }

        // Jika belum login, tampilkan form login
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // Cek guard WEB (user -> admin/siswa)
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'siswa') {
                return redirect()->route('siswa.dashboard');
            }
        }

        // Cek guard PETUGAS
        if (Auth::guard('petugas')->check()) {
            return redirect()->route('admin.dashboard'); // petugas masuk ke dashboard admin
        }

        return redirect('/login')->withErrors([
            'login' => 'Autentikasi gagal, coba lagi.',
        ]);
    }





    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if (Auth::guard('petugas')->check()) {
            Auth::guard('petugas')->logout();
        }

        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
