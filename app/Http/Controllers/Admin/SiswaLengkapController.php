<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiswaLengkap;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class SiswaLengkapController extends Controller
{
    public function index()
    {
        $siswaLengkap = User::with('siswaLengkap.kelas', 'siswaLengkap.jurusan')
            ->where('role', 'siswa')
            ->get();


        return view('admin.siswa.index', compact('siswaLengkap'));
    }

    public function search(Request $request)
    {
        $keyword = $request->get('q');

        $siswaLengkap = User::with('siswaLengkap.kelas', 'siswaLengkap.jurusan')
            ->where('role', 'siswa')
            ->where('nama', 'LIKE', "%{$keyword}%")
            ->get()
            ->map(function ($siswa) {
                return [
                    'id'            => $siswa->id,
                    'nama'          => $siswa->nama,
                    'kelas'         => $siswa->siswaLengkap->kelas->nama_kelas ?? null,
                    'jurusan'       => $siswa->siswaLengkap->jurusan->nama_jurusan ?? null,
                    'tempat_lahir'  => $siswa->siswaLengkap->tempat_lahir ?? null,
                    'tanggal_lahir' => $siswa->siswaLengkap->tanggal_lahir ?? null,
                    'jenis_kelamin' => $siswa->siswaLengkap->jenis_kelamin ?? null,
                    'nomor_hp'      => $siswa->siswaLengkap->nomor_hp ?? null,
                ];
            });

        return response()->json($siswaLengkap);
    }



    public function create()
    {
        $users = User::where('role', 'siswa')->get(); // hanya siswa
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();

        return view('admin.siswa.create', compact('users', 'kelas', 'jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kelas_id' => 'nullable|exists:kelas,id',
            'jurusan_id' => 'nullable|exists:jurusan,id',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'nomor_hp' => 'nullable|string|max:15',
        ]);


        SiswaLengkap::create($request->all());

        notify()->success('Data siswa berhasil ditambahkan');

        return redirect()->route('admin.data-siswa')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(SiswaLengkap $siswa)
    {
        $users = User::where('role', 'siswa')->get();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();

        return view('admin.siswa.edit', compact('siswa', 'users', 'kelas', 'jurusan'));
    }

    public function update(Request $request, SiswaLengkap $siswa)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kelas_id' => 'nullable|exists:kelas,id',
            'jurusan_id' => 'nullable|exists:jurusan,id',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'nomor_hp' => 'nullable|string|max:15',
        ]);


        $siswa->update($request->all());

        return redirect()->route('admin.data-siswa')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        // kalau ada biodata, hapus dulu
        if ($user->siswaLengkap) {
            $user->siswaLengkap->delete();
        }

        // hapus akun
        $user->delete();

        notify()->success('Akun dan biodata siswa berhasil dihapus', 'Berhasil');

        return redirect()->route('admin.data-siswa')
            ->with('success', 'Akun dan biodata siswa berhasil dihapus.');
    }
}
