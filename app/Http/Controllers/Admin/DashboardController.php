<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Izin;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung ringkasan
        $totalSiswa     = User::where('role', 'siswa')->count();
        $totalIzin      = Izin::count();
        $izinDisetujui  = Izin::where('status_izin', 'disetujui')->count();
        $izinDitolak    = Izin::where('status_izin', 'ditolak')->count();
        $izinTerbaru = Izin::with('user')
            ->where('status_izin', 'menunggu_validasi')
            ->latest()
            ->take(5)
            ->get();


        $notifikasi = \App\Models\Notifikasi::where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();

        $jumlahNotifikasi = \App\Models\Notifikasi::where('user_id', Auth::id())
            ->where('is_read', false)
            ->count();


        // Statistik izin per kelas (total dan disetujui)
        // $izinPerKelas = Kelas::withCount([
        //     'users as total_izin' => function ($q) {
        //         $q->join('izin', 'izin.user_id', '=', 'users.id');
        //     },
        //     'users as disetujui' => function ($q) {
        //         $q->join('izin', 'izin.user_id', '=', 'users.id')
        //           ->where('izin.status_izin', 'disetujui');
        //     }
        // ])->get(['id', 'nama_kelas']);

        $izinPerKelas = Kelas::select('kelas.id', 'kelas.nama_kelas')
            ->selectRaw('COUNT(izin.id) as total_izin')
            ->selectRaw('SUM(CASE WHEN izin.status_izin = "disetujui" THEN 1 ELSE 0 END) as disetujui')
            ->leftJoin('users', 'users.kelas_id', '=', 'kelas.id')
            ->leftJoin('izin', 'izin.user_id', '=', 'users.id')
            ->groupBy('kelas.id', 'kelas.nama_kelas')
            ->get();



        // Data untuk calendar (izin berdasarkan tanggal)
        $events = Izin::with('user')
            ->get()
            ->map(function ($izin) {
                return [
                    'title' => $izin->jenis_izin . ' - ' . $izin->user->nama,
                    'start' => $izin->tanggal,
                ];
            });

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalIzin',
            'izinDisetujui',
            'izinDitolak',
            'izinPerKelas',
            'izinTerbaru',
            'events',
            'notifikasi',
            'jumlahNotifikasi'
        ));
    }
}
