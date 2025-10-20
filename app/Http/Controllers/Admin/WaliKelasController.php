<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WaliKelas;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WaliKelasController extends Controller
{
    public function index()
    {
        $walikelas = WaliKelas::with('kelas')->get();
        return view('admin.walikelas.index', compact('walikelas'));
    }

    public function search(Request $request)
    {
        $keyword = $request->get('q');

        $walikelas = WaliKelas::with('kelas')
            ->where('nama_walikelas', 'LIKE', "%{$keyword}%")
            ->get()
            ->map(function ($w) {
                return [
                    'id'            => $w->id,
                    'nama_walikelas' => $w->nama_walikelas,
                    'nomor_hp'      => $w->nomor_hp,
                    'kelas'         => $w->kelas->nama_kelas ?? null,
                    'status'        => ucfirst($w->status),
                    'foto'          => $w->foto,
                ];
            });

        return response()->json($walikelas);
    }


    public function create()
    {
        $kelas = Kelas::all();
        return view('admin.walikelas.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_walikelas' => 'required|string|max:255',
            'nomor_hp' => [
                'required',
                'regex:/^62[0-9]{9,13}$/', // format Indonesia dengan kode negara
            ],
            'kelas_id' => 'required|exists:kelas,id',
            'status' => 'required|in:aktif,nonaktif',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // validasi foto
        ], [
            'nomor_hp.required' => 'Nomor HP wajib diisi',
            'nomor_hp.regex' => 'Nomor HP harus menggunakan format global. Contoh: 6281234567890',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar hanya boleh jpg, jpeg, atau png',
            'foto.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // jika ada foto yang diupload
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('walikelas', 'public');
        }

        WaliKelas::create($validated);

        notify()->success('Success', 'Data walikelas berhasil ditambahkan');

        return redirect()->route('admin.data-walikelas')
            ->with('success', 'Data wali kelas berhasil ditambahkan');
    }

    public function edit(WaliKelas $walikelas)
    {
        $kelas = Kelas::all();
        return view('admin.walikelas.edit', compact('walikelas', 'kelas'));
    }

    public function update(Request $request, WaliKelas $walikelas)
    {
        $validated = $request->validate([
            'nama_walikelas' => 'required|string|max:255',
            'nomor_hp' => [
                'required',
                'regex:/^62[0-9]{9,13}$/',
            ],
            'kelas_id' => 'required|exists:kelas,id',
            'status' => 'required|in:aktif,nonaktif',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nomor_hp.required' => 'Nomor HP wajib diisi',
            'nomor_hp.regex' => 'Nomor HP harus menggunakan format global. Contoh: 6281234567890',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar hanya boleh jpg, jpeg, atau png',
            'foto.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // kalau ada foto baru, hapus foto lama lalu simpan yang baru
        if ($request->hasFile('foto')) {
            // hapus foto lama jika ada
            if ($walikelas->foto && Storage::disk('public')->exists($walikelas->foto)) {
                Storage::disk('public')->delete($walikelas->foto);
            }

            $validated['foto'] = $request->file('foto')->store('walikelas', 'public');
        }

        $walikelas->update($validated);

        notify()->success('Success', 'Data walikelas berhasil diperbarui');

        return redirect()->route('admin.data-walikelas')
            ->with('success', 'Data wali kelas berhasil diperbarui');
    }

    public function destroy(WaliKelas $walikelas)
    {
        $walikelas->delete();

        notify()->success('Data walikelas berhasil dihapus', 'Berhasil');
        return redirect()->route('admin.data-walikelas')->with('success', 'Data wali kelas berhasil dihapus');
    }
}
