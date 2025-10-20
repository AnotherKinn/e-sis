<x-app-layout>
    <div class="p-6">
        <div>
            <h1 class="text-xl font-bold mb-4 text-[#224779]">Daftar Menunggu Validasi</h1>
            <hr class="border-1 border-[#224779]">
        </div>

        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($izinList->isEmpty())
            <p class="text-gray-600">Tidak ada izin yang menunggu validasi.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-8">
                @foreach($izinList as $izin)
                    <div class="bg-white p-5 md:p-6 rounded-xl shadow-lg border-l-4 border-[#017BFA]">
                        <div class="space-y-2 text-md">
                            <h2 class="font-bold text-lg mb-2">{{ $izin->user->nama }}</h2>
                            <hr class="b-2 mb-2 mt-2">

                            <p class="flex items-center">
                                <strong class="text-md w-28">Kelas:</strong> {{ $izin->walikelas->kelas->nama_kelas ?? '-' }}
                            </p>
                            <p class="flex items-center">
                                <strong class="text-md w-28">Jenis Izin:</strong> {{ ucfirst($izin->jenis_izin) }}
                            </p>
                            <p class="flex items-center">
                                <strong class="text-md w-28">Tanggal:</strong> {{ $izin->tanggal }}
                            </p>
                            <p class="flex items-center">
                                <strong class="text-md w-28">Jam Keluar:</strong> {{ $izin->jam_keluar }}
                            </p>
                        </div>

                        <hr class="b-2 mb-2 mt-2">

                        <div class="flex justify-end">
                            <a href="{{ route('admin.validasi.show', $izin->id) }}"
                            class="mt-3 inline-block px-3 py-2 bg-blue-600 text-white rounded">
                                Validasi Sekarang
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
