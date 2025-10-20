<x-app-layout>
    <div class="hidden md:block">
        <div class="p-6">
            <div>
                <h1 class="text-xl font-bold mb-4 text-[#224779]">Daftar Walikelas</h1>
                <hr class="border-1 border-[#224779]">
            </div>

            <div class="flex flex-row justify-between mt-4">
                {{-- Input Pencarian --}}
                <div>
                    <div class="flex items-center  relative">
                        <input type="text" id="search-walikelas" placeholder="Cari nama wali kelas..."
                            class="w-full pl-10 pr-4 border border-gray-300 rounded px-3 py-2  focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i data-lucide="search" class="absolute left-3 w-5 h-5 mr-2 text-gray-500"></i>
                    </div>
                </div>

                <div>
                    <a href="{{ route('admin.form-tambah-walikelas') }}"
                        class="inline-flex gap-1 items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-circle-plus-icon lucide-circle-plus">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M8 12h8" />
                            <path d="M12 8v8" />
                        </svg>
                        Tambah
                    </a>
                </div>
            </div>

            <table class="w-full mt-4 border text-black bg-white shadow-lg">
                <thead class="text-black bg-[#017BFA]">
                    <tr>
                        <th class="p-2 border">No</th>
                        <th class="p-2 border">Nama Wali Kelas</th>
                        <th class="p-2 border">No HP</th>
                        <th class="p-2 border">Kelas</th>
                        <th class="p-2 border">Status</th>
                        <th class="p-2 border">Foto Walikelas</th>
                        <th class="p-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody id="walikelas-table" class="text-center">
                    @foreach($walikelas as $index => $w)
                    <tr>
                        <td class="p-2 border text-center">{{ $index+1 }}</td>
                        <td class="p-2 border">{{ $w->nama_walikelas }}</td>
                        <td class="p-2 border">{{ $w->nomor_hp }}</td>
                        <td class="p-2 border">{{ $w->kelas->nama_kelas }}</td>
                        <td class="p-2 border">{{ ucfirst($w->status) }}</td>
                        <td class="p-2 border text-center">
                            @if($w->foto)
                            <img src="{{ asset('storage/' . $w->foto) }}" alt="Foto {{ $w->nama_walikelas }}"
                                class="w-16 h-16 object-cover rounded-md mx-auto">
                            @else
                            <span class="text-gray-400 italic">Tidak ada foto</span>
                            @endif
                        </td>
                        <td class="p-2 border space-x-2 text-center">
                            <a href="{{ route('admin.form-edit-walikelas', $w->id) }}"
                                class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
                            <form action="{{ route('admin.walikelas.destroy', $w->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded"
                                    onclick="return confirm('Yakin ingin hapus data ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- mobile --}}
    <div class=" md:hidden">
        <div class="p-6">
            <h1 class="text-xl font-bold mb-4 text-[#224779] text-center">Daftar Walikelas</h1>
            <hr class="border-1 border-[#224779]">
        </div>
        {{-- Input pencarian --}}
        {{-- <div class="flex items-center mb-4">
                <i data-lucide="search" class="w-5 h-5 mr-2 text-gray-500"></i>
                <input type="text" id="search-walikelas" placeholder="Cari nama wali kelas..."
                    class="border border-gray-300 rounded px-3 py-2 w-1/3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <a href="{{ route('admin.form-tambah-walikelas') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
        Tambah Wali Kelas
        </a>

        @if(session('success'))
        <div class="mt-4 p-2 bg-green-500 text-white rounded">
            {{ session('success') }}
        </div>
        @endif --}}

        <div class="flex flex-row justify-between items-start px-6 gap-4">
            {{-- Input Pencarian --}}
            <div class="w-full">
                <div class="flex items-center mb-4 relative">
                    <input type="text" id="search-walikelas" placeholder="Cari nama wali kelas..."
                        class="w-full pl-10 pr-4 border border-gray-300 rounded px-3 py-2  focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i data-lucide="search" class="absolute left-3 w-5 h-5 mr-2 text-gray-500"></i>
                </div>
            </div>

            <div class="relative flex items-start">
                <a href="{{ route('admin.form-tambah-walikelas') }}"
                    class="inline-flex gap-1 items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-circle-plus-icon lucide-circle-plus">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M8 12h8" />
                        <path d="M12 8v8" />
                    </svg>
                    Tambah</a>
                <div>
                    @if(session('success'))
                    <div class="mt-4 p-2 bg-green-500 text-white rounded">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- card --}}
        <div class="grid grid-cols-1 gap-6 p-6 mt-6">
            @foreach ($walikelas as $index => $w)
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center  transition duration-300 hover:shadow-xl">
                <div class="flex flex-col items-center w-full">
                    {{-- foto --}}
                    <div class="flex-shrink-0 relative w-16 h-16">
                        @if($w->foto)
                        <img src="{{ asset('storage/' . $w->foto) }}" alt="Foto {{ $w->nama_walikelas }}"
                            class="w-16 h-16 object-cover rounded-full mx-auto">
                        @else
                        <span class="text-gray-400 italic">Tidak ada foto</span>
                        @endif

                        <a href="{{ route('admin.form-edit-walikelas', $w->id) }}"
                            class="absolute bottom-0 -right-1 z-10 p-1 text-yellow-500 hover:text-yellow-600 bg-white rounded-full border border-gray-200 shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen">
                                <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                <path
                                    d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                                </svg>
                        </a>
                    </div>
                    {{-- data --}}
                    <div class="flex flex-grow flex-col">
                        <h3 class="text-lg font-bold text-black truncate mb-1" title="{{ $w->nama_walikelas }}">
                            {{ $w->nama_walikelas }}
                        </h3>
                        <p class="text-md text-gray-800">
                            <span class="font-medium">Kelas:</span> {{ $w->kelas->nama_kelas ?? 'N/A' }}
                        </p>
                        <p class="text-md text-gray-800">
                            <span class="font-medium">No HP:</span> {{ $w->nomor_hp ?? '-' }}
                        </p>
                        <div class="mt-2">
                            <p class="text-md text-gray-800">Status:
                                <span
                                    class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">{{ ucfirst($w->status) }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                {{-- <div class="absolute top-2 right-2 flex items-center">

                        <form action="{{ route('admin.walikelas.destroy', $w->id) }}" method="POST"
                onsubmit="return confirm('Yakin ingin menghapus akun + biodata siswa ini?') class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Hapus kelas ini?')"
                    class="px-2 py-1 text-red-600 hover:text-red-700 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-trash-icon lucide-trash">
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                        <path d="M3 6h18" />
                        <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                    </svg>
                </button>
                </form>
            </div> --}}
        </div>
        @endforeach

    </div>

    </div>
