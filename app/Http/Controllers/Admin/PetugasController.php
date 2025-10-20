<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::with('user')->paginate(10);

        return view('admin.petugas.index', compact('petugas'));
    }



    public function create()
    {
        return view('admin.petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'nip'      => 'required|string|unique:petugas,nip|min:18|max:18',
            'password' => 'required|string|min:8', // tambahin validasi password
            'status'   => 'required|in:aktif,nonaktif',
        ]);

        Petugas::create([
            'nama'     => $request->nama,
            'nip'      => $request->nip,
            'password' => Hash::make($request->password), // hashing di sini
            'status'   => $request->status,
        ]);

        notify()->success('Data petugas berhasil ditambahkan', 'Berhasil');
        return redirect()->route('admin.data-petugas')->with('success', 'Data petugas berhasil ditambahkan');
    }


    // public function edit(User $user)
    // {
    //     $petugas = Petugas::where('user_id', $user->id)->firstOrFail();

    //     $user = User::where('role', 'petugas')->get();

    //     return view('admin.petugas.edit', compact('petugas', 'user'));
    // }

    public function edit(Petugas $petugas)
    {
        return view('admin.petugas.edit', compact('petugas'));
    }


    //     public function update(Request $request, User $user)
    // {
    //     $petugas = Petugas::where('user_id', $user->id)->firstOrFail();

    //     $request->validate([
    //         'nama'   => 'required|string|max:255',
    //         'nip'    => 'required|string|min:18|max:18|unique:petugas,nip,' . $petugas->id,
    //         'status' => 'required|in:aktif,nonaktif',
    //     ]);

    //     // update data user
    //     $user->update([
    //         'nama' => $request->nama,
    //         'nis'  => $request->nip,
    //     ]);

    //     // update data petugas
    //     $petugas->update([
    //         'nip'    => $request->nip,
    //         'status' => $request->status,
    //     ]);

    //     notify()->success('Data petugas berhasil diperbarui', 'Berhasil');
    //     return redirect()->route('admin.data-petugas')->with('success', 'Data petugas berhasil diperbarui');
    // }


    public function update(Request $request, Petugas $petugas)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'nip'      => 'required|string|min:18|max:18|unique:petugas,nip,' . $petugas->id,
            'status'   => 'required|in:aktif,nonaktif',
            'password' => 'nullable|string|min:8',
        ]);

        $data = $request->only(['nama', 'nip', 'status']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $petugas->update($data);

        notify()->success('Data petugas berhasil diperbarui', 'Berhasil');
        return redirect()->route('admin.data-petugas');
    }




    //   public function destroy(User $user)
    // {
    //     $petugas = Petugas::where('user_id', $user->id)->firstOrFail();
    //     $petugas->delete();

    //     notify()->success('Data petugas berhasil dihapus', 'Berhasil');
    //     return redirect()->route('admin.data-petugas')->with('success', 'Data petugas berhasil dihapus');
    // }

    public function destroy(Petugas $petugas)
    {
        $petugas->delete();

        notify()->success('Data petugas berhasil dihapus', 'Berhasil');
        return redirect()->route('admin.data-petugas');
    }
}
