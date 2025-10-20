<x-app-layout>
    {{-- Versi Desktop --}}
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-lg mx-auto mt-10 hidden md:block">
        <h2 class="text-xl font-bold mb-4 text-center">Edit Petugas</h2>

        <form action="{{ route('admin.petugas.update', $petugas->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div>
                <label class="block font-medium">Nama Petugas</label>
                <input type="text" name="nama" value="{{ old('nama', $petugas->nama) }}"
                    class="w-full border p-2 rounded" required>
                @error('nama')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- NIP --}}
            <div>
                <label class="block font-medium">NIP</label>
                <input type="text" name="nip" value="{{ old('nip', $petugas->nip) }}"
                    class="w-full border p-2 rounded" required>
                @error('nip')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label class="block font-medium">Password (isi kalau mau ganti)</label>
                <input type="password" name="password" class="w-full border p-2 rounded"
                    placeholder="Minimal 8 karakter">
                @error('password')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- Status --}}
            <div>
                <label class="block font-medium">Status</label>
                <select name="status" class="w-full border p-2 rounded" required>
                    <option value="aktif" {{ old('status', $petugas->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status', $petugas->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('status')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex justify-between gap-4 text-center">
                <a href="{{ route('admin.data-petugas')}}" class="w-full px-4 py-2 bg-gray-600 text-white rounded">Kembali</a>
                <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded">Update</button>
            </div>
        </form>
    </div>

    {{-- Versi Mobile --}}
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-lg mx-auto mt-10 md:hidden">
        <h2 class="text-xl font-bold mb-4 text-center">Edit Petugas</h2>

        <form action="{{ route('admin.petugas.update', $petugas->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div>
                <label class="block font-medium">Nama Petugas</label>
                <input type="text" name="nama" value="{{ old('nama', $petugas->nama) }}"
                    class="w-full border p-2 rounded" required>
            </div>

            {{-- NIP --}}
            <div>
                <label class="block font-medium">NIP</label>
                <input type="text" name="nip" value="{{ old('nip', $petugas->nip) }}"
                    class="w-full border p-2 rounded" required>
            </div>

            {{-- Password --}}
            <div>
                <label class="block font-medium">Password (isi kalau mau ganti)</label>
                <input type="password" name="password" class="w-full border p-2 rounded"
                    placeholder="Minimal 8 karakter">
            </div>

            {{-- Status --}}
            <div>
                <label class="block font-medium">Status</label>
                <select name="status" class="w-full border p-2 rounded" required>
                    <option value="aktif" {{ old('status', $petugas->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status', $petugas->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-between gap-4 text-center">
                <a href="{{ route('admin.data-petugas')}}" class="w-full px-4 py-2 bg-gray-600 text-white rounded">Kembali</a>
                <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
