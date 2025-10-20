<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;
use App\Models\Petugas;

Broadcast::channel('siswa-izin.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});

// Channel public untuk petugas & admin
Broadcast::channel('izin-channel', function ($user) {
    // Handle jika guard web (users)
    if ($user instanceof User && in_array($user->role, ['admin', 'petugas'])) {
        return true;
    }

    // Handle jika guard petugas (tabel petugas)
    if ($user instanceof Petugas) {
        return true;
    }

    return false;
});
