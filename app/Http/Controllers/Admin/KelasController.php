<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('admin.kelas.index', compact('kelas'));
    }

    public function search(Request $request)
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


    public function create()
    {
        return view('admin.kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
        ]);

        Kelas::create($request->all());

        notify()->success('Data kelas berhasil ditambahkan', 'Berhasil');

        return redirect()->route('admin.data-kelas');
    }

    public function edit(Kelas $kelas)
    {
        return view('admin.kelas.edit', compact('kelas'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
        ]);

        $kelas->update($request->all());

        notify()->success('Data kelas berhasil diperbarui', 'Berhasil');

        return redirect()->route('admin.data-kelas')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();

        notify()->success('Data kelas berhasil dihapus', 'Berhasil');
        return redirect()->route('admin.data-kelas')->with('success', 'Kelas berhasil dihapus.');
    }
}
