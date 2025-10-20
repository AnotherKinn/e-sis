@extends('siswa.profil.index')
@section('profile_content_desktop')
    @include('siswa.profil.data-diri.desktop-content')
@endsection

    {{-- mobile --}}
    @section('profile_content_mobile')
        <div class="md:hidden flex flex-col overflow-y-auto pb-24">
            <div class=" w-full h-[70px] bg-[#5F9EF2] rounded-b-lg p-6 text-white flex text-center fixed top-0 right-0 left-0 z-10">
                <a href="{{route("siswa.profil")}}">
                    <div class="absolute">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left-icon lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg>
                    </div>
                </a>

                <h1 class="absolute left-1/2 -translate-x-1/2 text-xl font-bold text-white">
                    Data Diri
                </h1>
            </div>
            <div class="px-4">
                <div class="w-full h-36 rounded-b-lg py-6 text-center text-white top-0 right-0 left-0 mb-8">
                    @if ($user->foto)
                        <img src="{{ asset('storage/' . $user->foto) }}" class="w-20 h-20 mx-auto mt-6 rounded-full border-2 border-white" alt="foto siswa">
                    @else
                        <img src="{{ asset('storage/asset/defaultjpg.jpg') }}"
                                class="w-20 h-20 mx-auto mt-6 rounded-full border-2 border-white"
                                alt="Foto Default">
                    @endif

                    <h2 class="mt-3 font-semibold text-lg text-[#356676]">{{$user->nama}}</h2>
                    <p class="font-semibold text-[#052356]">{{ $user->nis }}</p>
                </div>

                <div class="bg-[#CDE1FB] rounded-lg shadow p-6 space-y-4 mt-12">
                    <div>
                        <p class="text-md text-[#0F2D5F] font-bold">Tempat, Tanggal Lahir</p>
                        <p class="font-semibold text-[#052356]">
                            {{ $siswa?->tempat_lahir ?? '-' }},
                            {{ $siswa?->tanggal_lahir ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d M Y') : '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-md text-[#0F2D5F] font-bold">Jenis Kelamin</p>
                        <p class="font-semibold text-[#052356]">{{ $siswa?->jenis_kelamin ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-md text-[#0F2D5F] font-bold">Nomor HP</p>
                        <p class="font-semibold text-[#052356]">{{ $siswa?->nomor_hp ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-md text-[#0F2D5F] font-bold">Kelas</p>
                        <p class="font-semibold text-[#052356]">{{ $siswa?->kelas?->nama_kelas ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-md text-[#0F2D5F] font-bold">Jurusan</p>
                        <p class="font-semibold text-[#052356]">{{ $siswa?->jurusan?->nama_jurusan ?? '-' }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('siswa.profil.data-diri.edit') }}"
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                        Ubah Data Diri
                    </a>
                </div>
            </div>
        </div>
    @endsection
