<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = null;
        $guard = null;

        // cek guard web (users: siswa & admin)
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            $guard = 'web';
        }
        // cek guard petugas
        elseif (Auth::guard('petugas')->check()) {
            $user = Auth::guard('petugas')->user();
            $guard = 'petugas';
        }

        if (!$user) {
            return redirect()->route('login');
        }

        // jika login sebagai siswa/admin (dari tabel users)
        if ($guard === 'web') {
            if ($user->role === 'admin') {
                if (!in_array('admin', $roles)) {
                    return redirect()->route('admin.dashboard');
                }
            } elseif ($user->role === 'siswa') {
                if (!in_array('siswa', $roles)) {
                    return redirect()->route('siswa.dashboard');
                }
            }
        }

        // jika login sebagai petugas → anggap setara admin
        if ($guard === 'petugas') {
            if (!in_array('petugas', $roles) && !in_array('admin', $roles)) {
                return redirect()->route('admin.dashboard');
            }
        }

        return $next($request);
    }
}
