<?php

namespace App\Events;

use App\Models\Izin;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class IzinScannedEvent implements ShouldBroadcast
{
    public $izin;

    public function __construct(Izin $izin)
    {
        // kirim relasi user agar frontend mudah akses
        $this->izin = $izin->load('siswa');
    }

    public function broadcastOn()
    {
        // hanya siswa yg bersangkutan yang bisa dengar
        return new PrivateChannel('siswa-izin.' . $this->izin->user_id);
    }

    public function broadcastAs()
    {
        return 'izin.scanned';
    }
}
