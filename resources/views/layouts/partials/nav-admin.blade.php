<!-- Sidebar Admin -->
<aside class="hidden md:block w-64 bg-[#017BFA] text-white min-h-screen flex flex-col">
    <div class="content-image flex items-center justify-center left-0 right-0 mt-4">
        <img src="{{asset('storage/asset/logo.png')}}" alt="" class="w-12 h-16 mb-4 mt-2 ">
    </div>

    <nav class="mt-4 space-y-1 flex-1 p-4">
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center px-4 py-2 text-[#C2E8FF] hover:bg-blue-600 rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : '' }}">
            <i data-lucide="layout-dashboard" class="w-5 h-5 mr-2"></i>
            Dashboard
        </a>

        <a href="{{ route('admin.data-pengguna')}}"
            class="flex items-center px-4 py-2 text-[#C2E8FF] hover:bg-blue-600 rounded-md {{ request()->routeIs('admin.data-pengguna*') ? 'bg-blue-600' : '' }}">
            <i data-lucide="users" class="w-5 h-5 mr-2"></i>
            Data Pengguna
        </a>

        <a href="{{ route('admin.data-kelas')}}"
            class="flex items-center px-4 py-2 text-[#C2E8FF] hover:bg-blue-600 rounded-md {{ request()->routeIs('admin.data-kelas*') ? 'bg-blue-600' : '' }}">
            <i data-lucide="layers" class="w-5 h-5 mr-2"></i>
            Data Kelas
        </a>

        <a href="{{ route('admin.data-jurusan')}}"
            class="flex items-center px-4 py-2 text-[#C2E8FF] hover:bg-blue-600 rounded-md {{ request()->routeIs('admin.data-jurusan*') ? 'bg-blue-600' : '' }}">
            <i data-lucide="book-open" class="w-5 h-5 mr-2"></i>
            Data Jurusan
        </a>

        <a href="{{ route('admin.data-siswa')}}"
            class="flex items-center px-4 py-2 text-[#C2E8FF] hover:bg-blue-600 rounded-md {{ request()->routeIs('admin.data-siswa*') ? 'bg-blue-600' : '' }}">
            <i data-lucide="graduation-cap" class="w-5 h-5 mr-2"></i>
            Data Siswa
        </a>

        <a href="{{ route('admin.data-walikelas')}}"
            class="flex items-center px-4 py-2 text-[#C2E8FF] hover:bg-blue-600 rounded-md {{ request()->routeIs('admin.data-walikelas*') ? 'bg-blue-600' : '' }}">
            <i data-lucide="user-check" class="w-5 h-5 mr-2"></i>
            Data Walikelas
        </a>

        <a href="{{ route('admin.data-petugas')}}"
            class="flex items-center px-4 py-2 text-[#C2E8FF] hover:bg-blue-600 rounded-md {{ request()->routeIs('admin.data-petugas*') ? 'bg-blue-600' : '' }}">
            <i data-lucide="shield" class="w-5 h-5 mr-2"></i>
            Data Petugas
        </a>

        <a href="{{ route('admin.izin.scanner')}}"
            class="flex items-center px-4 py-2 text-[#C2E8FF] hover:bg-blue-600 rounded-md {{ request()->routeIs('admin.izin.scanner') ? 'bg-blue-600' : '' }}">
            <i data-lucide="scan-line" class="w-5 h-5 mr-2"></i>
            Scan Code QR
        </a>

        <a href="{{ route('admin.validasi.index')}}"
            class="flex items-center px-4 py-2 text-[#C2E8FF] hover:bg-blue-600 rounded-md {{ request()->routeIs('admin.validasi*') ? 'bg-blue-600' : '' }}">
            <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
            Validasi Izin
        </a>

        <a href="{{ route('admin.izin.index')}}"
            class="flex items-center px-4 py-2 text-[#C2E8FF] hover:bg-blue-600 rounded-md {{ request()->routeIs('admin.izin*') ? 'bg-blue-600' : '' }}">
            <i data-lucide="file-text" class="w-5 h-5 mr-2"></i>
            Laporan Izin
        </a>
    </nav>

    <div class="p-4 border-t border-blue-600">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 rounded">
                <i data-lucide="log-out" class="w-5 h-5 mr-2"></i>
                Logout
            </button>
        </form>
    </div>
</aside>

{{-- mobile --}}
<aside x-show="sidebarIsOpen" class="relative flex w-full flex-col md:hidden">
    <a class="sr-only" href="#main-content">skip to the main content</a>
    <div x-cloak x-show="sidebarIsOpen" class="fixed inset-0 z-20 bg-surface-dark/10 backdrop-blur-xs md:hidden" aria-hidden="true" x-on:click="sidebarIsOpen = false" x-transition.opacity ></div>

    <nav x-cloak class="fixed left-0 z-40 flex h-svh w-60 shrink-0 flex-col rounded-r-md  bg-[#0E77E4] p-4 transition-transform duration-300 md:w-64 md:translate-x-0 md:relative" x-bind:class="sidebarIsOpen ? 'translate-x-0' : '-translate-x-60'" aria-label="sidebar navigation">

        <div class="content-image flex items-center justify-center left-0 right-0">
        <img src="{{asset('storage/asset/logo.png')}}" alt="" class="w-10 h-12 mb-4 mt-2 ">
        </div>

        <div class="flex flex-col gap-2 overflow-y-auto pb-6">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center px-4 py-2 text-[#C2E8FF] font-semibold hover:bg-blue-600 rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : '' }}">
                <i data-lucide="layout-dashboard" class="w-5 h-5 mr-2"></i>
                Dashboard
            </a>

            <a href="{{ route('admin.data-pengguna')}}"
                class="flex items-center px-4 py-2 text-[#C2E8FF] font-semibold hover:bg-blue-600 {{ request()->routeIs('admin.data-pengguna*') ? 'bg-blue-600' : '' }}">
                <i data-lucide="users" class="w-5 h-5 mr-2"></i>
                Data Pengguna
            </a>

            <a href="{{ route('admin.data-kelas')}}"
                class="flex items-center px-4 py-2 text-[#C2E8FF] font-semibold hover:bg-blue-600 {{ request()->routeIs('admin.data-kelas*') ? 'bg-blue-600' : '' }}">
                <i data-lucide="layers" class="w-5 h-5 mr-2"></i>
                Data Kelas
            </a>

            <a href="{{ route('admin.data-jurusan')}}"
                class="flex items-center px-4 py-2 text-[#C2E8FF] font-semibold hover:bg-blue-600 {{ request()->routeIs('admin.data-jurusan*') ? 'bg-blue-600' : '' }}">
                <i data-lucide="book-open" class="w-5 h-5 mr-2"></i>
                Data Jurusan
            </a>

            <a href="{{ route('admin.data-siswa')}}"
                class="flex items-center px-4 py-2 text-[#C2E8FF] font-semibold hover:bg-blue-600 {{ request()->routeIs('admin.data-siswa*') ? 'bg-blue-600' : '' }}">
                <i data-lucide="graduation-cap" class="w-5 h-5 mr-2"></i>
                Data Siswa
            </a>

            <a href="{{ route('admin.data-walikelas')}}"
                class="flex items-center px-4 py-2 text-[#C2E8FF] font-semibold hover:bg-blue-600 {{ request()->routeIs('admin.data-walikelas*') ? 'bg-blue-600' : '' }}">
                <i data-lucide="user-check" class="w-5 h-5 mr-2"></i>
                Data Walikelas
            </a>

            <a href="{{ route('admin.data-petugas')}}"
                class="flex items-center px-4 py-2 text-[#C2E8FF] font-semibold hover:bg-blue-600 {{ request()->routeIs('admin.data-petugas*') ? 'bg-blue-600' : '' }}">
                <i data-lucide="shield" class="w-5 h-5 mr-2"></i>
                Data Petugas
            </a>

            <a href="{{ route('admin.izin.scanner')}}"
                class="flex items-center px-4 py-2 text-[#C2E8FF] font-semibold hover:bg-blue-600 {{ request()->routeIs('admin.izin.scanner') ? 'bg-blue-600' : '' }}">
                <i data-lucide="scan-line" class="w-5 h-5 mr-2"></i>
                Scan Code QR
            </a>

            <a href="{{ route('admin.validasi.index')}}"
                class="flex items-center px-4 py-2 text-[#C2E8FF] font-semibold hover:bg-blue-600 {{ request()->routeIs('admin.validasi*') ? 'bg-blue-600' : '' }}">
                <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
                Validasi Izin
            </a>

            <a href="{{ route('admin.izin.index')}}"
                class="flex items-center px-4 py-2 text-[#C2E8FF] font-semibold hover:bg-blue-600 {{ request()->routeIs('admin.izin*') ? 'bg-blue-600' : '' }}">
                <i data-lucide="file-text" class="w-5 h-5 mr-2"></i>
                Laporan Izin
            </a>
        </div>

        <div x-data="{ menuIsOpen: false }" class="mt-auto" x-on:keydown.esc.window="menuIsOpen = false">
            <button type="button" class="flex w-full items-center rounded-radius gap-2 p-2 text-left text-on-surface hover:bg-primary/5 hover:text-on-surface-strong focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary dark:text-on-surface-dark dark:hover:bg-primary-dark/5 dark:hover:text-on-surface-dark-strong dark:focus-visible:outline-primary-dark" x-bind:class="menuIsOpen ? 'bg-primary/10 dark:bg-primary-dark/10' : ''" aria-haspopup="true" x-on:click="menuIsOpen = ! menuIsOpen" x-bind:aria-expanded="menuIsOpen">
                {{-- <img src="https://penguinui.s3.amazonaws.com/component-assets/avatar-7.webp" class="size-8 object-cover rounded-radius" alt="avatar" aria-hidden="true"/> --}}
                <i data-lucide="user-circle" class="w-8 h-8"></i>
                <div class="flex flex-col">
                    <span class="text-sm font-bold text-on-surface-strong dark:text-on-surface-dark-strong">{{ Auth::user()->nama }}</span>
                    {{-- <span class="w-32 overflow-hidden text-ellipsis text-xs md:w-36" aria-hidden="true">@alexmartinez</span> --}}
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2" class="ml-auto size-4 shrink-0 rotate-0" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                </svg>
            </button>

            <!-- menu -->
            <div x-cloak x-show="menuIsOpen" class="absolute z-20 -mr-1 w-48  -right-44 bottom-0" role="menu" x-on:click.outside="menuIsOpen = false" x-on:keydown.down.prevent="$focus.wrap().next()" x-on:keydown.up.prevent="$focus.wrap().previous()" x-transition="" x-trap="menuIsOpen">
                <div class="p-2 border-blue-600 text-white">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-1 p-2 bg-red-600 hover:bg-red-700 rounded">
                            <i data-lucide="log-out" class="w-5 h-5 mr-2"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</aside>
