<x-app-layout>
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-lg mx-auto mt-10">
        <h2 class="text-xl font-bold mb-4 text-center">Tambah Wali Kelas</h2>

        <form action="{{ route('admin.walikelas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block">Nama Wali Kelas</label>
                <input type="text" name="nama_walikelas" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block">Kelas</label>
                <select name="kelas_id" class="w-full border p-2 rounded" required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelas as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block">No HP</label>
                <input type="text" name="nomor_hp" class="w-full border p-2 rounded" required>
            </div>


            <div>
                <label class="block">Status</label>
                <select name="status" class="w-full border p-2 rounded" required>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </div>

            <div>
                <label class="block">Foto Profil</label>
                <input type="file" name="foto" class="w-full border p-2 rounded" accept="image/*">
            </div>


            <div class="flex justify-between gap-4 text-center">
                <a href="{{ route('admin.data-walikelas')}}" class="w-full px-4 py-2 bg-gray-600 text-white rounded">Kembali</a>
                <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