</x-app-layout>

{{-- Script pencarian realtime --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("search-walikelas");
        const tableBody = document.getElementById("walikelas-table");

        searchInput.addEventListener("keyup", function () {
            let query = this.value;

            fetch(`{{ route('admin.walikelas.search') }}?q=${query}`)
                .then(response => response.json())
                .then(data => {
                    tableBody.innerHTML = "";

                    if (data.length === 0) {
                        tableBody.innerHTML = `
                                    <tr>
                                        <td colspan="7" class="p-2 border text-center">Data tidak ditemukan</td>
                                    </tr>
                                `;
                    } else {
                        data.forEach((w, index) => {
                            tableBody.innerHTML += `
                                        <tr>
                                            <td class="p-2 border text-center">${index + 1}</td>
                                            <td class="p-2 border">${w.nama_walikelas}</td>
                                            <td class="p-2 border">${w.nomor_hp}</td>
                                            <td class="p-2 border">${w.kelas ?? '-'}</td>
                                            <td class="p-2 border">${w.status}</td>
                                            <td class="p-2 border text-center">
                                                ${w.foto
                                                    ? `<img src="/storage/${w.foto}" class="w-16 h-16 object-cover rounded-md mx-auto">`
                                                    : `<span class="text-gray-400 italic">Tidak ada foto</span>`
                                                }
                                            </td>
                                            <td class="p-2 border text-center">
                                                <a href="/admin/walikelas/${w.id}/edit"
                                                class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
                                                <form action="/admin/walikelas/${w.id}" method="POST" class="inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                            class="px-2 py-1 bg-red-600 text-white rounded"
                                                            onclick="return confirm('Yakin ingin hapus data ini?')">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    `;
                        });
                    }
                });
        });
    });

</script>
