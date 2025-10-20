<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;

    protected $table = 'izin';

    protected $fillable = [
        'user_id',
        'id_pemberi_izin',
        'id_walikelas',
        'jenis_izin',
        'keterangan',
        'jam_keluar',
        'jam_kembali',
        'tanggal',
        'tanggal_kembali',
        'qr_code',
        'bukti_izin',
        'status_izin',
        'hasil_validasi',
        'token'
        // 'disetujui_oleh',
    ];

    // Relasi ke User (siswa yang mengajukan izin)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke User (pemberi izin / petugas)
    public function pemberiIzin()
    {
        return $this->belongsTo(User::class, 'id_pemberi_izin');
    }

    // Relasi ke User (yang menyetujui)
    public function disetujuiOleh()
    {
        return $this->belongsTo(User::class, 'disetujui_oleh');
    }

    // Relasi ke walikelas
    public function walikelas()
    {
        return $this->belongsTo(WaliKelas::class, 'id_walikelas');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas');
    }

    // Relasi ke User (siswa)
    public function siswa()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
