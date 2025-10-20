<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\Petugas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => ['required', 'string'], // bisa nis atau nip
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $username = $this->input('username');
        $password = $this->input('password');

        Log::info("Login attempt", ['username' => $username]);

        // cek tabel users (admin/siswa)
        $user = User::where('nis', $username)->first();
        if ($user) {
            Log::info("User ditemukan di tabel users", ['id' => $user->id]);
            if (Hash::check($password, $user->password)) {
                Log::info("Password cocok untuk user (web)");
                Auth::guard('web')->login($user, $this->boolean('remember'));
                RateLimiter::clear($this->throttleKey());

                // redirect sesuai role
                if ($user->role === 'admin') {
                    session(['redirect_after_login' => route('admin.dashboard')]);
                } else {
                    session(['redirect_after_login' => route('siswa.dashboard')]);
                }
                return;
            }
            Log::warning("Password salah untuk user (web)");
        }

        // cek tabel petugas
        $petugas = Petugas::where('nip', $username)->first();
        if ($petugas) {
            Log::info("Petugas ditemukan", ['id' => $petugas->id]);
            if (Hash::check($password, $petugas->password)) {
                Log::info("Password cocok untuk petugas");
                Auth::guard('petugas')->login($petugas, $this->boolean('remember'));
                RateLimiter::clear($this->throttleKey());

                // redirect petugas ke dashboard admin
                session(['redirect_after_login' => route('admin.dashboard')]);
                return;
            }
            Log::warning("Password salah untuk petugas");
        }

        Log::error("Login gagal, tidak ditemukan di users maupun petugas");

        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
            'username' => trans('auth.failed'),
        ]);
    }

    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'username' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::lower($this->input('username')) . '|' . $this->ip();
    }
}
