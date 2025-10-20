<x-app-layout>
    <div class="p-6 text-white hidden md:block" x-data="{ open: false }">
        <div class="bg-white p-10 rounded-xl">
            <h1 class="text-xl font-bold mb-4 text-[#224779] text-center">Upload Bukti Izin</h1>
            <hr class="border-1 border-[#224779]">

            <div class="flex-1 flex gap-8">
                <div class="flex-1 w-1/2 space-y-6 p-8">
                    <div class="bg-white mt-6 p-6 rounded-lg shadow-md w-auto">
                        @if(session('success'))
                            <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif
                        <h1 class="text-[#052356] font-bold text-2xl">Informasi Izin</h1>
                        <div class="mt-3">
                                <p class="text-[#052356] text-lg"><strong>Nama:</strong> {{$izin->user->nama}}</p>
                                <p class="text-[#052356] text-lg"><strong>NIS:</strong> {{$izin->user->nis}}</p>
                                <p class="text-[#052356] text-lg"><strong>Jenis Izin:</strong> {{ ucfirst($izin->jenis_izin) }}</p>
                                <p class="text-[#052356] text-lg"><strong>Keterangan:</strong> {{ $izin->keterangan }}</p>
                        </div>
                    </div>

                    <div class="bg-white mt-6 p-6 rounded-lg shadow-md">
                        @if($izin->bukti_izin)
                            <div class="mt-4">
                                <p class="font-semibold text-black text-2xl">Bukti sudah diunggah:</p>
                                <img src="{{ asset('storage/' . $izin->bukti_izin) }}"
                                    alt="Bukti Izin" class="w-40 border rounded">
                                {{-- <p class="">Bukti berhasil diunggah, silakan menunggu <br> validasi petugas</p> --}}
                            </div>
                        @else
                            <form action="{{ route('izin.upload', $izin->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                                @csrf
                                <label class="block mb-2 font-semibold text-[#052356]">Upload Bukti (jpg, png):</label>
                                <input type="file" name="bukti_izin" class="border p-2 w-full bg-[#E8EDEF] text-black rounded-lg @error('bukti_izin') border-red-500 @enderror">
                                @error('bukti_izin')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror

                                <div class="flex justify-end">
                                    <button type="submit" class="mt-4 w-full px-4 py-2 bg-[#5482B3] hover:bg-[#3e6186] text-white rounded-lg">
                                    Upload
                                </button>
                                </div>

                            </form>
                        @endif
                    </div>
                </div>
                {{-- ilustrasi --}}
                <div class="flex-shrink-0 md:w-1/2 lg:w-1/3 flex items-center justify-center">
                    {{-- <img src="{{ asset('storage/asset/undraw_attached-file_j0t2.svg') }}"
                        alt="Ilustrasi Upload Bukti" class="w-full max-w-sm"> --}}
                    @if ($izin->bukti_izin)
                        {{-- jika sudah upload --}}
                        <img src="{{ asset('storage/asset/sukses.png') }}"
                        alt="Ilustrasi Upload Bukti" class=" max-w-sm">
                    @else
                        {{-- belum upload --}}
                        <img src="{{ asset('storage/asset/upload.png') }}"
                        alt="Ilustrasi Upload Bukti" class="max-w-sm">
                    @endif
                </div>

            </div>
        </div>

    </div>

    {{-- mobile --}}
    <div class="p-6 text-white md:hidden">
        <div class="bg-[#0063CB] w-full h-[70px] rounded-b-lg p-6 fixed top-0 right-0 left-0 text-center text-white">
            <h1 class="text-xl font-bold mb-4">Upload Bukti Izin</h1>
        </div>

        <div class="bg-white mt-10 p-6 rounded-lg shadow-md">
            @if(session('success'))
                <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <h1 class="text-[#052356] font-bold text-xl">Informasi Izin</h1>
           <div class="mt-3">
                <p class="text-[#052356]"><strong>Nama:</strong>{{$izin->user->nama}}</p>
                <p class="text-[#052356]"><strong>NIS:</strong>{{$izin->user->nis}}</p>
                <p class="text-[#052356]"><strong>Jenis Izin:</strong> {{ ucfirst($izin->jenis_izin) }}</p>
                <p class="text-[#052356]"><strong>Keterangan:</strong> {{ $izin->keterangan }}</p>
           </div>

        </div>

        <div class="bg-white mt-6 p-5 rounded-lg shadow-md">
            @if($izin->bukti_izin)
                <div class="mt-2">
                    <p class="font-semibold text-[#052356]">Bukti sudah diunggah:</p>
                    <img src="{{ asset('storage/' . $izin->bukti_izin) }}"
                        alt="Bukti Izin" class="w-48 border rounded">
                </div>
            @else
                <form action="{{ route('izin.upload', $izin->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    <label class="block mb-2 font-semibold text-[#052356]">Upload Bukti (jpg, png):</label>
                    <input type="file" name="bukti_izin" class="border p-2 w-full bg-[#E8EDEF] text-black rounded-lg @error('bukti_izin') border-red-500 @enderror">
                    @error('bukti_izin')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div class="flex justify-end">
                        <button type="submit" class="mt-4 w-full px-4 py-2 bg-[#5482B3] hover:bg-[#3e6186] text-white rounded-lg">
                        Upload
                    </button>
                    </div>

                </form>
            @endif
        </div>

    </div>
</x-app-layout>
