<x-guest-layout>
    <div class="text-center mb-6">
        <div class="flex items-center justify-center mb-4">
            <div class="bg-blue-100 p-3 rounded-full">
                <i class="fas fa-key text-blue-500 text-2xl"></i>
            </div>
        </div>
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Reset Password</h2>
        <p class="text-sm text-gray-600">Buat password baru untuk akun Anda</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        
        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium flex items-center" />
            <div class="relative mt-2">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400 text-sm"></i>
                </div>
                <x-text-input id="email" 
                    class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50" 
                    type="email" 
                    name="email" 
                    :value="old('email', $request->email)" 
                    required 
                    autofocus 
                    autocomplete="username"
                    readonly />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password Baru')" class="text-gray-700 font-medium flex items-center" />
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
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password Baru')" class="text-gray-700 font-medium flex items-center" />
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
                    placeholder="Ulangi password baru Anda" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center">
            <x-primary-button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-semibold transition duration-200 flex items-center justify-center space-x-2">
                <i class="fas fa-shield-alt text-sm"></i>
                <span>{{ __('Reset Password') }}</span>
            </x-primary-button>
        </div>
    </form>

    <!-- Security Info -->
    <div class="mt-6 bg-blue-50 rounded-lg p-4 flex items-start">
        <div class="flex-shrink-0 bg-blue-100 p-2 rounded-full">
            <i class="fas fa-info-circle text-blue-500"></i>
        </div>
        <div class="ml-3">
            <h3 class="text-sm font-medium text-blue-800">Keamanan Password</h3>
            <p class="text-xs text-blue-600 mt-1">
                Pastikan password baru Anda aman dengan kombinasi huruf besar, huruf kecil, angka, dan simbol.
            </p>
        </div>
    </div>

    <!-- Password Requirements -->
    <div class="mt-4 bg-gray-50 rounded-lg p-4">
        <h4 class="text-sm font-medium text-gray-800 mb-2 flex items-center">
            <i class="fas fa-check-circle text-green-500 text-sm mr-2"></i>
            Syarat Password yang Baik
        </h4>
        <ul class="text-xs text-gray-600 space-y-1">
            <li class="flex items-start">
                <i class="fas fa-circle text-gray-400 text-xs mr-2 mt-1"></i>
                <span>Minimal 8 karakter</span>
            </li>
            <li class="flex items-start">
                <i class="fas fa-circle text-gray-400 text-xs mr-2 mt-1"></i>
                <span>Kombinasi huruf besar dan kecil</span>
            </li>
            <li class="flex items-start">
                <i class="fas fa-circle text-gray-400 text-xs mr-2 mt-1"></i>
                <span>Mengandung angka dan simbol</span>
            </li>
            <li class="flex items-start">
                <i class="fas fa-circle text-gray-400 text-xs mr-2 mt-1"></i>
                <span>Tidak mudah ditebak</span>
            </li>
        </ul>
    </div>

    <!-- Back to Login -->
    <div class="mt-6 text-center">
        <a href="{{ route('login') }}" 
           class="text-sm text-blue-500 hover:text-blue-600 transition duration-200 flex items-center justify-center space-x-1">
            <i class="fas fa-arrow-left text-xs"></i>
            <span>Kembali ke Login</span>
        </a>
    </div>
</x-guest-layout>