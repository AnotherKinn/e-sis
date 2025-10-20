<x-app-layout>
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-lg mx-auto mt-10">
        <h1 class="text-xl font-bold mb-4 text-center">Tambah Kelas</h1>

        <form action="{{ route('admin.kelas.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block font-medium">Nama Kelas</label>
                <input type="text" name="nama_kelas" class="w-full border rounded p-2" required>
            </div>

            <div class="flex justify-between w-full gap-4 text-center">
                <a href="{{ route('admin.data-kelas') }}" class="w-full px-4 py-2 bg-gray-600 text-white rounded">Kembali</a>
                <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>

    {{-- <div x-show="isOpenTambah" x-cloak
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-600 bg-opacity-75  flex items-center justify-center z-50 transition-opacity duration-300">

        <div @click.away="isOpenTambah = false" class="bg-white rounded-lg shadow-xl w-full max-w-sm p-6 transform transition-all duration-300">

            <form action="{{ route('admin.kelas.store') }}" method="POST">
                @csrf
                <div class="flex justify-end items-start pb-3 ">
                    <button type="button" @click="isOpenTambah = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <h3 class="text-lg text-center text-black font-semibold">Tambah Kelas</h3>

                <div class="mb-4 mt-4">
                    <label class="block font-medium">Nama Kelas</label>
                    <input type="text" name="nama_kelas" class="w-full border rounded p-2" required>
                </div>

                <div class="flex justify-center gap-4 w-full">
                    <button type="button" @click="isOpenTambah = false" class="w-full px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Batal</button>
                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div> --}}
