@extends('siswa.profil.index')


{{-- desktop --}}
@section('profile_content_desktop')
<div class="max-w-lg mx-auto hidden md:block">
    <h1 class="text-2xl font-bold mb-6 text-[#052356] text-center">
        Ubah Password
    </h1>

    @if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('siswa.profil.pengaturan.password.update') }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Password Lama --}}
        <div>
            <label class="block text-sm font-medium text-[#052356]">Password Lama</label>
            <div class="relative">
                <input type="password" id="old_password" name="old_password"
                    class="password-input mt-1 block w-full pr-10 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-[#E8EDEF] text-[#052356]"
                    required>
                <button type="button" onclick="togglePassword('old_password', this)"
                    class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" id="eye-icon" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye">
                        <path
                            d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Password Baru --}}
        <div>
            <label class="block text-sm font-medium text-[#052356]">Password Baru</label>
            <div class="relative">
                <input type="password" id="password" name="password"
                    class="password-input mt-1 block w-full pr-10 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-[#E8EDEF] text-[#052356]"" required>
                    <button type=" button" onclick="togglePassword('password', this)"
                    class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" id="eye-icon" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-eye-icon lucide-eye">
                    <path
                        d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                    <circle cx="12" cy="12" r="3" />
                </svg>
                </button>
            </div>
        </div>

        {{-- Konfirmasi Password Baru --}}
        <div>
            <label class="block text-sm font-medium text-[#052356]">Konfirmasi Password Baru</label>
            <div class="relative">
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class=" password-input mt-1 block w-full pr-10 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-[#E8EDEF] text-[#052356]"" required>
                    <button type=" button" onclick="togglePassword('password_confirmation', this)"
                    class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" id="eye-icon" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-eye-icon lucide-eye">
                    <path
                        d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                    <circle cx="12" cy="12" r="3" />
                </svg>
                </button>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end gap-3">
            <a href="{{ route('siswa.profil') }}"
                class="px-6 py-2 border border-[#224779] text-[#224779] rounded-lg hover:bg-[#224779] hover:text-white">
                Batal
            </a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Simpan Password
            </button>
        </div>
    </form>
</div>
@endsection

{{-- mobile --}}
@section('profile_content_mobile')
<div class="md:hidden">
    <div class="bg-[#5F9EF2] w-full h-[70px] rounded-b-lg p-6 text-center fixed top-0 right-0 left-0 text-white flex">
        <a href="{{route("siswa.profil")}}">
            <div class="absolute">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-chevron-left-icon lucide-chevron-left">
                    <path d="m15 18-6-6 6-6" /></svg>
            </div>
        </a>
        <h1 class="absolute left-1/2 -translate-x-1/2 text-xl font-bold text-white">
            Ubah Password
        </h1>
    </div>

    @if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('siswa.profil.pengaturan.password.update') }}" method="POST"
        class="space-y-4 bg-[#CDE1FB] p-6 rounded-lg mt-16">
        @csrf
        @method('PUT')

        {{-- Password Lama --}}
        <div>
            <label class="block text-sm font-medium text-[#052356]">Password Lama</label>
            <div class="relative">
                <input type="password" id="old_password-mobile" name="old_password"
                    class="mt-1 block w-full pr-10 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-[#E8EDEF] text-[#052356]"
                    required>
                <button type="button" onclick="togglePassword('old_password-mobile', this)"
                    class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" id="eye-icon" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye">
                        <path
                            d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Password Baru --}}
        <div>
            <label class="block text-sm font-medium text-[#052356]">Password Baru</label>
            <div class="relative">
                <input type="password" id="password-mobile" name="password"
                    class="mt-1 block w-full pr-10 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-[#E8EDEF] text-[#052356]"
                    required>
                <button type="button" onclick="togglePassword('password-mobile', this)"
                    class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" id="eye-icon" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye">
                        <path
                            d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Konfirmasi Password Baru --}}
        <div>
            <label class="block text-sm font-medium text-[#052356]">Konfirmasi Password Baru</label>
            <div class="relative">
                <input type="password" id="password_confirmation-mobile" name="password_confirmation"
                    class="mt-1 block w-full pr-10 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-[#E8EDEF] text-[#052356]"
                    required>
                <button type="button" onclick="togglePassword('password_confirmation-mobile', this)"
                    class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" id="eye-icon" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye">
                        <path
                            d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end gap-3">
            <a href="{{ route('siswa.profil') }}"
                class="px-6 py-2 border border-[#224779] text-[#224779] rounded-lg hover:bg-[#224779] hover:text-white">
                Batal
            </a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Simpan Password
            </button>
        </div>
    </form>
</div>
@endsection

<script>
    function togglePassword(fieldId, button) {
        const input = document.getElementById(fieldId);
        if (!input) {
            console.error(`Input field with ID '${fieldId}' not found.`);
            return;
        }
        const eyeIcon = button.querySelector("svg");
        if (input.type === "password") {
            input.type = "text";
            eyeIcon.outerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-closed-icon lucide-eye-closed"><path d="m15 18-.722-3.25"/><path d="M2 8a10.645 10.645 0 0 0 20 0"/>
                        <path d="m20 15-1.726-2.05"/><path d="m4 15 1.726-2.05"/><path d="m9 18 .722-3.25"/>
                    </svg>
                `;
        } else {
            input.type = "password";
            eyeIcon.outerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                `;
        }
    }

</script>
