<x-app-layout>
    {{-- desktop --}}
    <div class="hidden md:block" x-data="{isOpen: false}">
        <div class="py-6">
            <h1 class="text-xl font-bold mb-4 text-[#224779]">Daftar Pengguna</h1>
            <hr class="border-1 border-[#224779]">
        </div>

        <div class="flex flex-row justify-between">
            {{-- Input Pencarian --}}
            <div class="px-6">
                <div class="flex items-center mb-4 relative">
                    <input type="text" id="search-kelas" placeholder="Cari nama kelas..."
                        class="w-full pl-10 pr-4 border border-gray-300 rounded px-3 py-2  focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i data-lucide="search" class="absolute left-3 w-5 h-5 mr-2 text-gray-500"></i>
                </div>
            </div>


            {{-- Import & Export --}}
            <div class="relative w-fit">
                <div class="flex items-center gap-6 px-6 mb-6">
                    {{-- Form Import Global --}}
                        <button type="button" x-on:click="isOpen = !isOpen" class="flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-import-icon lucide-import"><path d="M12 3v12"/><path d="m8 11 4 4 4-4"/><path d="M8 5H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-4"/>
                            </svg>
                            Import Excel
                        </button>

                    {{-- Form Export Global --}}
                    <form action="{{ route('admin.data-pengguna.download-format') }}" method="POST" enctype="multipart/form-data"
                        class="flex items-center gap-6">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download-icon lucide-download"><path d="M12 15V3"/><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/>
                            </svg>
                            Download Format
                        </button>
                    </form>
                </div>

                {{-- modal improt --}}
                <div x-show="isOpen" x-cloak
                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-gray-600 bg-opacity-75  flex items-center justify-center z-50 transition-opacity duration-300">

                    <form action="{{ route('admin.data-pengguna.import.global') }} " method="POST" enctype="multipart/form-data"
                         class="bg-white rounded-lg shadow-xl w-full max-w-sm p-6 transform transition-all duration-300">
                        @csrf

                        <div class="flex justify-between items-start pb-3 border-b-2">
                            <h3 class="text-lg text-gray-700 font-semibold">Upload File Excel</h3>
                            <button type="button" @click="isOpen = false" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-[#052356] mt-2">Pilih file </label>
                            <input type="file" name="file" class=" w-full text-sm bg-[#E8EDEF] text-black border border-[#acbdcf] p-2 rounded-sm shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <p class="text-xs text-red-500 mt-1">*Pastikan menggunakan format yang sudah diunduh.</p>
                        </div>

                        <div class="flex justify-end mt-6 space-x-3">
                            <button type="button" @click="isOpen = false"
                                class="px-3 py-1 text-sm rounded-lg border border-gray-300 hover:bg-gray-100">
                                Batal
                            </button>
                            <button type="submit" class="p-2 rounded-md text-center text-md text-white bg-green-600 hover:bg-green-600">
                                Import Excel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Card Kelas --}}
        <div id="kelas-container" class="grid grid-cols-1 md:grid-cols-3 gap-6 px-6 mt-6">
            @foreach ($kelas as $k)
            <a href="{{ route('admin.data-pengguna.kelas', $k->id) }}"
                class="block p-6 bg-[#0062C8] rounded-lg shadow-xl hover:shadow-2xl transition-transform duration-300 hover:translate-y-[-5px]">
                <h2 class="text-lg text-white font-semibold">{{ $k->nama_kelas }}</h2>
                <p class="text-sm text-white">Lihat pengguna kelas ini</p>
            </a>
            @endforeach
        </div>
    </div>

    {{-- mobile --}}
    <div class="md:hidden" x-data="{ isOpen: false, isImportOpen: false }">
        <div class="p-6">
            <h1 class="text-xl font-bold mb-4 text-[#224779] text-center">Daftar Pengguna</h1>
            <hr class="border-1 border-[#224779]">
        </div>

        <div class="flex flex-row justify-between">

            {{-- Input Pencarian --}}
            <div class="px-6">
                <div class="flex items-center mb-4 relative">
                    <input type="text" id="search-kelas" placeholder="Cari nama kelas..."
                        class="w-full pl-10 pr-4 border border-gray-300 rounded px-3 py-2  focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i data-lucide="search" class="absolute left-3 w-5 h-5 mr-2 text-gray-500"></i>
                </div>
            </div>

            {{-- dropdown --}}
            <div class="px-6">
                <div  x-on:keydown.esc.prevent="isOpen = false" x-transition x-on:click.outside="isOpen = false" class="relative w-fit">
                    <button type="button" x-on:click="isOpen = ! isOpen" x-on:contextmenu.prevent="isOpen = true"
                        class="inline-flex items-center bg-transparent transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-outline-strong active:opacity-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-hard-drive-download-icon lucide-hard-drive-download">
                            <path d="M12 2v8" />
                            <path d="m16 6-4 4-4-4" />
                            <rect width="20" height="8" x="2" y="14" rx="2" />
                            <path d="M6 18h.01" />
                            <path d="M10 18h.01" /></svg>
                    </button>
                    <div x-cloak x-show="isOpen"
                        x-on:keydown.down.prevent="$focus.wrap().next()"
                        x-on:keydown.up.prevent="$focus.wrap().previous()"
                        class="absolute top-8 right-0 flex w-fit min-w-48 flex-col divide-y divide-outline overflow-hidden rounded-radius border-outline"
                        role="menu">
                        <!-- Dropdown Section -->
                        <ul class="flex flex-col py-1.5 bg-white" role="none">
                            {{-- import --}}
                            <li @click="isImportOpen = !isImportOpen; isOpen = true"
                                class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 cursor-pointer"
                                role="menuitem" tabindex="0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-import-icon lucide-import">
                                    <path d="M12 3v12" />
                                    <path d="m8 11 4 4 4-4" />
                                    <path
                                        d="M8 5H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-4" />
                                </svg>
                                Import Excel
                            </li>
                            {{-- download format --}}
                            <form action="{{ route('admin.data-pengguna.download-format') }}" method="POST"
                                enctype="multipart/form-data" class="flex items-center gap-6" role="menuitem"
                                tabindex="0">
                                @csrf
                                <button type="submit"
                                    class="px-4 py-2 flex items-center text-sm text-gray-700 gap-2 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-download-icon lucide-download">
                                        <path d="M12 15V3" />
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                        <path d="m7 10 5 5 5-5" />
                                    </svg>
                                    Download Format
                                </button>
                            </form>
                        </ul>
                    </div>
                    {{-- modal untuk import --}}
                    <div x-cloak x-show="isImportOpen" x-transition.duration.300ms
                         style="display: none;"
                        class="absolute top-8 right-0 flex w-80 flex-col overflow-hidden rounded-lg shadow-xl border border-gray-200 bg-white p-4 z-10">

                        <form action="{{ route('admin.data-pengguna.import.global') }}" method="POST"
                            enctype="multipart/form-data" class="space-y-3 "
                            @submit.prevent="isImportOpen = false; $el.submit()">
                            @csrf

                            <div class="flex justify-between items-start pb-3 border-b-2">
                                <h3 class="text-md text-gray-700 font-semibold">Upload File Excel</h3>
                                <button type="button" @click="isImportOpen = false"
                                    class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>

                            <label class="block text-sm font-medium text-[#052356] mt-2">Pilih file</label>
                            <input type="file" name="file"
                                class=" w-full text-sm bg-[#E8EDEF] text-black border border-[#acbdcf] p-2 rounded-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                            <div class="flex justify-between">
                                <button type="button" @click="isImportOpen = false"
                                    class="px-3 py-1 text-sm rounded-lg border border-gray-300 hover:bg-gray-100">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="p-2 rounded-md text-center text-md text-white bg-[#0063CB] hover:bg-[#023f80]">
                                    Import Excel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card Kelas --}}
        <div id="kelas-container" class="grid grid-cols-1 md:grid-cols-3 gap-6 px-6 mt-6">
            @foreach ($kelas as $k)
            <a href="{{ route('admin.data-pengguna.kelas', $k->id) }}"
                class="block p-6 bg-[#0062C8] rounded-lg shadow-xl hover:shadow-2xl transition-transform duration-300 hover:translate-y-[-5px]">
                <h2 class="text-lg text-white font-semibold">{{ $k->nama_kelas }}</h2>
                <p class="text-sm text-white">Lihat pengguna kelas ini</p>
            </a>
            @endforeach
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });

