<!-- Sidebar User -->
<header class="bg-[#017BFA] text-white hidden md:block">
    <div class="container mx-auto px-4 py-3 flex items-center justify-between">
        <!-- Logo -->
        <div class="content-image flex items-center">
            <img src="{{asset('storage/asset/logo.png')}}" alt="" class="w-10 h-12 mb-4 mt-2 ">
            {{-- <h1 class="text-white text-2xl font-extrabold">e-SIS</h1> --}}
        </div>

        <nav class="hidden md:flex flex-1 justify-center space-x-6">
            <a href="{{ route('siswa.dashboard') }}" class="py-2 hover:underline">Dashboard</a>
            <a href="{{ route('izin.index') }}" class="py-2 hover:underline">Ajukan Izin</a>
            <a href="{{ route('izin.riwayat') }}" class="py-2 hover:underline">Riwayat</a>
            <a href="{{ route('siswa.profil') }}" class="py-2 hover:underline">Profile</a>
        </nav>

        <div class="flex justify-between ">
            <div class="flex flex-2  py-2 gap-4">
                {{-- notifikasi --}}
                <div class="relative mt-2">
                    <!-- Tombol Notifikasi -->
                    <a href="{{ route('siswa.profil.notifikasi') }}" class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-bell">
                            <path d="M10.268 21a2 2 0 0 0 3.464 0" />
                            <path
                                d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326" />
                        </svg>

                        <!-- Badge Notifikasi -->
                        @php
                        // Contoh jumlah notifikasi dari controller
                        $jumlahNotifikasi = $jumlahNotifikasi ?? 3; // Ganti nanti dengan variabel dari controller
                        @endphp

                        @if($jumlahNotifikasi > 0)
                        <span
                            class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                            {{ $jumlahNotifikasi }}
                        </span>
                        @endif
                    </a>
                </div>

                {{-- profile --}}
                <div class="flex items-center gap-2">
                    <a href="{{ route('siswa.profil') }}" class="flex items-center gap-2">
                        <img src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : asset('storage/asset/defaultjpg.jpg') }}"
                            class="w-8 h-8 mx-auto rounded-full object-cover" alt="foto siswa">
                        <span class="text-center py-2">{{ Auth::user()->nama }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

{{-- MOBILE --}}
<nav
    class="md:hidden fixed bottom-1 left-0 right-0 flex justify-around py-2 rounded-[50px] shadow-lg bg-white text-gray-800">

    <!-- Menu user nanti -->
    <a href="{{ route('siswa.dashboard') }}"
        class="flex flex-col items-center text-gray-700 {{ request()->routeIs('siswa.dashboard') ? 'text-blue-700 ' : 'hover:text-blue-700' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-house"
            viewBox="0 0 16 16">
            <path
                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
        </svg>
        Dashboard</a>
    <a href="{{ route('izin.index') }}"
        class="flex flex-col items-center text-gray-700 {{ request()->routeIs('izin.create') ?  'text-blue-700 ' : 'hover:text-blue-700'}}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-envelope-plus"
            viewBox="0 0 16 16">
            <path
                d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z" />
            <path
                d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1v-1a.5.5 0 0 0-.5-.5" />
        </svg>
        Ajukan Izin</a>
    <a href="{{ route('izin.riwayat') }}"
        class="flex flex-col items-center text-gray-700 {{ request()->routeIs('izin.riwayat') ? 'text-blue-700 ' : 'hover:text-blue-700'}}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-clock-history"
            viewBox="0 0 16 16">
            <path
                d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z" />
            <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z" />
            <path
                d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5" />
        </svg>
        Riwayat Izin</a>
    <a href="{{ route('siswa.profil') }}"
        class="flex flex-col items-center text-gray-700 {{ request()->routeIs('siswa.profil') ? 'text-blue-700 ' : 'hover:text-blue-700'}}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person"
            viewBox="0 0 16 16">
            <path
                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
        </svg>
        Profil</a>
</nav>


