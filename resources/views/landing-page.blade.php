<!-- @auth('web')
    @php
        $user = Auth::guard('web')->user();
        if ($user->role === 'admin') {
            header('Location: ' . route('admin.dashboard'));
            exit;
        } elseif ($user->role === 'siswa') {
            header('Location: ' . route('siswa.dashboard'));
            exit;
        }
    @endphp
@endauth

@auth('petugas')
    @php
        header('Location: ' . route('admin.dashboard'));
        exit;
    @endphp
@endauth -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Landing Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#EFF5FE]  min-h-screen">
    <header>
        <div class="bg-[#5F9EF2]  p-4 flex items-center text-white top-6 left-0 right-0 z-40 gap-4">
            <img src="{{asset('storage/asset/logo.png')}}" alt="" class="w-12 h-16 mb-4 mt-2 ">
            <h1 class="text-white text-2xl font-extrabold">e-SIS</h1>
        </div>
    </header>

    {{-- section 1  --}}
    <div class="container mx-auto p-4 mt-8">
        <div class="bg-[#568EDA] rounded-2xl p-8 shadow-lg ">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-8 md:space-y-0 md:space-x-8">
                {{-- Teks dan Tombol --}}
                <div class="flex flex-col text-white text-center md:text-left flex-1">
                    <h1 class="text-2xl md:text-5xl font-bold mb-2">Selamat Datang Di e-SIS</h1>
                    <p class="text-md text-start md:text-xl font-light mb-4 ">
                        Elektronik Surat Izin Sekolah - Cepat, Mudah, Digital
                        <br>
                        Mengajukan izin kini lebih praktis & transparan
                    </p>
                    @guest
                    {{-- Jika belum login --}}
                    <a href="{{ route('login') }}"
                        class="mt-4 px-6 py-3 bg-blue-500 rounded-full text-white font-bold hover:bg-blue-600 transition duration-200 shadow-md md:self-start">
                        Mulai Gunakan
                    </a>
                    @endguest

                    @auth('web')
                    @php
                    $user = Auth::guard('web')->user();
                    if ($user->role === 'admin') {
                    $dashboard = route('admin.dashboard');
                    } elseif ($user->role === 'siswa') {
                    $dashboard = route('siswa.dashboard');
                    } else {
                    $dashboard = route('login');
                    }
                    @endphp

                    <a href="{{ $dashboard }}"
                        class="mt-4 px-6 py-3 bg-green-600 rounded-full text-white font-bold hover:bg-green-600 transition duration-200 shadow-md md:self-start">
                        Buka Dashboard
                    </a>
                    @endauth

                    @auth('petugas')
                    <a href="{{ route('admin.dashboard') }}"
                        class="mt-4 px-6 py-3 bg-green-600 rounded-full text-white font-bold hover:bg-green-600 transition duration-200 shadow-md md:self-start">
                        Buka Dashboard
                    </a>
                    @endauth

                </div>

                {{-- Ilustrasi Atas --}}
                <div class="flex-shrink-0 right-0 left-0">
                    <img src="{{ asset('storage/asset/forms-animate.svg') }}" alt="Ilustrasi Selamat Datang"
                        class="w-full max-w-xs md:max-w-md">
                </div>
            </div>
        </div>
    </div>

    {{-- section 2 tentang e-sis--}}
    <div class="container mx-auto p-4 mt-8">
        <div class="bg-[#568EDA] rounded-2xl p-8 shadow-lg">
            <div class="flex flex-col md:flex-row items-center md:justify-between space-y-8 md:space-y-0 md:space-x-8">
                <div class=" hidden md:block">
                    <img src="{{ asset('storage/asset/undraw_pair-programming_9jyg.svg') }}"
                        alt="Ilustrasi Tentang Kami" class="w-full max-w-xs md:max-w-md">
                </div>

                <div class="flex flex-col text-white text-left md:text-left">
                    <h1 class="text-white text-3xl md:text-4xl font-bold mb-4">Tentang e-SIS</h1>
                    <p class="text-lg md:text-lg font-light">
                        E-SIS (Elektronik Surat Izin Sekolah) adalah aplikasi berbasis web yang dirancang untuk
                        memudahkan proses pengajuan izin siswa secara digital, aman, dan terintegrasi dengan sekolah.
                    </p>
                    <p class="text-lg md:text-lg font-light mt-4">
                        Aplikasi ini dibuat oleh Aji Pamungkas dan Azizah Hajar siswa dari Kelas XI RPL 2, dengan tujuan
                        utama mendigitalisasi alur izin sekolah agar lebih efisien, transparan, dan ramah lingkungan.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- section 3 --}}
    <div class="container mx-auto p-4 mt-8">
        <div class="bg-[#568EDA] rounded-2xl p-8 shadow-lg">
            <h1 class="text-white text-center text-2xl md:text-4xl font-bold mb-4">Keunggulan</h1>

            <!-- Swiper Container -->
            <div class="swiper keunggulanSwiper mt-6" dir="rtl">
                <div class="swiper-wrapper">

                    <!-- Slide 1 -->
                    <div class="swiper-slide">
                        <div class="bg-white rounded-lg p-6 flex flex-col items-center justify-between">
                            <div class="items-center text-center">
                                <img src="{{asset('storage/asset/undraw_to-do-app_esjl.svg')}}" alt="" class="w-16">
                                <h1 class="text-2xl md:text-4xl font-bold mb-4">Mudah Digunakan</h1>
                                <p>Desain sederhana & user-friendly</p>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="swiper-slide">
                        <div class="bg-white rounded-lg p-6 flex flex-col items-center justify-between">
                            <div class="items-center text-center">
                                <img src="{{asset('storage/asset/undraw_to-do-app_esjl.svg')}}" alt="" class="w-16">
                                <h1 class="text-2xl md:text-4xl font-bold mb-4">Cepat & Praktis</h1>
                                <p class="text-base">Tidak perlu kertas, semua berbasis digital.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="swiper-slide">
                        <div class="bg-white rounded-lg p-6 flex flex-col items-center justify-between">
                            <div class="items-center text-center">
                                <img src="{{asset('storage/asset/undraw_to-do-app_esjl.svg')}}" alt="" class="w-16">
                                <h1 class="text-2xl md:text-4xl font-bold mb-4">Terintegrasi</h1>
                                <p>Data izin langsung tersimpan di sistem sekolah</p>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 4 -->
                    <div class="swiper-slide">
                        <div class="bg-white rounded-lg p-6 flex flex-col items-center justify-between">
                            <div class="items-center text-center">
                                <img src="{{asset('storage/asset/undraw_to-do-app_esjl.svg')}}" alt="" class="w-16">
                                <h1 class="text-2xl md:text-4xl font-bold mb-4">Aman & Transparan</h1>
                                <p>Setiap izin tervalidasi dengan jelas</p>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 5 -->
                    <div class="swiper-slide">
                        <div class="bg-white rounded-lg p-6 flex flex-col items-center justify-between">
                            <div class="items-center text-center">
                                <img src="{{asset('storage/asset/undraw_to-do-app_esjl.svg')}}" alt="" class="w-16">
                                <h1 class="text-2xl md:text-4xl font-bold mb-4">Eco-Friendly</h1>
                                <p>Mengurangi penggunaan kertas di sekolah</p>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 6 -->
                    <div class="swiper-slide">
                        <div class="bg-white rounded-lg p-6 flex flex-col items-center justify-between">
                            <div class="items-center text-center">
                                <img src="{{asset('storage/asset/undraw_to-do-app_esjl.svg')}}" alt="" class="w-16">
                                <h1 class="text-2xl md:text-4xl font-bold mb-4">Riwayat Tersimpan</h1>
                                <p>Siswa & admin bisa melihat catatan izin kapan saja.</p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Pagination & Navigation -->
                <div class="swiper-pagination mt-4"></div>
                <div class="swiper-button-prev text-white"></div>
                <div class="swiper-button-next text-white"></div>
            </div>
        </div>
    </div>



    {{-- section 4 --}}
    <div class="container mx-auto p-4 mt-8">
        <div class="bg-[#568EDA] rounded-2xl p-8 shadow-lg">
            <h1 class="text-white text-center text-3xl md:text-4xl font-bold mb-4">Panduan Praktis Mengajukan</h1>

            {{-- card --}}
            <div class="flex flex-wrap -mx-2">
                {{-- mudh digunakan --}}
                <div class="w-full sm:w-1/2 px-2 mb-4">
                    <div class="bg-[#5F9EF2] rounded-lg p-6 flex items-center justify-between text-white">
                        <div class="flex-1 pr-4"> {{-- Konten teks di kiri --}}
                            <h1 class="text-xl md:text-2xl font-semibold mb-2">Mengisi Data Diri</h1>
                            <p class="text-sm md:text-base">Lengkapi profil sebelum izin</p>
                        </div>
                        <div class="flex-shrink-0"> {{-- Gambar di kanan --}}
                            <img src="{{asset('storage/asset/Account-cuate.svg')}}" alt="Mengisi Data Diri"
                                class="w-20 md:w-40">
                        </div>
                    </div>
                </div>

                <div class="w-full sm:w-1/2 px-2 mb-4">
                    <div class="bg-[#5F9EF2] rounded-lg p-6 flex items-center justify-between text-white">
                        <div class="flex-1 pr-4">
                            <h1 class="text-xl md:text-2xl font-semibold mb-2">Mengisi Form Izin</h1>
                            <p class="text-sm md:text-base">Pilih tanggal & alasan izin</p>
                        </div>
                        <div class="flex-shrink-0">
                            <img src="{{asset('storage/asset/Forms-cuate.svg')}}" alt="Mengisi Data Diri"
                                class="w-24 md:w-40">
                        </div>
                    </div>
                </div>

                <div class="w-full sm:w-1/2 px-2 mb-4">
                    <div class="bg-[#5F9EF2] rounded-lg p-6 flex items-center justify-between text-white">
                        <div class="flex-1 pr-4">
                            <h1 class="text-xl md:text-2xl font-semibold mb-2">Scan QR Code</h1>
                            <p class="text-sm md:text-base">Untuk verifikasi otomatis</p>
                        </div>
                        <div class="flex-shrink-0">
                            <img src="{{asset('storage/asset/QR Code-amico.svg')}}" alt="Scan QR Code"
                                class="w-20 md:w-40">
                        </div>
                    </div>
                </div>

                <div class="w-full sm:w-1/2 px-2 mb-4">
                    <div class="bg-[#5F9EF2] rounded-lg p-6 flex items-center justify-between text-white">
                        <div class="flex-1 pr-4">
                            <h1 class="text-xl md:text-2xl font-semibold mb-2">Upload Bukti Izin</h1>
                            <p class="text-sm md:text-base">Simpan bukti izin di sistem</p>
                        </div>
                        <div class="flex-shrink-0">
                            <img src="{{asset('storage/asset/Image upload-amico.svg')}}" alt="Scan QR Code"
                                class="w-20 md:w-40">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- section 5 FAQ --}}
    <div class="container mx-auto p-4 mt-8">
        <div class="bg-[#5F9EF2] rounded-2xl p-8 shadow-lg">
            <h1 class="text-white text-2xl md:text-4xl font-bold text-center mb-6">Frequently Asked Questions</h1>

            <div class="space-y-4">
                {{-- FAQ 1 --}}
                <div
                    class="accordion-item border-l-4 border-[#0063CB] shadow-md bg-white rounded-lg overflow-hidden transition-all duration-300">
                    <button
                        class="accordion-header w-full p-4 flex items-center justify-between text-left focus:outline-none">
                        <span class="text-lg font-semibold text-gray-800">Apa itu E-SIS?</span>
                        <span class="accordion-icon bg-[#5F9EF2] p-1.5 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-white transition-transform duration-300" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </button>
                    <div class="accordion-content p-4 text-gray-600 hidden">
                        <p>E-SIS adalah aplikasi berbasis web yang dirancang untuk mempermudah proses pengajuan izin
                            siswa di sekolah secara digital.</p>
                    </div>
                </div>

                {{-- FAQ 2 --}}
                <div
                    class="accordion-item border-l-4 border-[#0063CB] shadow-md bg-white rounded-lg overflow-hidden transition-all duration-300">
                    <button
                        class="accordion-header w-full p-4 flex items-center justify-between text-left focus:outline-none">
                        <span class="text-lg font-semibold text-gray-800">Apa itu E-SIS?</span>
                        <span class="accordion-icon bg-[#5F9EF2] p-1.5 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-white transition-transform duration-300" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </button>
                    <div class="accordion-content p-4 text-gray-600 hidden">
                        <p>E-SIS adalah aplikasi berbasis web yang dirancang untuk mempermudah proses pengajuan izin
                            siswa di sekolah secara digital.</p>
                    </div>
                </div>

                {{-- FAQ 3 --}}
            </div>
        </div>
    </div>

    {{-- section 6 footer --}}
    <footer class="bg-[#5F9EF2] text-black aos-init aos-animate">
        <div class="max-w-7xl mx-auto px-4 py-6 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="flex items-center text-white gap-4 ">
                <img src="{{asset('storage/asset/logo.png')}}" alt="" class="w-12 h-16 mb-4 mt-2 ">
                <p class="text-black">Aplikasi digital untuk mempermudah siswa dalam mengajukan izin sekolah secara
                    cepat, praktis, dan transparan.</p>
            </div>
            <div class="">
                <h1 class="text-black text-2xl font-bold">Custumer Service</h1>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-center gap-2">
                        <img src="https://salmon-rook-410155.hostingersite.com/image/icons/gmail.svg" alt=""
                            class="w-5 h-5">
                        <a href="#" class="hover:underline text-[#223A5E]">Email</a>
                    </li>
                    <li class="flex items-center gap-2">
                        <img src="https://salmon-rook-410155.hostingersite.com/image/icons/whatsapp.svg" alt=""
                            class="w-5 h-5">
                        <a href="#" class="hover:underline text-[#223A5E]">WhatsApp</a>
                    </li>
                    <li class="flex items-center gap-2">
                        <img src="https://salmon-rook-410155.hostingersite.com/image/icons/instagram.svg" alt=""
                            class="w-5 h-5">
                        <a href="https://www.instagram.com/smkn1gunungputri?igsh=aXc3Y2hic2RwN2o4"
                            class="hover:underline text-[#223A5E]">@smkn1gunungputri</a>
                    </li>
                </ul>
            </div>
            <div style="flex:1; min-width:200px;">
                <h3 class="text-black text-2xl font-bold">Jam Layanan</h3>
                <p>Senin - Jumat: 08:00 - 16:00</p>
                <p>Sabtu: 08:00 - 12:00</p>
                <p>Minggu & Libur Nasional: Tutup</p>
            </div>

            <div class="container mx-auto">
                <div class="text-center mt-8 font-medium text-black">
                    <p class="text-sm">© 2025 E-SIS. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>


    <!-- <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.querySelector('.scrolling-container');

            // Kecepatan geser dalam milidetik
            const scrollSpeed = 50;

            // Interval waktu untuk setiap geseran (semakin kecil, semakin cepat)
            const intervalTime = 50;

            let scrollInterval;

            function startAutoScroll() {
                scrollInterval = setInterval(() => {
                    // Geser ke kanan sebanyak 1 piksel
                    container.scrollLeft += 1;

                    // Jika sudah mencapai ujung kanan, kembali ke awal
                    if (container.scrollLeft + container.clientWidth >= container.scrollWidth) {
                        container.scrollLeft = 0;
                    }
                }, intervalTime);
            }

            // Mulai geser otomatis saat halaman dimuat
            startAutoScroll();

            // Hentikan geser saat mouse masuk
            container.addEventListener('mouseenter', () => {
                clearInterval(scrollInterval);
            });

            // Lanjutkan geser saat mouse keluar
            container.addEventListener('mouseleave', () => {
                startAutoScroll();
            });
        });

    </script> -->
</body>

</html>