</script>
@endif

@if(session('import_errors'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal Import!',
        html: `{!! implode('<br>', session('import_errors')) !!}`,
        confirmButtonColor: '#d33',
        confirmButtonText: 'OK'
    });

</script>
@endif

{{-- Script Search --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("search-kelas");
        const kelasContainer = document.getElementById("kelas-container");

        searchInput.addEventListener("keyup", function () {
            let query = this.value;

            fetch(`{{ route('admin.data-pengguna.search') }}?q=${query}`)
                .then(response => response.json())
                .then(data => {
                    kelasContainer.innerHTML = "";

                    if (data.length === 0) {
                        kelasContainer.innerHTML = `
                                    <p class="text-center col-span-3 text-gray-600">Data tidak ditemukan</p>
                                `;
                    } else {
                        data.forEach(kelas => {
                            kelasContainer.innerHTML += `
                                        <a href="/admin/data-pengguna/${kelas.id}"
                                            class="block p-6 bg-[#0062C8] rounded-lg shadow-xl hover:shadow-2xl transition-transform duration-300 hover:translate-y-[-5px]">
                                            <h2 class="text-lg text-white font-semibold">${kelas.nama_kelas}</h2>
                                            <p class="text-sm text-white">Lihat pengguna kelas ini</p>
                                        </a>
                                    `;
                        });
                    }
                });
        });
    });

</script>
