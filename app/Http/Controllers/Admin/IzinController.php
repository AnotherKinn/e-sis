<?php

namespace App\Http\Controllers\Admin;

use App\Events\IzinScannedEvent;
use App\Http\Controllers\Controller;
use App\Models\Izin;
use App\Models\Jurusan;
use App\Models\Petugas;
use App\Models\Kelas;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Exports\IzinExport;
use Maatwebsite\Excel\Facades\Excel;

class IzinController extends Controller
{
    public function index(Request $request)
    {
        $query = Izin::with(['user', 'user.siswaLengkap.kelas', 'user.siswaLengkap.jurusan']);

        // Filter jurusan
        if ($request->filled('jurusan_id')) {
            $query->whereHas('user.siswaLengkap', function ($q) use ($request) {
                $q->where('jurusan_id', $request->jurusan_id);
            });
        }

        // Filter kelas
        if ($request->filled('kelas_id')) {
            $query->whereHas('user.siswaLengkap', function ($q) use ($request) {
                $q->where('kelas_id', $request->kelas_id);
            });
        }

        // Filter status izin
        if ($request->filled('status_izin')) {
            $query->where('status_izin', $request->status_izin);
        }

        $izin = $query->latest()->paginate(10);

        $jurusan = Jurusan::all();
        $kelas   = Kelas::all();

        return view('admin.izin.index', compact('izin', 'jurusan', 'kelas'));
    }

    public function search(Request $request)
    {
        $keyword = $request->get('q');

        $izin = Izin::with(['user', 'user.siswaLengkap.kelas', 'user.siswaLengkap.jurusan'])
            ->whereHas('user', function ($q) use ($keyword) {
                $q->where('nama', 'LIKE', "%{$keyword}%");
            })
            ->get()
            ->map(function ($i) {
                return [
                    'id'            => $i->id,
                    'nama'          => $i->user->nama,
                    'jurusan'       => $i->user->siswaLengkap->jurusan->nama_jurusan ?? null,
                    'kelas'         => $i->user->siswaLengkap->kelas->nama_kelas ?? null,
                    'jenis_izin'    => ucfirst($i->jenis_izin),
                    'keterangan_izin' => $i->hasil_validasi === 'kembali_sekolah'
                        ? 'Siswa kembali lagi ke sekolah'
                        : ($i->hasil_validasi === 'pulang_rumah'
                            ? 'Siswa kembali ke rumah'
                            : ($i->hasil_validasi === 'izin_lebih_dari_sehari'
                                ? 'Siswa izin lebih dari sehari'
                                : '-')),
                    'tanggal'       => $i->tanggal,
                    'status_izin'   => ucfirst($i->status_izin),
                ];
            });

        return response()->json($izin);
    }


    public function exportExcel(Request $request)
    {
        $filters = $request->only(['jurusan_id', 'kelas_id', 'status_izin']);
        return Excel::download(new IzinExport($filters), 'laporan_izin.xlsx');
    }

    public function cetak($id, Request $request, $token)
    {
        $izin = Izin::with(['user', 'walikelas.kelas'])->findOrFail($id);

        // validasi token
        if ($izin->token !== $token) {
            abort(403, 'Token tidak valid!');
        }

        $walikelas = $izin->walikelas;

        // Ambil guard yang sedang aktif
        if (auth('petugas')->check()) {
            $petugas = auth('petugas')->user(); // langsung ambil data petugas yang login
        } else {
            abort(403, 'Anda bukan petugas.');
        }


        // update status otomatis jadi disetujui
        if ($izin->status_izin !== 'disetujui') {
            $izin->status_izin = 'menunggu_bukti';
            $izin->id_pemberi_izin = $petugas ? $petugas->id : null; // simpan id_petugas
            $izin->save();

            event(new IzinScannedEvent($izin));
        }

        // render blade ke PDF
        $pdf = Pdf::loadView('admin.izin.cetak', compact('izin', 'walikelas', 'petugas'));
        return $pdf->stream('izin_' . $izin->id . '.pdf');
    }
}
