<?php

namespace App\Events;

use App\Models\Izin;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class IzinValidatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $izin;

    public function __construct(Izin $izin)
    {
        $this->izin = $izin;
    }

    public function broadcastOn()
    {
        // khusus siswa yang mengajukan izin ini
        return new PrivateChannel('siswa-izin.' . $this->izin->user_id);
    }

    public function broadcastAs()
    {
        return 'izin.validated';
    }
}
