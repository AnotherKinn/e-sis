{{-- resources/views/admin/petugas/index.blade.php --}}
<x-app-layout>
    {{-- Desktop --}}
    <div class="hidden md:block">
        <div class="p-6">
            <div>
                <h1 class="text-xl font-bold mb-4 text-[#224779]">Daftar Petugas</h1>
                <hr class="border-1 border-[#224779]">
            </div>

            <div class="flex justify-end mt-4">
                <a href="{{ route('admin.form-tambah-petugas') }}"
                   class="inline-flex gap-1 items-center px-4 py-2 bg-[#017BFA] hover:bg-blue-700 text-white rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="lucide lucide-circle-plus">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M8 12h8"/>
                        <path d="M12 8v8"/>
                    </svg>
                    Tambah
                </a>
            </div>

            <table class="w-full mt-4 border text-black bg-white shadow-lg">
                <thead class="bg-[#017BFA] text-white">
                    <tr>
                        <th class="p-2 border">No</th>
                        <th class="p-2 border">Nama</th>
                        <th class="p-2 border">NIP/NIS</th>
                        <th class="p-2 border">Status</th>
                        <th class="p-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse($petugas as $index => $p)
                    <tr>
                        <td class="p-2 border">{{ $index+1 }}</td>
                        <td class="p-2 border">{{ $p->nama ?? '-' }}</td>
                        <td class="p-2 border">{{ $p->nip ?? '-' }}</td>
                        <td class="p-2 border">
                            @if($p->status === 'aktif')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                    Aktif
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                    Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="p-2 border space-x-2">
                            <a href="{{ route('admin.form-edit-petugas', $p->id) }}"
                               class="inline-flex items-center p-2 text-yellow-500 hover:text-yellow-600">
                                <i data-lucide="square-pen" class="w-5 h-5"></i>
                            </a>
                            <form action="{{ route('admin.petugas.destroy', $p->id) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Yakin ingin menghapus petugas ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="inline-flex items-center p-2 text-red-600 hover:text-red-700">
                                    <i data-lucide="trash" class="w-5 h-5"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-4 text-gray-500">Belum ada data petugas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Mobile (card layout) --}}
    <div class="md:hidden">
        <div class="p-6">
            <h1 class="text-xl font-bold mb-4 text-[#224779] text-center">Daftar Petugas</h1>
            <hr class="border-1 border-[#224779]">
        </div>

        <div class="flex justify-center mb-4">
            <a href="{{ route('admin.form-tambah-petugas') }}"
               class="inline-flex gap-1 items-center px-4 py-2 bg-[#017BFA] hover:bg-blue-700 text-white rounded">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="lucide lucide-circle-plus">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M8 12h8"/>
                    <path d="M12 8v8"/>
                </svg>
                Tambah
            </a>
        </div>

        <div class="grid grid-cols-1 gap-6 p-6">
            @forelse($petugas as $p)
            <div class="bg-white p-6 rounded-lg shadow-md flex flex-col items-start
                        transition duration-300 hover:shadow-xl relative">

                {{-- Nama --}}
                <h3 class="text-lg font-bold text-[#224779] truncate mb-2" title="{{ $p->nama }}">
                    {{ $p->nama ?? '-' }}
                </h3>

                {{-- NIP/NIS --}}
                <p class="text-md text-gray-800">
                    <span class="font-medium">NIP/NIS:</span> {{ $p->nip ?? '-' }}
                </p>

                {{-- Status --}}
                <p class="text-md text-gray-800 mt-2">Status:
                    @if($p->status === 'aktif')
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                            Aktif
                        </span>
                    @else
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                            Nonaktif
                        </span>
                    @endif
                </p>

                {{-- Aksi --}}
                <div class="flex gap-2 mt-4">
                    <a href="{{ route('admin.form-edit-petugas', $p->id) }}"
                       class="inline-flex items-center p-2 text-yellow-500 hover:text-yellow-600 bg-white rounded-full border border-gray-200 shadow">
                        <i data-lucide="square-pen" class="w-5 h-5"></i>
                    </a>
                    <form action="{{ route('admin.petugas.destroy', $p->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus petugas ini?')">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center p-2 text-red-600 hover:text-red-700 bg-white rounded-full border border-gray-200 shadow">
                            <i data-lucide="trash" class="w-5 h-5"></i>
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <p class="text-gray-500 text-center">Belum ada data petugas.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
