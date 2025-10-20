<x-app-layout>
    <div class="container mx-auto mt-6 md:mt-0 p-0 hidden md:block">
        <div class="hidden md:flex min-h-[70vh] bg-white rounded-lg shadow-xl">
            {{-- samping kiri --}}
            <div class="bg-[#5F9EF2] flex flex-col w-1/4 items-center rounded-lg p-6 ">
                <div class="relative w-40">
                    @if ($user->foto)
                    <img src="{{ asset('storage/' . $user->foto) }}" class="w-40 h-40 mx-auto mt-6 rounded-full"
                        alt="foto siswa">
                    @else
                    <img src="{{ asset('storage/asset/defaultjpg.jpg') }}"
                        class="w-40 h-40 mx-auto mt-6 rounded-full object-cover border-4 border-gray-300 bg-gray-100"
                        alt="Foto Default">
                    @endif
                    <a href="{{ route('siswa.profil.data-diri.edit')}}"
                        class="absolute bottom-2 right-3 text-[#73A5D9] text-xl bg-[#C3D8F0] rounded-full p-2 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-square-pen-icon lucide-square-pen">
                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                            <path
                                d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                        </svg>
                    </a>
                </div>

                <h2 class="mt-3 font-bold text-xl justify-center text-[#052356]">{{ Auth::user()->nama }}</h2>
                <h2 class="mt-2 font-semibold text-lg text-[#052356]">{{ $user->nis }}</h2>

                <!-- Logout -->
                <div class="mt-auto mb-6 w-3/4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full px-6 py-3 border border-red-700 hover:bg-red-600 text-red-600 hover:text-white rounded-lg shadow transition">
                            <i class="bi bi-box-arrow-right"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
            {{-- konten kanan --}}
            <div class="flex-1 p-6">
                {{-- navigasi --}}
                <header class="mb-6">
                    <div class="flex space-x-9 border-b-2 border-gray-200">
                        <a href="{{ route('siswa.profil.data-diri')}}"
                            class="pb-2 text-base font-semibold {{ request()->routeIs('siswa.profil.data-diri') ? 'border-b-2 border-[#5F9EF2] text-[#5F9EF2]' : 'text-gray-500 hover:text-[#5F9EF2]' }}">Data
                            Diri</a>
                        <a href="{{ route('siswa.profil.pengaturan.password.edit')}}"
                            class="pb-2 text-base font-semibold {{ request()->routeIs('siswa.profil.pengaturan.password.edit') ? 'border-b-2 border-[#5F9EF2] text-[#5F9EF2]' : 'text-gray-500 hover:text-[#5F9EF2]' }}">Password</a>
                        <a href="{{ route('siswa.profil.walikelas')}}"
                            class="pb-2 text-base font-semibold {{ request()->routeIs('siswa.profil.walikelas') ? 'border-b-2 border-[#5F9EF2] text-[#5F9EF2]' : 'text-gray-500 hover:text-[#5F9EF2]' }}">Walikelas</a>
                        <a href="{{ route('siswa.profil.notifikasi')}}"
                            class="pb-2 text-base font-semibold {{ request()->routeIs('siswa.profil.notifikasi') ? 'border-b-2 border-[#5F9EF2] text-[#5F9EF2]' : 'text-gray-500 hover:text-[#5F9EF2]' }}">Notifikasi</a>
                    </div>
                    <hr class="border-1 border-[#224779]">
                </header>

                {{-- content --}}
                <div class="bg-[#CDE1FB] mt-6 p-4 rounded-lg shadow-md w-auto">
                    @if (Route::currentRouteName() === 'siswa.profil')
                    @include('siswa.profil.data-diri.desktop-content')
                    @else
                    @yield('profile_content_desktop')
                    @endif

                </div>
            </div>

        </div>
        {{-- <div class="grid gap-4 mt-8">
                <!-- Data Diri -->
                <a href="{{ route('siswa.profil.data-diri') }}"
        class="block px-6 py-4 bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-md transition">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Data Diri</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Lihat dan ubah informasi biodata diri seperti tanggal lahir, kelas, jurusan, dll.
        </p>
        </a>

        <!-- Pengaturan -->
        <a href="{{ route('siswa.profil.pengaturan') }}"
            class="block px-6 py-4 bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-md transition">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Pengaturan</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Ubah password, mode tampilan aplikasi, font, dan pengaturan lainnya.
            </p>
        </a>

        <!-- Wali Kelas -->
        <a href="{{ route('siswa.profil.walikelas') }}"
            class="block px-6 py-4 bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-md transition">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Wali Kelas</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Lihat detail wali kelas Anda atau pilih wali kelas jika belum ditentukan.
            </p>
        </a>
    </div> --}}
    </div>

    @if (Route::currentRouteName() === 'siswa.profil')
    {{-- mobile --}}
    <div class="md:hidden flex flex-col overflow-y-auto pt-0 pb-24">
        <div class="bg-[#5F9EF2] w-full h-16 rounded-b-lg p-6 text-center fixed top-0 right-0 left-0 z-10 text-white">
            <h1 class="text-xl font-bold mb-6 text-white">
                Profil Siswa
            </h1>
        </div>
        <div class="px-4">
            <div class="w-full h-36 rounded-b-lg py-6 text-center text-white top-0 right-0 left-0 mt-2">
                @if ($user->foto)
                <img src="{{ asset('storage/' . $user->foto) }}" class="w-20 h-20 mx-auto mt-6 rounded-full object-cover"
                    alt="foto siswa">
                @else
                <img src="{{ asset('storage/asset/defaultjpg.jpg') }}" class="w-20 h-20 mx-auto mt-6 rounded-full"
                    alt="Foto Default">
                @endif

                <h2 class="mt-3 font-semibold text-lg text-[#356676] text-center">{{ Auth::user()->nama }}</h2>
            </div>

            <div class="mt-10 space-y-3 bg-white p-4 rounded-md">
                <!-- Data Diri -->
                <a href="{{ route('siswa.profil.data-diri') }}" class="block px-6 py-4 rounded-xl shadow hover:shadow-md">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-person-gear text-[#73A5D9] text-xl bg-[#C3D8F0] rounded-full p-1"
                                viewBox="0 0 16 16">
                                <path
                                    d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0" />
                            </svg>
                            <h2 class="text-lg font-semibold text-[#5482B3]">Data Diri</h2>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor"
                            class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                        </svg>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Lihat dan ubah informasi biodata diri.
                    </p>
                </a>

                <!-- Pengaturan -->
                {{-- <a href="{{ route('siswa.profil.pengaturan') }}"
                class="block px-6 py-4 rounded-xl shadow hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                            class="bi bi-gear text-[#73A5D9] text-xl bg-[#C3D8F0] rounded-full p-1" viewBox="0 0 16 16">
                            <path
                                d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0" />
                            <path
                                d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z" />
                        </svg>
                        <h2 class="text-lg font-semibold text-[#5482B3]">Pengaturan</h2>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor"
                        class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                    </svg>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Ubah mode tampilan dan Font.
                </p>
                </a> --}}

                <a href="{{ route('siswa.profil.pengaturan.password.edit') }}"
                    class="block px-6 py-4  rounded-xl shadow hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-lock-keyhole-icon lucide-lock-keyhole text-[#73A5D9] text-xl bg-[#C3D8F0] rounded-full p-1">
                                <circle cx="12" cy="16" r="1" />
                                <rect x="3" y="10" width="18" height="12" rx="2" />
                                <path d="M7 10V7a5 5 0 0 1 10 0v3" /></svg>
                            <h2 class="text-lg font-semibold text-[#5482B3]">Password</h2>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor"
                            class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                        </svg>
                    </div>

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Ubah password.
                    </p>

                </a>

                <!-- Wali Kelas -->
                <a href="{{ route('siswa.profil.walikelas') }}"
                    class="block px-6 py-4  rounded-xl shadow hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-whatsapp text-[#73A5D9] text-xl bg-[#C3D8F0] rounded-full p-1"
                                viewBox="0 0 16 16">
                                <path
                                    d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                            </svg>
                            <h2 class="text-lg font-semibold text-[#5482B3]">Wali Kelas</h2>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor"
                            class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                        </svg>
                    </div>

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Lihat detail wali kelas Anda.
                    </p>

                </a>


            </div>

            <!-- Logout -->
            <div class="mt-8">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full px-6 py-3 border border-red-700 hover:bg-red-600 text-red-600 hover:text-white rounded-lg shadow transition">
                        <i class="bi bi-box-arrow-right"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endif
    @yield('profile_content_mobile')

</x-app-layout>
