<div class="max-w-3xl mx-auto ">
        {{-- <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">
            Data Diri
        </h1> --}}

        <div class="w-full h-36 rounded-b-lg py-6 text-center text-white -top-3 right-0 left-0 mb-8">
            <div>
                @if ($user->foto)
                <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profil"
                    class="w-24 h-24 mx-auto mt-6 rounded-full" alt="foto siswa">
                @else
                <img src="{{ asset('storage/asset/defaultjpg.jpg') }}"
                        class="w-24 h-24 mx-auto mt-6 rounded-full"
                        alt="Foto Default">
                </div>
                @endif
            </div>
            <div class="mt-3">
                <p class="text-xl font-extrabold text-[#052356] text-center">{{ $user->nama }}</p>
                {{-- <p class="text-gray-500">{{ $user->nis }}</p> --}}
            </div>
        </div>


        <div class=" rounded-lg mt-12 shadow p-6 space-y-4">
            {{--<div>
                <p class="text-sm text-gray-500">Nama</p>
                <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $user->nama }}</p>
            </div>--}}
            <div>
                <p class="text-sm font-semibold text-[#113F67]">NIS</p>
                <p class="font-extrabold text-[#052356]">{{ $user->nis }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-[#113F67]">Tempat, Tanggal Lahir</p>
                <p class="font-extrabold text-[#052356]">
                    {{ $siswa?->tempat_lahir ?? '-' }},
                    {{ $siswa?->tanggal_lahir ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d M Y') : '-' }}
                </p>
            </div>
            <div>
                <p class="text-sm font-semibold text-[#113F67]">Jenis Kelamin</p>
                <p class="font-extrabold text-[#052356]">{{ $siswa?->jenis_kelamin ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-[#113F67]">Nomor HP</p>
                <p class="font-extrabold text-[#052356]">{{ $siswa?->nomor_hp ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-[#113F67]">Kelas</p>
                <p class="font-extrabold text-[#052356]">{{ $siswa?->kelas?->nama_kelas ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-[#113F67]">Jurusan</p>
                <p class="font-extrabold text-[#052356]">{{ $siswa?->jurusan?->nama_jurusan ?? '-' }}
                </p>
            </div>
        </div>

        <div class="mt-6 mb-2">
            <a href="{{ route('siswa.profil.data-diri.edit') }}"
                class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                Ubah Data Diri
            </a>
        </div>
</div>
