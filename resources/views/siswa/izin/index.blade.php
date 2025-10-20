<x-app-layout>
    {{-- desktop --}}
    <div class="hidden md:block">
        <div class="container mx-auto p-4 mt-8">
            <div class="bg-[#017BFA] rounded-2xl p-8 shadow-lg">
                <h1 class="text-white text-center text-xl md:text-4xl font-bold mb-4">Panduan Mengajukan Izin</h1>

                {{-- card --}}
                <div class="grid grid-cols-2 gap-6">
                    {{-- data diri --}}
                    <div class="p-6 rounded-xl bg-white shadow-lg transition hover:shadow-2xl flex items-center justify-between gap-6">
                        <div class="flex-1 pr-4">
                            <div class="flex items-center space-x-3 mb-3">
                                <span class="inline-flex items-center justify-center bg-[#017BFA] text-white font-extrabold w-10 h-10 rounded-full text-xl flex-shrink-0">1</span>
                                <h2 class="text-2xl font-semibold text-gray-800">Lengkapi Data Diri</h2>
                            </div>
                            <hr class="border-gray-300 mb-3">
                            {{-- <h1 class="text-xl md:text-2xl font-semibold mb-2">
                                <span class="inline-flex items-center justify-center bg-[#017BFA] text-white font-extrabold w-8 h-8 rounded-full">1</span>
                                Lengkapi Data Diri</h1> --}}
                            <p class="text-lg text-gray-800">Sebelum mengajukan izin, pastikan siswa sudah mengisi data diri lengkap pada menu Profil Siswa.</p>
                            <p class="text-md text-red-600 font-semibold mt-2">📌 Tanpa data diri yang lengkap, siswa tidak dapat mengajukan izin.</p>
                        </div>
                        <div class="flex-shrink-0">
                            <img src="{{asset('storage/asset/Account-cuate.svg')}}" alt="Mengisi Data Diri" class="w-20 md:w-40">
                        </div>
                    </div>


                    {{-- form izin --}}
                    <div class="p-6 rounded-xl bg-white shadow-lg transition hover:shadow-2xl flex items-center justify-between gap-6">
                        <div class="flex-1 pr-4">
                            <div class="flex items-center space-x-3 mb-3">
                                <span class="inline-flex items-center justify-center bg-[#017BFA] text-white font-extrabold w-10 h-10 rounded-full text-xl flex-shrink-0">2</span>
                                <h2 class="text-2xl font-semibold text-gray-800">Mengisi Form Izin</h2>
                            </div>
                            <hr class="border-gray-300 mb-3">
                            {{-- <h1 class="text-xl md:text-2xl font-semibold mb-2">
                                <span class="inline-flex items-center justify-center bg-white text-[#017BFA] font-semibold w-8 h-8 rounded-full">2</span>
                                Mengisi Form Izin</h1>  --}}
                            <p class="text-lg text-gray-900">Setelah data lengkap, siswa dapat mengajukan izin dengan langkah berikut:</p>
                            <ul class="text-md text-gray-800 list-disc list-inside">
                                <li>Pilih jenis izin: Sakit / Izin</li>
                                <li>Isi alasan dan keterangan (misalnya: kembali ke sekolah atau langsung pulang ke rumah)</li>
                                <li>Isi jam keluar sesuai dengan waktu izin.</li>
                            </ul>
                        </div>
                        <div class="flex-shrink-0">
                            <img src="{{asset('storage/asset/Forms-cuate.svg')}}" alt="Mengisi Data Diri" class="w-24 md:w-40">
                        </div>
                    </div>


                    {{-- QR Code --}}
                    <div class="p-6 rounded-xl bg-white shadow-lg transition hover:shadow-2xl flex items-center justify-between gap-6">
                        <div class="flex-1 pr-4">
                            <div class="flex items-center space-x-3 mb-3">
                                <span class="inline-flex items-center justify-center bg-[#017BFA] text-white font-extrabold w-10 h-10 rounded-full text-xl flex-shrink-0">3</span>
                                <h2 class="text-2xl font-semibold text-gray-800">Scan QR Code</h2>
                            </div>
                            <hr class="border-gray-300 mb-3">
                            {{-- <h1 class="text-xl md:text-2xl font-semibold mb-2">
                                <span class="inline-flex items-center justify-center bg-white text-[#017BFA] font-semibold w-8 h-8 rounded-full">3</span>
                                Scan QR Code</h1> --}}
                            <p class="text-lg text-gray-900 mt-2">Setelah formulir izin diajukan:</p>
                            <ul class="text-md text-gray-800 list-disc list-inside">
                                <li>Sistem akan menampilkan QR Code</li>
                                <li>Temui petugas untuk memindai QR Code</li>
                                <li>Petugas akan mencetak surat izin & memberikan tanda tangan persetujuan</li>
                            </ul>
                        </div>
                        <div class="flex-shrink-0">
                            <img src="{{asset('storage/asset/QR Code-amico.svg')}}" alt="Scan QR Code" class="w-20 md:w-40">
                        </div>
                    </div>

                    {{-- Bukti Izin --}}
                    <div class="p-6 rounded-xl bg-white shadow-lg transition hover:shadow-2xl flex items-center justify-between gap-6">
                        <div class="flex-1 pr-4">
                            <div class="flex items-center space-x-3 mb-3">
                                <span class="inline-flex items-center justify-center bg-[#017BFA] text-white font-extrabold w-10 h-10 rounded-full text-xl flex-shrink-0">4</span>
                                <h2 class="text-2xl font-semibold text-gray-800">Upload Bukti Izin</h2>
                            </div>
                            <hr class="border-gray-300 mb-3">
                            {{-- <h1 class="text-xl md:text-2xl font-semibold mb-2">
                                <span class="inline-flex items-center justify-center bg-white text-[#017BFA] font-semibold w-8 h-8 rounded-full">4</span>
                                Upload Bukti Izin</h1> --}}
                            <p class="text-lg text-gray-900 mt-2">Setelah izin digunakan, siswa wajib mengunggah bukti:</p>
                            <ul class="text-md text-gray-800 list-disc list-inside">
                                <li>Jika izin industri/bimbingan, unggah foto bersama pembimbing.</li>
                                <li>Jika izin sakit, unggah bukti sampai di rumah atau surat keterangan dokter.</li>
                                <li>Petugas akan mencetak surat izin & memberikan tanda tangan persetujuan</li>
                            </ul>
                            <p class="text-md text-red-600 font-semibold mt-2">📌 Jika bukti tidak diunggah, status izin dianggap belum selesai.</p>
                        </div>
                        <div class="flex-shrink-0">
                            <img src="{{asset('storage/asset/Image upload-amico.svg')}}" alt="Scan QR Code" class="w-20 md:w-40">
                        </div>
                    </div>
                </div>
                {{-- Tombol Aksi (Ganti blok <a> sebelumnya dengan ini) --}}
                <a href="{{route('izin.create')}}" class="block mt-10">
                    <div class="max-w-sm mx-auto bg-blue-400 text-center rounded-lg shadow-xl p-4 hover:bg-[#0060C8] transition duration-200">
                        <h1 class="text-white font-extrabold text-xl">
                            Ajukan Izin Sekarang →
                        </h1>
                    </div>
                </a>
            </div>
        </div>
    </div>

    {{-- mobile --}}
    <div class="md:hidden">
        <div class="bg-[#5F9EF2] w-full h-16 rounded-b-lg p-6 text-center fixed top-0 right-0 left-0 z-10 text-white">
                <h1 class="text-xl font-bold mb-6 text-white">
                    Panduan Izin
                </h1>
            </div>
        <div class="p-6 mt-8">
            <p class="text-sm text-gray-600 mb-6 text-center">Ikuti 4 langkah mudah berikut untuk mengajukan dan menyelesaikan izin Anda.</p>

            <div class="grid grid-cols-1 gap-4">
                {{-- lengkapi data diri --}}
                <div class="bg-white rounded-xl p-6 shadow-lg border-l-4 border-blue-500">
                    <div class="flex items-center space-x-3 mb-2">
                        <span class="inline-flex items-center justify-center bg-[#5F9EF2] text-white font-extrabold w-8 h-8 rounded-full">1</span>
                        <h1 class="font-bold text-lg">Lengkapi Data Diri</h1>
                    </div>
                    <hr class="border-gray-300 mb-3">
                        <p class="text-md text-gray-900">Sebelum mengajukan izin, pastikan siswa sudah mengisi data diri lengkap pada menu Profil Siswa.</p>
                        <p class="text-md text-red-600 font-semibold mt-2">📌 Tanpa data diri yang lengkap, siswa tidak dapat mengajukan izin.</p>
                </div>

                {{-- mengisi form --}}
                <div class="bg-white rounded-xl p-6 shadow-lg border-l-4 border-blue-500">
                    <div class="flex items-center space-x-3 mb-2">
                        <span class="inline-flex items-center justify-center bg-[#5F9EF2] text-white font-extrabold w-8 h-8 rounded-full">2</span>
                        <h1 class="font-bold text-lg">Ajukan Izin</h1>
                    </div>
                    <hr class="border-gray-300 mb-3">
                        <p class="text-md text-gray-900">Setelah data lengkap, siswa dapat mengajukan izin dengan langkah berikut:</p>
                        <ul class="text-sm text-gray-700 list-disc list-inside mt-2 space-y-1">
                            <li>Pilih jenis izin: Sakit / Izin</li>
                            <li>Isi alasan dan keterangan (misalnya: kembali ke sekolah atau langsung pulang ke rumah)</li>
                            <li>Isi jam keluar sesuai dengan waktu izin.</li>
                        </ul>
                </div>

                {{-- scan qr code --}}
                <div class="bg-white rounded-xl p-6 shadow-lg border-l-4 border-blue-500">
                    <div class="flex items-center space-x-3 mb-2">
                        <span class="inline-flex items-center justify-center bg-[#017BFA] text-white font-extrabold w-8 h-8 rounded-full text-lg flex-shrink-0">3</span>
                        <h1 class="font-bold text-lg">Dapatkan QR Code Persetujuan</h1>
                    </div>
                    <hr class="border-gray-300 mb-3">
                        <p class="text-md text-gray-900">Setelah formulir izin diajukan:</p>
                        <ul class="text-sm text-gray-700 list-disc list-inside mt-2 space-y-1">
                            <li>Sistem akan menampilkan QR Code</li>
                            <li>Temui petugas untuk memindai QR Code</li>
                            <li>Petugas akan mencetak surat izin & memberikan tanda tangan persetujuan</li>
                        </ul>
                </div>

                {{-- upload bukti --}}
                <div class="bg-white rounded-xl p-6 shadow-lg border-l-4 border-blue-500">
                    <div class="flex items-center space-x-3 mb-2">
                        <span class="inline-flex items-center justify-center bg-[#5F9EF2] text-white font-extrabold w-8 h-8 rounded-full text-lg">4</span>
                        <h1 class="font-bold text-lg">Upload Bukti Izin</h1>
                    </div>
                    <hr class="border-gray-300 mb-3">
                        <p class="text-md text-gray-900">Setelah izin digunakan, siswa wajib mengunggah bukti:</p>
                        <ul class="text-sm text-gray-700 list-disc list-inside mt-2 space-y-1">
                            <li>Jika izin industri/bimbingan, unggah foto bersama pembimbing.</li>
                            <li>Jika izin sakit, unggah bukti sampai di rumah atau surat keterangan dokter.</li>
                            <li>Petugas akan mencetak surat izin & memberikan tanda tangan persetujuan</li>
                        </ul>
                        <p class="text-md text-red-600 font-semibold mt-2">📌 Jika bukti tidak diunggah, status izin dianggap belum selesai.</p>
                </div>
            </div>
            <a href="{{route('izin.create')}}" class="block mt-8">
                <div class="bg-blue-400 hover:bg-blue-600 text-center rounded-lg shadow-md p-4">
                    <h1 class="text-white font-bold text-xl">Ajukan Izin Sekarang →</h1>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
