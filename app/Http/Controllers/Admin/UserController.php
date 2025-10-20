<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Kelas;
use App\Http\Controllers\Controller;
use App\Imports\UserImport;
use App\Exports\UserFormatExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{

    public function index()
    {
        $kelas = Kelas::all();
        return view('admin.users.index', compact('kelas'));
    }

    public function searchKelas(Request $request)
    {
        $keyword = $request->get('q');

        $kelas = Kelas::where('nama_kelas', 'LIKE', "%{$keyword}%")->get()
            ->map(function ($k) {
                return [
                    'id' => $k->id,
                    'nama_kelas' => $k->nama_kelas,
                ];
            });

        return response()->json($kelas);
    }


    public function byKelas($id)
    {
        $kelas = Kelas::findOrFail($id);
        $users = User::where('kelas_id', $id)->get();

        return view('admin.users.byKelas', compact('users', 'kelas'));
    }

    public function import(Request $request, $kelasId)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        // Import tanpa kelas_id
        Excel::import(new UserImport, $request->file('file'));

        return redirect()->route('admin.data-pengguna.kelas', $kelasId)
            ->with('success', 'Data berhasil diimport!');
    }

    public function importGlobal(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        try {
            Excel::import(new UserImport, $request->file('file'));

            notify()->success('Berhasil', 'Data pengguna berhasil diimport');

            return redirect()->route('admin.data-pengguna');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                // Ambil data row yang gagal
                $rowData = $failure->values();

                $nama = $rowData['nama'] ?? '-';
                $nis  = $rowData['nis'] ?? '-';

                // Buat pesan error lebih detail
                $errorMessage = "Baris {$failure->row()} | Nama: {$nama} | NIS: {$nis} | Error: "
                    .implode(', ', $failure->errors());

                // ✅ Pakai Laravel Notify untuk tampilkan notifikasi error
                notify()->error($errorMessage, 'Gagal Import');
            }

            return redirect()->route('admin.data-pengguna');
        }
    }


    public function downloadFormat()
    {
        notify()->success('Berhasil download format', 'Format import data pengguna berhasil di download');
        return Excel::download(new UserFormatExport, 'format_user.xlsx');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Simpan pengguna baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:users,nis',
            'password' => 'required|string|min:6',
            'role' => 'required|in:siswa,petugas',
        ]);

        User::create([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.data-pengguna')->with('success', 'Pengguna berhasil ditambahkan');
    }

    /**
     * Tampilkan form edit pengguna.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update data pengguna.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:users,nis,' . $user->id,
            'role' => 'required|in:siswa,petugas',
        ]);

        $data = $request->only(['nama', 'nis', 'role']);
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.data-pengguna')->with('success', 'Pengguna berhasil diperbarui');
    }

    /**
     * Hapus pengguna.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.data-pengguna')->with('success', 'Pengguna berhasil dihapus');
    }
}
