<x-app-layout>
    {{-- desktop --}}
    <div class="hidden md:block">

            <div class="py-6">
                <h1 class="text-xl font-bold mb-4 text-[#224779]">Daftar Siswa</h1>
                <hr class="border-1 border-[#224779]">
            </div>

            {{-- Notifikasi sukses --}}
            @if(session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif

            <div class="flex flex-roe justify-between">
                {{-- Input Pencarian --}}
                <div>
                    <div class="flex items-center mb-4 relative">
                        <input type="text" id="search" placeholder="Cari nama siswa..."
                            class="w-full pl-10 pr-4 border border-gray-300 rounded px-3 py-2  focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <i data-lucide="search" class="absolute left-3 w-5 h-5 mr-2 text-gray-500"></i>
                    </div>
                </div>

                <div>
                    <a href="{{ route('admin.form-tambah-siswa') }}"
                        class="inline-flex gap-1 items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus-icon lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/>
                        </svg>
                        Tambah
                    </a>
                </div>
            </div>

            <table class="w-full border border-gray-300 bg-white shadow-lg text-black">
                <thead class="text-black bg-[#017BFA]">
                    <tr>
                        <th class="border px-2 py-1">#</th>
                        <th class="border px-2 py-1">Nama</th>
                        <th class="border px-2 py-1">Kelas</th>
                        <th class="border px-2 py-1">Jurusan</th>
                        <th class="border px-2 py-1">Tempat, Tanggal Lahir</th>
                        <th class="border px-2 py-1">Jenis Kelamin</th>
                        <th class="border px-2 py-1">Nomor HP</th>
                        <th class="border px-2 py-1">Aksi</th>
                    </tr>
                </thead>
                <tbody id="siswa-table" class="text-center">
                    @forelse($siswaLengkap as $index => $siswa)
                    <tr>
                        <td class="border px-2 py-1">{{ $index + 1 }}</td>
                        <td class="border px-2 py-1">{{ $siswa->nama }}</td>
                        <td class="border px-2 py-1">
                            {{ optional(optional($siswa->siswaLengkap)->kelas)->nama_kelas ?? '-' }}</td>
                        <td class="border px-2 py-1">
                            {{ optional(optional($siswa->siswaLengkap)->jurusan)->nama_jurusan ?? '-' }}</td>
                        <td class="border px-2 py-1">
                            @if($siswa->siswaLengkap)
                            {{ $siswa->siswaLengkap->tempat_lahir ?? '-' }},
                            {{ $siswa->siswaLengkap->tanggal_lahir ?? '-' }}
                            @else
                            -
                            @endif
                        </td>
                        <td class="border px-2 py-1">{{ optional($siswa->siswaLengkap)->jenis_kelamin ?? '-' }}</td>
                        <td class="border px-2 py-1">{{ optional($siswa->siswaLengkap)->nomor_hp ?? '-' }}</td>
                        <td class="border px-2 py-1 text-center">
                            <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus akun + biodata siswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                    Hapus
                                </button>
                            </form>

                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="border px-2 py-2 text-center">Belum ada data siswa</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

    </div>

    {{-- mobile --}}
    <div class="md:hidden">
        <div class="p-6">
            <h1 class="text-xl font-bold mb-4 text-[#224779] text-center">Data Siswa Lengkap</h1>
            <hr class="border-1 border-[#224779]">
        </div>
            {{-- Notifikasi sukses --}}
            @if(session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif

            {{-- Input Pencarian --}}
            {{-- <div class="flex items-center mb-4">
                <i data-lucide="search" class="w-5 h-5 mr-2 text-gray-500"></i>
                <input type="text" id="search" placeholder="Cari nama siswa..."
                    class="border border-gray-300 rounded px-3 py-2 w-1/3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <a href="{{ route('admin.form-tambah-siswa') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded mb-4 inline-block">
                + Tambah Siswa
            </a> --}}

            <div class="flex flex-row justify-between items-start px-6 gap-4">
                {{-- Input Pencarian --}}
                <div class="w-full">
                    <div class="flex items-center mb-4 relative">
                        <input type="text" id="search" placeholder="Cari nama siswa..."
                            class="w-full pl-10 pr-4 border border-gray-300 rounded px-3 py-2  focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <i data-lucide="search" class="absolute left-3 w-5 h-5 mr-2 text-gray-500"></i>
                    </div>
                </div>

                <div class="relative flex items-start">
                    <a href="{{ route('admin.form-tambah-siswa') }}"
                        class="inline-flex gap-1 items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus-icon lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/>
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

            {{-- <table class="w-full border border-gray-300 bg-white shadow-lg text-black">
                <thead class="text-black bg-[#017BFA]">
                    <tr>
                        <th class="border px-2 py-1">#</th>
                        <th class="border px-2 py-1">Nama</th>
                        <th class="border px-2 py-1">Kelas</th>
                        <th class="border px-2 py-1">Jurusan</th>
                        <th class="border px-2 py-1">Tempat, Tanggal Lahir</th>
                        <th class="border px-2 py-1">Jenis Kelamin</th>
                        <th class="border px-2 py-1">Nomor HP</th>
                        <th class="border px-2 py-1">Aksi</th>
                    </tr>
                </thead>
                <tbody id="siswa-table">
                    @forelse($siswaLengkap as $index => $siswa)
                    <tr>
                        <td class="border px-2 py-1">{{ $index + 1 }}</td>
                        <td class="border px-2 py-1">{{ $siswa->nama }}</td>
                        <td class="border px-2 py-1">
                            {{ optional(optional($siswa->siswaLengkap)->kelas)->nama_kelas ?? '-' }}</td>
                        <td class="border px-2 py-1">
                            {{ optional(optional($siswa->siswaLengkap)->jurusan)->nama_jurusan ?? '-' }}</td>
                        <td class="border px-2 py-1">
                            @if($siswa->siswaLengkap)
                            {{ $siswa->siswaLengkap->tempat_lahir ?? '-' }},
                            {{ $siswa->siswaLengkap->tanggal_lahir ?? '-' }}
                            @else
                            -
                            @endif
                        </td>
                        <td class="border px-2 py-1">{{ optional($siswa->siswaLengkap)->jenis_kelamin ?? '-' }}</td>
                        <td class="border px-2 py-1">{{ optional($siswa->siswaLengkap)->nomor_hp ?? '-' }}</td>
                        <td class="border px-2 py-1">
                            <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus akun + biodata siswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                    Hapus
                                </button>
                            </form>

                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="border px-2 py-2 text-center">Belum ada data siswa</td>
                    </tr>
                    @endforelse
                </tbody>
            </table> --}}

            {{-- card --}}
            <div class="grid grid-cols-1 gap-6 px-6 mt-6">
                @foreach ($siswaLengkap as $index => $siswa)
                <div class="relative bg-white p-6 rounded-lg shadow-lg transition duration-300 hover:shadow-xl border-l-4 border-[#017BFA]">
                    <div class="absolute top-3 right-3 flex items-center space-x-2 bg-white/70 rounded-lg p-1">
                        <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus akun + biodata siswa ini?') class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus kelas ini?')"
                                class="px-2 py-1 text-red-600 hover:text-red-700 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-icon lucide-trash"><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                </svg>
                            </button>
                        </form>
                    </div>

                    <h3 class="text-xl font-bold pb-3">{{ $siswa->nama }}</h3>

                    <div>
                        <div class="grid grid-cols-2 gap-y-2 gap-x-4 mb-3 pb-3 border-b-2 border-double ">
                            <p class="text-sm font-semibold">Kelas: <span class="text-md font-bold">{{ optional(optional($siswa->siswaLengkap)->kelas)->nama_kelas ?? '-' }}</span></p>
                            <p class="text-sm font-semibold">Jurusan: <span class="text-md font-bold">{{ optional(optional($siswa->siswaLengkap)->jurusan)->nama_jurusan ?? '-' }}</span></p>
                    </div>

                        <div class="space-y-2">
                            <p class="text-sm font-semibold inline-block">Tempat Tanggal Lahir:
                                <span class="text-md font-bold">
                                    @if($siswa->siswaLengkap)
                                        {{ $siswa->siswaLengkap->tempat_lahir ?? '-' }},
                                        {{ $siswa->siswaLengkap->tanggal_lahir ?? '-' }}
                                    @else
                                    -
                                    @endif
                                </span>
                            </p>
                            <p class="text-sm font-semibold">Jenis Kelamin: <span class="text-md font-bold">{{ optional($siswa->siswaLengkap)->jenis_kelamin ?? '-' }}</span></p>
                            <p class="text-sm font-semibold">No HP: <span class="text-md font-bold">{{ optional($siswa->siswaLengkap)->nomor_hp ?? '-' }}</span></p>
                        </div>
                    </div>

                    {{-- <div class="absolute top-2 right-2 flex items-center">
                        <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus akun + biodata siswa ini?') class="inline-block">
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

    {{-- Script pencarian --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // lucide.createIcons();

            const searchInput = document.getElementById("search");
            const tableBody = document.getElementById("siswa-table");

            searchInput.addEventListener("keyup", function () {
                let query = this.value;

                fetch(`{{ route('admin.siswa.search') }}?q=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        tableBody.innerHTML = "";

                        if (data.length === 0) {
                            tableBody.innerHTML = `
                                <tr>
                                    <td colspan="7" class="border px-2 py-2 text-center">Data tidak ditemukan</td>
                                </tr>
                            `;
                        } else {
                            data.forEach((siswa, index) => {
                                tableBody.innerHTML += `
                                    <tr>
                                        <td class="border px-2 py-1">${index + 1}</td>
                                        <td class="border px-2 py-1">${siswa.nama}</td>
                                        <td class="border px-2 py-1">${siswa.kelas ?? '-'}</td>
                                        <td class="border px-2 py-1">${siswa.jurusan ?? '-'}</td>
                                        <td class="border px-2 py-1">${siswa.tempat_lahir ?? '-'}, ${siswa.tanggal_lahir ?? '-'}</td>
                                        <td class="border px-2 py-1">${siswa.jenis_kelamin ?? '-'}</td>
                                        <td class="border px-2 py-1">${siswa.nomor_hp ?? '-'}</td>
                                    </tr>
                                `;
                            });
                        }
                    });
            });
        });

    </script>
</x-app-layout>
