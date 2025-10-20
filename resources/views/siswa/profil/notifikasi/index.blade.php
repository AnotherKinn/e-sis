@extends('siswa.profil.index')

@section('profile_content_desktop')
    <div class="container mx-auto mt-6 md:mt-0 p-0 hidden md:block">
        <h1 class="text-2xl font-bold mb-6 text-[#052356] border-b-2 border-[#052356]">
            Notifikasi
        </h1>

    </div>

    {{-- Notifikasi Card  --}}
    <div class="w-full mb-4 p-6 bg-white border border-gray-200 rounded-md shadow-sm
                hover:shadow-lg hover:border-[#94baec] transition duration-300 relative
                group cursor-pointer">

        {{-- Flexbox Horizontal --}}
        <div class="flex items-start justify-between gap-6">

            {{--Ikon dan Teks --}}
            <div class="flex items-start gap-4 flex-grow">

                <div class="p-2 bg-green-100 rounded-full w-12 h-12 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
                </div>

                <div class="flex flex-col">
                    <h2 class="text-lg font-bold text-gray-800 group-hover:text-[#5F9EF2]">
                        Izin Selesai
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">
                        Izin sudah divalidasi oleh petugas.
                    </p>
                </div>
            </div>

            {{-- Kanan: Tanggal Validasi --}}
            <div class="text-right flex-shrink-0">
                <span class="text-base font-semibold text-gray-700">10:30 AM</span>
                <p class="text-sm text-gray-500 mt-0.5">
                    18 Sept 2025
                </p>
            </div>

        </div>

        {{-- Efek Garis Ungu saat Hover --}}
        <div class="absolute inset-y-0 left-0 w-1 bg-transparent group-hover:bg-[#5F9EF2] rounded-l-full transition-all duration-300"></div>

    </div>
@endsection
