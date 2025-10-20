<x-app-layout>
    {{-- desktop --}}
    <div class="hidden md:block">

            <div class="py-6">
                <h1 class="text-xl font-bold mb-4 text-[#224779]">Daftar Jurusan</h1>
                <hr class="border-1 border-[#224779]">
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif


            <div class="flex justify-end mb-4">
                <a href="{{ route('admin.form-tambah-jurusan') }}"
                class="inline-flex gap-1 items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus-icon lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/>
                </svg>
            Tambah</a>
            </div>

            <table class="w-full border border-gray-300 bg-white shadow-lg text-black ">
                <thead class="bg-[#017BFA] text-black">
                    <tr>
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Nama Jurusan</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jurusan as $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $item->nama_jurusan }}</td>
                            <td class="border px-4 py-2 space-x-2">
                                <a href="{{ route('admin.form-edit-jurusan', $item->id) }}"
                                class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>

                                <form action="{{ route('admin.jurusan.destroy', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 text-white px-3 py-1 rounded"
                                            onclick="return confirm('Yakin hapus data ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-3">Belum ada data jurusan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
    </div>

    {{-- mobile --}}
    <div class="md:hidden">
        <div class="p-6">
            <h1 class="text-xl font-bold mb-4 text-[#224779] text-center">Daftar Jurusan</h1>
            <hr class="border-1 border-[#224779]">
        </div>

        <div>
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <div class="flex justify-end mb-4 px-6">
            <a href="{{ route('admin.form-tambah-jurusan') }}"
            class="inline-flex gap-1 items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus-icon lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/>
                </svg>
                Tambah</a>
            </a>
        </div>

        {{-- card --}}
        <div class="grid grid-cols-1 gap-6 px-6 mt-6">
                @foreach ($jurusan as $item)
                <div class="relative bg-white p-6 rounded-lg shadow-lg transition duration-300 hover:shadow-xl border-l-4 border-[#017BFA]">
                    <div class="absolute top-3 right-3 flex items-center space-x-2 bg-white rounded-lg p-1">
                        <a href="{{ route('admin.form-edit-jurusan', $item->id) }}"
                            class="px-2 py-1 text-yellow-500 hover:text-yellow-600 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/>
                            </svg>
                        </a>
                        <form action="{{ route('admin.jurusan.destroy', $item->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus kelas ini?')"
                                class="px-2 py-1 text-red-600 hover:text-red-700 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-icon lucide-trash"><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                </svg>
                            </button>
                        </form>
                    </div>

                    <div>
                        <p class="text-sm font-semibold ">Jurusan</p>
                        <p class="text-lg font-bold">{{ $item->nama_jurusan }}</p>
                    </div>

                    {{-- <div class="flex items-center">
                        <a href="{{ route('admin.form-edit-jurusan', $item->id) }}"
                            class="px-2 py-1 text-yellow-500 hover:text-yellow-600 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/>
                            </svg>
                        </a>
                        <form action="{{ route('admin.jurusan.destroy', $item->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus kelas ini?')"
                                class="px-2 py-1 text-red-600 hover:text-red-700 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-icon lucide-trash"><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                </svg>
                            </button>
                        </form>
                    </div> --}}
                </div>
                @endforeach

        </div>
    </div>
</x-app-layout>
