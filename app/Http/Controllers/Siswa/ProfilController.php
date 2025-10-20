<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\User;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class ProfilController extends Controller
{
    public function profil()
    {
        $user = auth()->user();
        $siswa = $user->siswaLengkap;
        return view('siswa.profil.index', compact('user', 'siswa'));
    }

    public function dataDiri()
    {
        $user = auth()->user();
        $siswa = $user->siswaLengkap; // relasi hasOne dari User

        return view('siswa.profil.data-diri.index', compact('user', 'siswa'));
    }

    public function editDataDiri()
    {
        $user = auth()->user();
        // kalau belum ada, kasih instance kosong (supaya di blade tidak error)
        $siswa = $user->siswaLengkap ?? new \App\Models\SiswaLengkap();

        $kelas = Kelas::all();
        $jurusan = Jurusan::all();

        return view('siswa.profil.data-diri.edit', compact('siswa', 'kelas', 'jurusan', 'user'));
    }


    public function updateDataDiri(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'tempat_lahir'   => 'required|string|max:255',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required|in:Laki-laki,Perempuan',
            'nomor_hp'       => 'nullable|string|max:20',
            'kelas_id'       => 'required|exists:kelas,id',
            'jurusan_id'     => 'required|exists:jurusan,id',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // validasi foto
        ]);

        if ($request->hasFile('foto')) {
            // bikin folder sesuai NIS atau nama
            $folder = 'profil-siswa/' . str_replace(' ', '_', strtolower($user->nama));

            // simpan file dengan nama unik
            $filename = time() . '_' . $request->file('foto')->getClientOriginalName();
            $path = $request->file('foto')->storeAs($folder, $filename, 'public');

            // hapus foto lama
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            // update foto baru
            $user->update([
                'foto' => $path
            ]);
        }


        // Simpan data siswa_lengkap
        if ($user->siswaLengkap) {
            $user->siswaLengkap->update($validated);
        } else {
            $user->siswaLengkap()->create($validated);
        }

        notify()->success('Data diri berhasil disimpan', 'Berhasil');

        return redirect()->route('siswa.profil.data-diri')
            ->with('success', 'Data diri berhasil disimpan.');
    }




    public function pengaturan()
    {
        return view('siswa.profil.pengaturan.index');
    }

    public function walikelas()
    {
        $user = auth()->user();

        // misal ambil walikelas berdasarkan kelas siswa
        $siswa = $user->siswaLengkap;

        $walikelas = null;
        if ($siswa && $siswa->kelas_id) {
            $walikelas = \App\Models\Walikelas::where('kelas_id', $siswa->kelas_id)->first();
        }

        return view('siswa.profil.walikelas.index', compact('walikelas', 'user'));
    }


    public function editPassword()
    {
        $user = auth()->user();
        $siswa = auth()->user()->siswaLengkap;
        return view('siswa.profil.pengaturan.password.edit', compact('user', 'siswa'));
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama tidak sesuai']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('siswa.profil.pengaturan')->with('success', 'Password berhasil diperbarui');
    }

    public function notifikasi()
    {
        $user = auth()->user();
        $siswa = auth()->user()->siswaLengkap;

        return view('siswa.profil.notifikasi.index', compact('user', 'siswa'));
    }

    public function destroy()
    {
        $siswa = auth()->user()->siswaLengkap;
        $siswa->delete();

        return redirect()->route('siswa.dashboard');
    }
}
