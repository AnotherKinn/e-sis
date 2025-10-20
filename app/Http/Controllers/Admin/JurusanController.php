<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jurusan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusan = Jurusan::all();
        return view('admin.jurusan.index', compact('jurusan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
        ]);

        $jurusan->create([
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        notify()->success('Data jurusan berhasil ditambahkan', 'Berhasil');

        return redirect()->route('admin.data-jurusan')->with('success', 'Jurusan berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurusan $jurusan)
    {
        return view('admin.jurusan.edit', compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
        ]);

        $jurusan->update([
            'nama_jurusan' => $request->nama_jurusan
        ]);

        notify()->success('Data jurusan berhasil diperbarui', 'Berhasil');

        return redirect()->route('admin.data-jurusan')->with('success', 'Jurusan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();

        notify()->success('Data jurusan berhasil dihapus', 'Berhasil');

        return redirect()->route('admin.data-jurusan')->with('success', 'Jurusan berhasil dihapus');
    }
}
