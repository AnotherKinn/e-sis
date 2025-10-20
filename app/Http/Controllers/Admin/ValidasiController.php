<?php

namespace App\Http\Controllers\Admin;

use App\Events\IzinValidatedEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Izin;

class ValidasiController extends Controller
{
    // Halaman index validasi (list izin menunggu validasi)
    public function index()
    {
        $izinList = Izin::with(['user', 'walikelas.kelas'])
            ->where('status_izin', 'menunggu_validasi')
            ->latest()
            ->get();

        return view('admin.validasi.index', compact('izinList'));
    }

    // Halaman detail validasi
    public function show($id)
    {
        $izin = Izin::with(['user', 'walikelas.kelas'])->findOrFail($id);
        return view('admin.validasi.show', compact('izin'));
    }

    // Proses validasi izin
    public function proses(Request $request, $id)
    {
        $request->validate([
            'aksi' => 'required|in:kembali_sekolah,pulang_rumah,izin_lebih_dari_sehari',
            'tanggal_kembali' => 'nullable|date',
            'jam_kembali'     => 'nullable|date_format:H:i',
        ]);

        $izin = Izin::findOrFail($id);


        $izin->update([
            'tanggal_kembali' => $request->tanggal_kembali,
            'jam_kembali'     => $request->jam_kembali,
            'status_izin'     => 'disetujui',
            'hasil_validasi' => $request->aksi
        ]);

        event(new IzinValidatedEvent($izin));
        notify()->success('Izin siswa berhasil divalidasi dan diselesaikan.', 'Berhasil');

        return redirect()->route('admin.validasi.index')
            ->with('success', 'Izin siswa berhasil divalidasi dan diselesaikan.');
    }
}
