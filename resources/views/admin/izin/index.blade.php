<x-app-layout>
    {{-- desktop --}}
    <div class="hidden md:block">
        <div class="mb-6">
            <h1 class="text-xl font-bold mb-4 text-[#224779]">Daftar Walikelas</h1>
            <hr class="border-1 border-[#224779]">
        </div>

        <div class="flex flex-row justify-between">
            <!-- Input Pencarian -->
            <div>
                <div class="flex items-center mb-4 relative">
                    <input type="text" id="search-izin" placeholder="Cari nama siswa..."
                        class="w-full pl-10 pr-4 border border-gray-300 rounded px-3 py-2  focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i data-lucide="search" class="absolute left-3 w-5 h-5 mr-2 text-gray-500"></i>
                </div>
            </div>

            <!-- Form Filter -->
            <form method="GET" action="{{ route('admin.izin.index') }}" class="mb-4 flex space-x-4">
                <select name="jurusan_id" class="border rounded p-2">
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach ($jurusan as $j)
                    <option value="{{ $j->id }}" {{ request('jurusan_id') == $j->id ? 'selected' : '' }}>
                        {{ $j->nama_jurusan }}
                    </option>
                    @endforeach
                </select>

                <select name="kelas_id" class="border rounded p-2">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($kelas as $k)
                    <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kelas }}
                    </option>
                    @endforeach
                </select>

                <select name="status_izin" class="border rounded p-2">
                    <option value="">-- Pilih Status --</option>
                    <option value="menunggu_bukti" {{ request('status_izin') == 'menunggu_bukti' ? 'selected' : '' }}>
                        Menunggu Bukti Lampiran</option>
                    <option value="menunggu_validasi" {{ request('status_izin') == 'menunggu_validasi' ? 'selected' : '' }}>
                        Menunggu Validasi Petugas</option>
                    <option value="disetujui" {{ request('status_izin') == 'disetujui' ? 'selected' : '' }}>Disetujui
                    </option>
                    <option value="ditolak" {{ request('status_izin') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>

                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">Filter</button>
            </form>
        </div>

            <!-- Tabel Data -->
            <table class="w-full border-collapse border bg-white shadow-lg text-black">
                <thead class="text-black bg-[#017BFA]">
                    <tr>
                        <th class="border p-2">Nama Siswa</th>
                        <th class="border p-2">Jurusan</th>
                        <th class="border p-2">Kelas</th>
                        <th class="border p-2">Jenis Izin</th>
                        <th class="border p-2">Keterangan Izin</th>
                        <th class="border p-2">Tanggal</th>
                        <th class="border p-2">Status</th>
                    </tr>
                </thead>
                <tbody id="izin-table">
                    @foreach ($izin as $i)
                    <tr>
                        <td class="border p-2">{{ $i->user->nama }}</td>
                        <td class="border p-2">{{ $i->user->siswaLengkap->jurusan->nama_jurusan ?? '-' }}</td>
                        <td class="border p-2">{{ $i->user->siswaLengkap->kelas->nama_kelas ?? '-' }}</td>
                        <td class="border p-2">{{ ucfirst($i->jenis_izin) }}</td>
                        <td class="border p-2">
                            @if($i->hasil_validasi === 'kembali_sekolah')
                            Siswa kembali lagi ke sekolah
                            @elseif($i->hasil_validasi === 'pulang_rumah')
                            Siswa kembali ke rumah
                            @elseif($i->hasil_validasi === 'izin_lebih_dari_sehari')
                            Siswa izin lebih dari sehari
                            @else
                            -
                            @endif
                        </td>
                        <td class="border p-2">{{ $i->tanggal }}</td>
                        <td class="border p-2">{{ ucfirst($i->status_izin) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Script pencarian realtime --}}
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const searchInput = document.getElementById("search-izin");
                    const tableBody = document.getElementById("izin-table");

                    searchInput.addEventListener("keyup", function () {
                        let query = this.value;

                        fetch(`{{ route('admin.izin.search') }}?q=${query}`)
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
                                    data.forEach(i => {
                                        tableBody.innerHTML += `
                                <tr>
                                    <td class="border p-2">${i.nama}</td>
                                    <td class="border p-2">${i.jurusan ?? '-'}</td>
                                    <td class="border p-2">${i.kelas ?? '-'}</td>
                                    <td class="border p-2">${i.jenis_izin}</td>
                                    <td class="border p-2">${i.keterangan_izin}</td>
                                    <td class="border p-2">${i.tanggal}</td>
                                    <td class="border p-2">${i.status_izin}</td>
                                </tr>
                            `;
                                    });
                                }
                            });
                    });
                });

            </script>
    </div>

    {{-- mobile --}}
    <div class="md:hidden" x-data="{open= false}">
        <div class="p-6">
            <h1 class="text-xl font-bold mb-4 text-[#224779] text-center">Laporan Pengajuan Izin</h1>
            <hr class="border-1 border-[#224779]">
        </div>

        <div class="flex flex-row justify-between items-start px-6 gap-4">
            <!-- Input Pencarian -->
            {{-- <div class="flex items-center mb-4">
                <i data-lucide="search" class="w-5 h-5 mr-2 text-gray-500"></i>
                <input type="text" id="search-izin" placeholder="Cari nama siswa..."
                    class="border border-gray-300 rounded px-3 py-2 w-1/3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div> --}}
            <div class="w-full">
                <div class="flex items-center mb-4 relative">
                    <input type="text" id="search-izin" placeholder="Cari nama siswa..."
                        class="w-full pl-10 pr-4 border border-gray-300 rounded px-3 py-2  focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i data-lucide="search" class="absolute left-3 w-5 h-5 mr-2 text-gray-500"></i>
                </div>
            </div>

            {{-- filter --}}
            <div x-data="{open: false}" x-on:keydown.esc.prevent="isOpen = false" class="relative w-fit">
                <button type="button" x-on:click=" open =!open" x-on-content:contextmenu.prevent="open = true" class="inline-flex items-center bg-transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-list-filter-icon lucide-list-filter"><path d="M2 5h20"/><path d="M6 12h12"/><path d="M9 19h6"/>
                    </svg>
                </button>

                <div x-cloak x-show="open" x-transition x-on:click.outside="open= false" x-on:keydown.down.prevent="$focus.wrap().next()" x-on:keydown.up.prevent="$focus.wrap().previous()"
                     class="absolute top-8 right-0 flex w-fit min-w-48 flex-col divide-y divide-outline overflow-hidden rounded-radius border-outline z-10" role="menu">

                     {{-- form filter --}}
                     <div class="flex flex-col py-1.5 bg-white" role="none"">
                        <form method="GET" action="{{ route('admin.izin.index') }}" class="flex flex-wrap items-center gap-4 p-6">
                            <div>
                                <select name="jurusan_id" class="border border-gray-300 rounded p-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    <option value="">-- Pilih Jurusan --</option>
                                    @foreach ($jurusan as $j)
                                    <option value="{{ $j->id }}" {{ request('jurusan_id') == $j->id ? 'selected' : '' }}>
                                        {{ $j->nama_jurusan }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <select name="kelas_id" class="border border-gray-300 rounded p-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kelas }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <select name="status_izin" class="border border-gray-300 rounded p-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="menunggu_bukti" {{ request('status_izin') == 'menunggu_bukti' ? 'selected' : '' }}>
                                        Menunggu Bukti Lampiran</option>
                                    <option value="menunggu_validasi" {{ request('status_izin') == 'menunggu_validasi' ? 'selected' : '' }}>
                                        Menunggu Validasi Petugas</option>
                                    <option value="disetujui" {{ request('status_izin') == 'disetujui' ? 'selected' : '' }}>Disetujui
                                    </option>
                                    <option value="ditolak" {{ request('status_izin') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>
                            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded transition text-sm">
                                Filter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

            {{-- card --}}
            <div class="grid grid-cols-1 gap-6 px-6 mt-6">
                @foreach ($izin as $i)
                <div class="bg-white p-5 rounded-xl shadow-lg border-t-4 border-[#017BFA] transition duration-300 hover:shadow-xl flex flex-col">

                    <div class="flex justify-between items-start mb-1  border-b-2 border-double border-black">
                        <h3 class="text-xl font-bold pb-3">{{ $i->user->nama }}</h3>

                         @php
                            $status = strtolower($i->status_izin ?? 'belum_diproses');
                            $badgeClass = [
                                'disetujui' => 'bg-green-100 text-green-700',
                                'menunggu_validasi' => 'bg-yellow-100 text-yellow-700',
                            ][$status] ?? 'bg-gray-100 text-gray-700';
                        @endphp

                        <span class="text-xs font-semibold px-3 py-1 rounded-full flex-shrink-0 {{ $badgeClass }}">
                            {{ ucfirst($i->status_izin) }}</span>

                    </div>
                    <div class="grid grid-cols-2 gap-y-2 gap-x-4 mb-3 text-sm text-gray-900 mt-3">
                        <div>
                            <span class="text-md font-semibold text-black block">Kelas:</span>
                            <span class="text-lg font-bold">{{ $i->user->siswaLengkap->kelas->nama_kelas ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="text-md font-semibold text-black block">Jurusan:</span>
                            <span class="text-lg font-bold">{{ $i->user->siswaLengkap->jurusan->nama_jurusan ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="space-y-2 text-sm text-gray-900 pt-3 border-t">
                        <p class="text-md font-semibold">Keterangan Izin: <span class="text-md font-bold">
                            @if($i->hasil_validasi === 'kembali_sekolah')
                            Siswa kembali lagi ke sekolah
                            @elseif($i->hasil_validasi === 'pulang_rumah')
                            Siswa kembali ke rumah
                            @elseif($i->hasil_validasi === 'izin_lebih_dari_sehari')
                            Siswa izin lebih dari sehari
                            @else
                            -
                            @endif
                        </span></p>
                        <p class="text-md font-semibold ">Tanggal: <span class="text-md font-bold">{{ $i->tanggal }}</span></p>
                    </div>

                </div>
                @endforeach

            </div>

            {{-- Script pencarian realtime --}}
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const searchInput = document.getElementById("search-izin");
                    const tableBody = document.getElementById("izin-table");

                    searchInput.addEventListener("keyup", function () {
                        let query = this.value;

                        fetch(`{{ route('admin.izin.search') }}?q=${query}`)
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
                                    data.forEach(i => {
                                        tableBody.innerHTML += `
                                <tr>
                                    <td class="border p-2">${i.nama}</td>
                                    <td class="border p-2">${i.jurusan ?? '-'}</td>
                                    <td class="border p-2">${i.kelas ?? '-'}</td>
                                    <td class="border p-2">${i.jenis_izin}</td>
                                    <td class="border p-2">${i.keterangan_izin}</td>
                                    <td class="border p-2">${i.tanggal}</td>
                                    <td class="border p-2">${i.status_izin}</td>
                                </tr>
                            `;
                                    });
                                }
                            });
                    });
                });

            </script>
    </div>

</x-app-layout>



<div class="mt-4">
    {{ $izin->links() }}
</div>
