<x-app-layout>
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-lg mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4 text-black text-center">Validasi Izin</h1>

        <div class="mb-6 p-4 border rounded bg-gray-50">
            <p class="flex items-center"><strong class="text-md w-28">Nama Siswa:</strong> {{ $izin->user->nama }}</p>
            <p class="flex items-center"><strong class="text-md w-28">NIS:</strong> {{ $izin->user->nis }}</p>
            <p class="flex items-center"><strong class="text-md w-28">Kelas:</strong> {{ $izin->walikelas->kelas->nama_kelas ?? '-' }}</p>
            <p class="flex items-center"><strong class="text-md w-28">Jenis Izin:</strong> {{ ucfirst($izin->jenis_izin) }}</p>
            <p class="flex items-center"><strong class="text-md w-28">Keterangan:</strong> {{ ucfirst($izin->keterangan)}}</p>
            <p class="flex items-center"><strong class="text-md w-28">Tanggal Izin:</strong> {{ $izin->tanggal }}</p>
            <p class="flex items-center"><strong class="text-md w-28">Jam Keluar:</strong> {{ $izin->jam_keluar }}</p>
            @if($izin->status_izin === 'menunggu_validasi')
            <p class="flex items-center"><strong class="text-md w-28">Status:</strong>
                <span class="text-yellow-600 font-semibold">Menunggu validasi</span>
            </p>
            @endif

            {{-- Tombol untuk buka modal bukti izin --}}
            @if($izin->bukti_izin)
            <div class="mt-4" x-data="{ open: false }">
                <div class="flex justify-end">
                    <button @click="open = true" class="px-4 py-2 bg-blue-600 text-white rounded">
                        Lihat Bukti Izin
                    </button>
                </div>

                <!-- Modal -->
                <div x-show="open" x-transition
                    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                    <div class="bg-white p-4 rounded shadow-lg relative w-3/4 max-w-lg">
                        <button @click="open = false" class="absolute top-2 right-2 text-gray-600 hover:text-black">
                            ✕
                        </button>
                        <h2 class="text-xl font-semibold mb-2">Bukti Izin</h2>
                        <img src="{{ asset('storage/' . $izin->bukti_izin) }}" alt="Bukti Izin" class="w-full rounded">
                    </div>
                </div>
            </div>
            @endif
        </div>

        {{-- Form validasi izin dengan opsi --}}
        <form action="{{ route('admin.validasi.proses', $izin->id) }}" method="POST" class="space-y-4"
            x-data="{ aksi: '' }">
            @csrf

            <label class="block font-medium mb-2 text-black">Pilih Aksi Validasi:</label>
            <div class="space-y-2">
                <label class="flex items-center text-black">
                    <input type="radio" name="aksi" value="kembali_sekolah" x-model="aksi" class="mr-2" required>
                    Siswa kembali ke sekolah (selesai hari ini)
                </label>

                <label class="flex items-center text-black">
                    <input type="radio" name="aksi" value="pulang_rumah" x-model="aksi" class="mr-2">
                    Siswa langsung pulang ke rumah
                </label>

                <label class="flex items-center text-black">
                    <input type="radio" name="aksi" value="izin_lebih_dari_sehari" x-model="aksi" class="mr-2">
                    Siswa izin lebih dari 1 hari
                </label>
            </div>

            {{-- Field dinamis --}}
            <div x-show="aksi === 'kembali_sekolah'" x-transition>
                <label class="block font-medium mt-2 text-black">Jam Kembali</label>
                <input type="time" name="jam_kembali" class="border p-2 w-full">
                @error('jam_kembali') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <div x-show="aksi === 'izin_lebih_dari_sehari'" x-transition>
                <label class="block font-medium text-black">Tanggal Siswa Kembali</label>
                <input type="date" name="tanggal_kembali" class="border p-2 w-full">
                @error('tanggal_kembali') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">
                Selesaikan izin
            </button>
        </form>

    </div>
</x-app-layout>
