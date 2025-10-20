<?php

namespace App\Events;

use App\Models\Izin;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BuktiUploadedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $izin;

    /**
     * Create a new event instance.
     */
    public function __construct(Izin $izin)
    {
        // bisa include relasi siswa biar lebih gampang di frontend
        $this->izin = $izin->load('siswa');
    }

    /**
     * Channel untuk broadcast
     */
    public function broadcastOn()
    {
        // petugas/admin dengerin di channel ini
        return new Channel('izin-channel');
    }

    /**
     * Nama event di frontend
     */
    public function broadcastAs()
    {
        return 'izin.bukti_uploaded';
    }
}
