<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Petugas extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'petugas';

    protected $fillable = [
        'nama',
        'nip',
        'password',
        'status'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
