<x-guest-layout>
    <!-- Session Status -->
    {{-- desktop --}}
    <div class="hidden md:flex min-h-screen">
    {{-- Sisi Kiri (Form Login) --}}
    <div class="flex-1 flex flex-col justify-center items-center p-6">
        <img src="{{ asset('storage/asset/logo.png') }}" alt="Logo E-SIS" class="w-25 h-28 mb-4 mt-2">
        <div class="w-full max-w-md">
            <h2 class="text-5xl font-bold text-white mb-8 text-center">Login</h2>
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="text-white">
            @csrf

            <!-- NIS -->
            <div>
                <x-input-label for="username" />
                <label class="text-white font-bold">NIS</label>
                <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>


            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password"/>
                <label class="text-white font-bold">Password</label>
                <x-text-input id="password" class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex justify-between items-center mt-3">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded bg-gray-200 border-gray-300 text-[#0063CB] shadow-sm focus:ring-[#0063CB] w-3 h-3" name="remember">
                    <span class="ms-2 text-md text-gray-600">{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0063CB]" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif
            </div>

            <div class="flex justify-center mt-3">
                <x-primary-button class="">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
        </div>
    </div>

        <div class="flex-1 relative flex flex-col justify-center items-center bg-[#017BFA] rounded-tl-[131px] rounded-bl-[500px]">
        {{-- Konten Kanan --}}
        <div class="flex flex-col items-center text-center">
            <h1 class="text-white text-5xl font-bold mb-2">Welcome To E-SIS</h1>
            <p class="text-white text-xl font-light mb-8">
                Elektronik Surat Izin Sekolah  Cepat, Mudah, Digital
            </p>
            <img src="{{ asset('storage/asset/forms-animate.svg') }}" alt="Ilustrasi Login" class="w-72">
        </div>
    </div>

    </div>

    {{-- mobile --}}
    <div class="md:hidden">
        <div class="min-h-screen">
            <div class="absolute inset-x-0 -top-8 h-[100%] bg-[#017BFA] rounded-bl-[170px] flex flex-col items-center justify-start pt-36 shadow-lg">
                <h1 class="text-white text-3xl font-bold text-center mb-4">Welcome To E-SIS</h1>
                <img src="{{ asset('storage/asset/forms-animate.svg') }}" alt="ilustrasi" class="w-25 h-28 mb-4 mt-2">
            </div>

            <div class="absolute top-2/3 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-4/5 p-8  rounded-lg">
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4">
                    @csrf
                    {{-- <h1 class="text-white text-3xl font-bold text-center">Login</h1> --}}
                    <div class="relative">
                        <label class="text-white font-bold">Masukkan NIS</label>
                        <input id="username"
                                class="block w-full py-2 border-b-2 border-gray-300 focus:border-[#1E90FF] focus:outline-none transition duration-200 placeholder-gray-400 opacity-40 rounded-[25px]"
                                type="text"
                                name="username"
                                :value="old('username')"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="Masukkan NIS" />
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>

                    <div class="relative">
                        <label class="text-white font-bold">Masukkan Password</label>
                        <input id="password"
                                class="block w-full py-2 border-b-2 border-gray-300 focus:border-[#1E90FF] focus:outline-none transition duration-200 placeholder-gray-400 opacity-40 rounded-[25px]"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Masukkan Password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                     <div class="flex justify-between items-center">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded bg-gray-200 border-gray-300 text-[#0063CB] shadow-sm focus:ring-[#0063CB] w-3 h-3" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                        @if (Route::has('password.request'))
                        <a class="underline text-xs text-gray-600 hover:text-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0063CB]" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                        @endif
                    </div>

                    <div class="flex justify-center">
                        <button type="submit" class="w-full py-3 bg-[#0063CB] text-white rounded-md shadow-lg hover:bg-[#104172] transition duration-200 font-bold">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
