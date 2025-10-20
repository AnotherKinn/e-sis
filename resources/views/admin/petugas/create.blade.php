{{-- resources/views/admin/petugas/create.blade.php --}}
<x-app-layout>
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-lg mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-4 text-center text-[#224779]">Tambah Data Petugas</h1>

        <form action="{{ route('admin.petugas.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Nama Petugas --}}
            <div>
                <label for="nama" class="block font-medium">Nama Petugas</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                       class="w-full border p-2 rounded focus:ring-2 focus:ring-[#017BFA] focus:outline-none">
                @error('nama')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- NIP --}}
            <div>
                <label for="nip" class="block font-medium">NIP</label>
                <input type="text" name="nip" id="nip" value="{{ old('nip') }}"
                       class="w-full border p-2 rounded focus:ring-2 focus:ring-[#017BFA] focus:outline-none">
                @error('nip')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block font-medium">Password</label>
                <input type="password" name="password" id="password" placeholder="Minimal 8 karakter"
                       class="w-full border p-2 rounded focus:ring-2 focus:ring-[#017BFA] focus:outline-none"
                       autocomplete="new-password">
                @error('password')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- Status --}}
            <div>
                <label for="status" class="block font-medium">Status</label>
                <select name="status" id="status"
                        class="w-full border p-2 rounded focus:ring-2 focus:ring-[#017BFA] focus:outline-none">
                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('status')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-between gap-4 text-center">
                <a href="{{ route('admin.data-petugas') }}"
                   class="w-full px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
                   Batal
                </a>
                <button type="submit"
                        class="w-full bg-[#017BFA] hover:bg-blue-700 text-white px-4 py-2 rounded transition">
                        Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
