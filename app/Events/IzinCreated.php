<?php

// app/Events/IzinCreated.php
namespace App\Events;

use App\Models\Izin;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Support\Facades\Log;

// app/Events/IzinCreated.php
class IzinCreated implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public $izin;

    public function __construct(Izin $izin)
    {
        $this->izin = [
            'id'          => $izin->id,
            'user_id'     => $izin->user_id,
            'jenis_izin'  => $izin->jenis_izin,
            'keterangan'  => $izin->keterangan,
            'tanggal'     => $izin->tanggal,
            'status_izin' => $izin->status_izin,
            'notifikasi'  => [
                'judul' => 'Izin Baru',
                'pesan' => $izin->user->nama . ' mengajukan izin',
            ]
        ];

        Log::info('Broadcasting IzinCreated', $this->izin);
    }


    public function broadcastOn()
    {
        return [
            new Channel('izin-channel'),
            new PrivateChannel('siswa-izin.' . $this->izin['user_id']),
        ];
    }

    public function broadcastAs()
    {
        return 'izin.created';
    }
}
