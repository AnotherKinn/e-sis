<x-app-layout>
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-lg mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-4 text-center">Tambah Data Siswa</h1>

        <form action="{{ route('admin.siswa.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block">Nama Siswa</label>
                <select name="user_id" class="w-full border p-2 rounded">
                    <option value="">-- Pilih Siswa --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->nama }} ({{ $user->nis }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block">Kelas</label>
                <select name="kelas_id" class="w-full border p-2 rounded">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block">Jurusan</label>
                <select name="jurusan_id" class="w-full border p-2 rounded">
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach($jurusan as $j)
                        <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="w-full border p-2 rounded">
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div>
                <label class="block">Nomor HP</label>
                <input type="text" name="nomor_hp" class="w-full border p-2 rounded">
            </div>

            <div class="flex justify-between gap-4 text-center">
                <a href="{{route('admin.data-siswa')}}" class="w-full px-4 py-2 bg-gray-600 text-white rounded">Batal</a>
                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
