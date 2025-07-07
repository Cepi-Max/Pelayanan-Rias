<x-guest-layout>
    <div class="text-center mb-6">
        <div class="flex items-center justify-center mb-4">
            <i class="fas fa-user-plus text-blue-500 text-2xl mr-3"></i>
            <h2 class="text-2xl font-semibold text-gray-800">Registrasi Akun</h2>
        </div>
        <p class="text-sm text-gray-600">Daftar untuk mengakses sistem pengajuan surat</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <!-- Name -->
        <div class="mb-4">
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-gray-700 font-medium flex items-center" />
            <div class="relative mt-2">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-user text-gray-400 text-sm"></i>
                </div>
                <x-text-input id="name" 
                    class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" 
                    type="text" 
                    name="name" 
                    :value="old('name')" 
                    required 
                    autofocus 
                    autocomplete="name"
                    placeholder="Masukkan nama lengkap Anda" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium flex items-center" />
            <div class="relative mt-2">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400 text-sm"></i>
                </div>
                <x-text-input id="email" 
                    class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autocomplete="username"
                    placeholder="contoh@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Number Phone -->
        <div class="mb-4">
            <x-input-label for="number_phone" :value="__('Nomor Handphone')" class="text-gray-700 font-medium flex items-center" />
            <div class="relative mt-2">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-phone text-gray-400 text-sm"></i>
                </div>
                <x-text-input id="number_phone" 
                    class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" 
                    type="tel" 
                    name="number_phone" 
                    :value="old('number_phone')" 
                    required 
                    autocomplete="tel"
                    placeholder="08xxxxxxxxxx" />
            </div>
            <x-input-error :messages="$errors->get('number_phone')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium flex items-center" />
            <div class="relative mt-2">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-gray-400 text-sm"></i>
                </div>
                <x-text-input id="password" 
                    class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                    type="password"
                    name="password"
                    required 
                    autocomplete="new-password"
                    placeholder="Minimal 8 karakter" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-gray-700 font-medium flex items-center" />
            <div class="relative mt-2">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-gray-400 text-sm"></i>
                </div>
                <x-text-input id="password_confirmation" 
                    class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                    type="password"
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password"
                    placeholder="Ulangi password Anda" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
        </div>

        <div class="flex items-center justify-between">
            <a class="text-sm text-blue-500 hover:text-blue-600 transition duration-200 flex items-center" 
               href="{{ route('login') }}">
                <i class="fas fa-arrow-left text-xs mr-1"></i>
                {{ __('Sudah punya akun?') }}
            </a>

            <x-primary-button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-full font-semibold transition duration-200 flex items-center space-x-2">
                <i class="fas fa-user-plus text-sm"></i>
                <span>{{ __('Daftar') }}</span>
            </x-primary-button>
        </div>
    </form>

    <!-- Info Section -->
    <div class="mt-6 bg-blue-50 rounded-lg p-4 flex items-start">
        <div class="flex-shrink-0 bg-blue-100 p-2 rounded-full">
            <i class="fas fa-shield-alt text-blue-500"></i>
        </div>
        <div class="ml-3">
            <h3 class="text-sm font-medium text-blue-800">Keamanan Data</h3>
            <p class="text-xs text-blue-600 mt-1">
                Data pribadi Anda akan dijaga keamanannya dan hanya digunakan untuk keperluan pengajuan surat resmi.
            </p>
        </div>
    </div>
</x-guest-layout>