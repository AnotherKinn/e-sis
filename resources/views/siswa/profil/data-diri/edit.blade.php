@extends('siswa.profil.index')

{{-- desktop --}}
@section('profile_content_desktop')
    <div class="max-w-3xl mx-auto hidden md:block" x-data="{ open: false, preview: null }">
        <h1 class="text-2xl font-bold mb-6 text-[#052356] text-center">
            Ubah Data Diri
        </h1>

        <form action="{{ route('siswa.profil.data-diri.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="relative w-40 mx-auto">
                @if($user->foto)
                <div class="mt-2">
                    <img src="{{ $user->foto ? asset('storage/'.$user->foto) : asset('asset/defaultjpg.jpg') }}"
                    alt="Foto Profil"
                    class="w-24 h-24 mx-auto mt-6 rounded-full border object-cover"
                    x-bind:src="preview ? preview : '{{ $user->foto ? asset('storage/'.$user->foto) : asset('asset/defaultjpg.jpg') }}'">
                </div>
                @else
                    <img src="{{ asset('storage/asset/defaultjpg.jpg') }}"
                            class="w-24 h-24 mx-auto mt-6 rounded-full border object-cover"
                            alt="Foto Default">
                @endif
                {{-- <label class="block text-sm font-medium text-gray-700 text-center">Ganti Foto Profil
                <input type="file" name="foto"
                    class=" hidden mt-1  w-full text-sm text-gray-700 dark:text-gray-200 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                </label> --}}

                <button type="button" @click="open= true"
                    class="absolute bottom-8 right-8 text-[#73A5D9] text-xl bg-white rounded-full p-1 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-square-pen-icon lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/>
                    </svg>
                </button>
                <div class="text-center">
                    <button type="button" @click="open= true" class="text-sm font-medium text-gray-700 mt-2 text-center justify-center">
                        Ganti Foto Profil
                    </button>
                </div>
            </div>

            {{-- modal --}}
            <div x-show="open"
             x-cloak
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-600 bg-opacity-75  flex items-center justify-center z-50 transition-opacity duration-300">

                <div @click.away="open = false" class="bg-white rounded-lg shadow-xl w-full max-w-sm p-6 transform transition-all duration-300">

                    <div class="flex justify-between items-start pb-3 border-b-2">
                        <h3 class="text-lg text-gray-700 font-semibold">Upload Foto</h3>
                        <button type="button" @click="open = false" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>

                        <template x-if="preview">
                            <div class="mt-4 flex justify-center">
                                <img :src="preview"
                                    class="w-32 h-32 rounded-full border object-cover shadow">
                            </div>
                        </template>

                        <div>
                            <label class="block text-sm font-medium text-[#052356] mt-3">Upload foto</label>
                            <input type="file" name="foto"
                                @change="preview = URL.createObjectURL($event.target.files[0])"
                                class="mt-1 w-full text-sm bg-[#E8EDEF] text-black border border-[#acbdcf] p-2 rounded-sm shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                        </div>

                        <div class="pt-4 ">
                            <button type="button" @click="open = false" class="p-2 w-full rounded-md text-center text-md text-white bg-[#0063CB] hover:bg-[#023f80]">
                                Pilih
                            </button>
                        </div>

                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-[#E8EDEF] text-[30F2D5F]" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-[#E8EDEF] text-[30F2D5F]" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <select name="jenis_kelamin"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-[#E8EDEF] text-[30F2D5F]">
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki" {{ $siswa->jenis_kelamin === 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                    </option>
                    <option value="Perempuan" {{ $siswa->jenis_kelamin === 'Perempuan' ? 'selected' : '' }}>Perempuan
                    </option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Nomor HP</label>
                <input type="text" name="nomor_hp" value="{{ old('nomor_hp', $siswa->nomor_hp) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-[#E8EDEF] text-[30F2D5F]" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Kelas</label>
                <select name="kelas_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-[#E8EDEF] text-[30F2D5F]">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($kelas as $k)
                    <option value="{{ $k->id }}" {{ $siswa->kelas_id == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kelas }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Jurusan</label>
                <select name="jurusan_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-[#E8EDEF] text-[30F2D5F]">
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach ($jurusan as $j)
                    <option value="{{ $j->id }}" {{ $siswa->jurusan_id == $j->id ? 'selected' : '' }}>
                        {{ $j->nama_jurusan }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end gap-3 mt-3">
                <a href="{{ route('siswa.profil.data-diri') }}"
                    class="px-6 py-2 border border-[#224779] text-[#224779] rounded-lg hover:bg-[#224779] hover:text-white">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection


    {{-- mobile --}}
@section('profile_content_mobile')
    <div class="md:hidden" x-data="{ open: false }" >
        <div class="w-full h-[70px] bg-[#5F9EF2] rounded-b-lg p-6 text-center fixed top-0 right-0 left-0 text-white flex">
            <a href="{{route("siswa.profil.data-diri")}}">
                <div class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left-icon lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg>
                </div>
            </a>
            <h1 class="absolute left-1/2 -translate-x-1/2 text-xl font-bold text-white">
                Ubah Data Diri
            </h1>
        </div>


    <form action="{{ route('siswa.profil.data-diri.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4 bg-[#CDE1FB] p-4 mt-16 rounded-lg">
            @csrf
            @method('PUT')

            <div >
                @if($user->foto)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profil"
                        class="w-24 h-24 mx-auto mt-6 rounded-full border-white">
                </div>
                @else
                    <img src="{{ asset('storage/asset/defaultjpg.jpg') }}"
                            class="w-24 h-24 mx-auto mt-6 rounded-full border-white"
                            alt="Foto Default">
                @endif
                {{-- <label class="block text-sm font-medium text-gray-700 text-center">Ganti Foto Profil
                <input type="file" name="foto"
                    class=" hidden mt-1  w-full text-sm text-gray-700 dark:text-gray-200 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                </label> --}}

                <button type="button" @click="open= true"
                    class="absolute bottom-2/3 right-[40%] text-[#73A5D9] text-xl bg-white rounded-full p-1 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-square-pen-icon lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/>
                    </svg>
                </button>

                <div class="text-center">
                    <button type="button" @click="open= true" class="text-sm font-medium text-gray-700 mt-2 text-center">
                        Ganti Foto Profil
                    </button>
                </div>
            </div>

            {{-- modal --}}
            <div x-show="open"
             x-cloak
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-600 bg-opacity-75  flex items-center justify-center z-50 transition-opacity duration-300">

                <div @click.away="open = false" class="bg-white rounded-lg shadow-xl w-full max-w-sm p-6 transform transition-all duration-300">

                    <div class="flex justify-between items-start pb-3 border-b-2">
                        <h3 class="text-lg text-gray-700 font-semibold">Upload Foto</h3>
                        <button type="button" @click="open = false" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>

                        <template x-if="preview">
                            <div class="mt-4 flex justify-center">
                                <img :src="preview"
                                    class="w-32 h-32 rounded-full border object-cover shadow">
                            </div>
                        </template>

                        <div>
                            <label class="block text-sm font-medium text-[#052356] mt-3">Upload foto</label>
                            <input type="file" name="foto"
                                @change="preview = URL.createObjectURL($event.target.files[0])"
                                class="mt-1 w-full text-sm bg-[#E8EDEF] text-black border border-[#acbdcf] p-2 rounded-sm shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                        </div>

                        <div class="pt-4 ">
                            <button type="button" @click="open = false" class="p-2 w-full rounded-md text-center text-md text-white bg-[#0063CB] hover:bg-[#023f80]">
                                Pilih
                            </button>
                        </div>

                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#052356]">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white text-[30F2D5F]" />
            </div>

            <div>
                <label class="block text-sm font-medium text-[#052356]">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white text-[30F2D5F]" />
            </div>

            <div>
                <label class="block text-sm font-medium text-[#052356]">Jenis Kelamin</label>
                <select name="jenis_kelamin"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white text-[30F2D5F]">
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki" {{ $siswa->jenis_kelamin === 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                    </option>
                    <option value="Perempuan" {{ $siswa->jenis_kelamin === 'Perempuan' ? 'selected' : '' }}>Perempuan
                    </option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#052356]">Nomor HP</label>
                <input type="text" name="nomor_hp" value="{{ old('nomor_hp', $siswa->nomor_hp) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white text-[30F2D5F]" />
            </div>

            <div>
                <label class="block text-sm font-medium text-[#052356]">Kelas</label>
                <select name="kelas_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white text-[30F2D5F]">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($kelas as $k)
                    <option value="{{ $k->id }}" {{ $siswa->kelas_id == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kelas }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#052356]">Jurusan</label>
                <select name="jurusan_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white text-[30F2D5F]">
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach ($jurusan as $j)
                    <option value="{{ $j->id }}" {{ $siswa->jurusan_id == $j->id ? 'selected' : '' }}>
                        {{ $j->nama_jurusan }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-between gap-3">
                <a href="{{ route('siswa.profil.data-diri') }}"
                    class="px-6 py-2 border border-[#224779] text-[#224779] rounded-lg hover:bg-[#224779] hover:text-white">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection
