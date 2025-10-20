<x-app-layout>
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-lg mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-4 text-black text-center">Tambah Jurusan</h1>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc pl-6">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.jurusan.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block font-medium">Nama Jurusan</label>
                <input type="text" name="nama_jurusan"
                       class="w-full border rounded p-2"
                       value="{{ old('nama_jurusan') }}" required>
            </div>

            <div class="flex justify-between gap-4 text-center">
                <a href="{{ route('admin.data-jurusan') }}" class="w-full bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
                <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
