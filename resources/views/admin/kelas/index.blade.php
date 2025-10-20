<x-app-layout>
    {{-- desktop --}}
    {{-- <div class="hidden md:block" x-data="{isOpenTambah: false}"> --}}
    <div class="hidden md:block" x-data="{isOpenTambah: false}">
        <div class="py-6">
            <h1 class="text-xl font-bold mb-4 text-[#224779]">Daftar Kelas</h1>
            <hr class="border-1 border-[#224779]">
        </div>

        <div class="flex flex-row justify-between">
            {{-- Input Pencarian --}}
            <div>
                <div class="flex items-center mb-4 relative">
                    <input type="text" id="search" placeholder="Cari nama kelas..."
                        class="w-full pl-10 pr-4 border border-gray-300 rounded px-3 py-2  focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i data-lucide="search" class="absolute left-3 w-5 h-5 mr-2 text-gray-500"></i>
                </div>
            </div>

            {{-- <div class="relative flex items-start" x-data="{isOpenTambah:false }"> --}}
            <div class="relative flex items-start">
                <a href="{{ route('admin.form-tambah-kelas') }}"
                    class="inline-flex gap-1 items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-circle-plus-icon lucide-circle-plus">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M8 12h8" />
                        <path d="M12 8v8" />
                    </svg>
                    Tambah</a>
                {{-- <button type="button" x-on:click="isOpenTambah = !isOpenTambah" x-on:contextmenu.prevent="isOpenTambah = true" class="inline-flex gap-1 items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus-icon lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/>
                            </svg>
                            Tambah
                    </button> --}}
                <div>
                </div>
                {{-- @include('admin.kelas.create') --}}
            </div>
        </div>

        <table class="w-full mt-4 border text-black bg-white shadow-lg">
            <thead class="bg-[#017BFA] text-black">
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Nama Kelas</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody id="kelas-table">
                @foreach($kelas as $k)
                <tr>
                    <td class="px-4 py-2 border text-start">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 border text-start">{{ $k->nama_kelas }}</td>
                    <td class="px-4 py-2 border text-start">
                        <a href="{{ route('admin.form-edit-kelas', $k->id) }}"
                            class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
                        <form action="{{ route('admin.kelas.destroy', $k->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus kelas ini?')"
                                class="px-2 py-1 bg-red-600 text-white rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    </div>

    {{-- mobile --}}
    <div class="md:hidden">
        <div class="p-6">
            <h1 class="text-xl font-bold mb-4 text-[#224779] text-center">Daftar Kelas</h1>
            <hr class="border-1 border-[#224779]">
        </div>

        {{-- Search & Tambah --}}
        <div class="flex flex-row justify-between items-start px-6 gap-4">
            <div class="w-full">
                <div class="flex items-center mb-4 relative">
                    <input type="text" id="search-mobile" placeholder="Cari nama kelas..."
                        class="w-full pl-10 pr-4 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i data-lucide="search" class="absolute left-3 w-5 h-5 text-gray-500"></i>
                </div>
            </div>

            <div class="relative flex items-start">
                <a href="{{ route('admin.form-tambah-kelas') }}"
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

        {{-- Card Kelas (UI lama + struktur baru untuk search) --}}
        <div id="kelas-card-container" class="grid grid-cols-1 gap-6 px-6 mt-6">
            @foreach ($kelas as $k)
            <div id="kelas-card-{{ $k->id }}"
                class="kelas-card relative bg-white p-6 rounded-lg shadow-lg transition duration-300 hover:shadow-xl border-l-4 border-[#017BFA]">
                <div class="absolute top-3 right-3 flex items-center space-x-2 bg-white rounded-lg p-1">
                    <a href="{{ route('admin.form-edit-kelas', $k->id) }}"
                        class="px-2 py-1 text-yellow-500 hover:text-yellow-600 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-square-pen-icon lucide-square-pen">
                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                            <path
                                d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                        </svg>
                    </a>
                    <form action="{{ route('admin.kelas.destroy', $k->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus kelas ini?')"
                            class="px-2 py-1 text-red-600 hover:text-red-700 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-trash-icon lucide-trash">
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                <path d="M3 6h18" />
                                <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                            </svg>
                        </button>
                    </form>
                </div>

                <div class="pr-4">
                    <p class="text-sm font-semibold text-gray-500">Kelas</p>
                    {{-- class .nama-kelas agar bisa diakses oleh script search --}}
                    <p class="text-lg font-bold nama-kelas">{{ $k->nama_kelas }}</p>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</x-app-layout>
{{-- Script Pencarian --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("search");
        const tableBody = document.getElementById("kelas-table");
        const searchMobile = document.getElementById("search-mobile");

        searchInput.addEventListener("keyup", function () {
            let query = this.value;

            fetch(`{{ route('admin.kelas.search') }}?q=${query}`)
                .then(response => response.json())
                .then(data => {
                    tableBody.innerHTML = "";

                    if (data.length === 0) {
                        tableBody.innerHTML = `
                                    <tr>
                                        <td colspan="3" class="border px-2 py-2 text-center">Data tidak ditemukan</td>
                                    </tr>
                                `;
                    } else {
                        data.forEach((kelas, index) => {
                            tableBody.innerHTML += `
                                        <tr>
                                            <td class="px-4 py-2 border">${index + 1}</td>
                                            <td class="px-4 py-2 border">${kelas.nama_kelas}</td>
                                            <td class="px-4 py-2 border">
                                                <a href="/admin/kelas/edit/${kelas.id}"
                                                class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
                                                <form action="/admin/kelas/destroy/${kelas.id}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Hapus kelas ini?')"
                                                        class="px-2 py-1 bg-red-600 text-white rounded">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    `;
                        });
                    }
                });
        });

        if (searchMobile) {
            searchMobile.addEventListener("keyup", function () {
                const filter = this.value.toLowerCase();
                const cards = document.querySelectorAll(".kelas-card");
                cards.forEach(card => {
                    const nama = card.querySelector(".nama-kelas").textContent.toLowerCase();
                    card.style.display = nama.includes(filter) ? "" : "none";
                });
            });
        }
    });

</script>
