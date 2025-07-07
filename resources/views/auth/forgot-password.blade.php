<x-guest-layout>
    <div class="text-center mb-6">
        <div class="flex items-center justify-center mb-4">
            <div class="bg-orange-100 p-3 rounded-full">
                <i class="fas fa-unlock-alt text-orange-500 text-2xl"></i>
            </div>
        </div>
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Lupa Password?</h2>
        <p class="text-sm text-gray-600">Kami akan mengirimkan link reset password ke email Anda</p>
    </div>

    <!-- Main Message -->
    <div class="bg-orange-50 border-l-4 border-orange-400 p-4 rounded-lg mb-6">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-orange-500 text-lg mr-3 mt-0.5"></i>
            </div>
            <div>
                <p class="text-sm text-orange-800 leading-relaxed">
                    {{ __('Tidak masalah jika Anda lupa password. Cukup berikan alamat email Anda dan kami akan mengirimkan link reset password yang memungkinkan Anda membuat password baru.') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-lg mb-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-500 text-lg mr-3 mt-0.5"></i>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-green-800 mb-1">Email Terkirim!</h3>
                    <p class="text-sm text-green-700">
                        {{ session('status') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        
        <!-- Email Address -->
        <div class="mb-6">
            <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium flex items-center" />
            <div class="relative mt-2">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400 text-sm"></i>
                </div>
                <x-text-input id="email" 
                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus
                    placeholder="Masukkan alamat email Anda" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center mb-4">
            <x-primary-button class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-lg font-semibold transition duration-200 flex items-center justify-center space-x-2">
                <i class="fas fa-paper-plane text-sm"></i>
                <span>{{ __('Kirim Link Reset Password') }}</span>
            </x-primary-button>
        </div>

        <!-- Back to Login -->
        <div class="text-center">
            <a href="{{ route('login') }}" 
               class="text-sm text-orange-500 hover:text-orange-600 transition duration-200 flex items-center justify-center space-x-1">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Kembali ke Login</span>
            </a>
        </div>
    </form>

    <!-- Help Section -->
    <div class="mt-6 bg-blue-50 rounded-lg p-4 flex items-start">
        <div class="flex-shrink-0 bg-blue-100 p-2 rounded-full">
            <i class="fas fa-question-circle text-blue-500"></i>
        </div>
        <div class="ml-3">
            <h3 class="text-sm font-medium text-blue-800">Butuh Bantuan?</h3>
            <p class="text-xs text-blue-600 mt-1">
                Jika Anda tidak menerima email reset password, periksa folder spam atau junk mail Anda. 
                Proses pengiriman email mungkin memerlukan beberapa menit.
            </p>
        </div>
    </div>

    <!-- Security Notice -->
    <div class="mt-4 bg-gray-50 rounded-lg p-4">
        <h4 class="text-sm font-medium text-gray-800 mb-2 flex items-center">
            <i class="fas fa-shield-alt text-gray-500 text-sm mr-2"></i>
            Catatan Keamanan
        </h4>
        <ul class="text-xs text-gray-600 space-y-1">
            <li class="flex items-start">
                <i class="fas fa-circle text-gray-400 text-xs mr-2 mt-1"></i>
                <span>Link reset password akan kedaluwarsa dalam 60 menit</span>
            </li>
            <li class="flex items-start">
                <i class="fas fa-circle text-gray-400 text-xs mr-2 mt-1"></i>
                <span>Hanya email terdaftar yang akan menerima link reset</span>
            </li>
            <li class="flex items-start">
                <i class="fas fa-circle text-gray-400 text-xs mr-2 mt-1"></i>
                <span>Jangan bagikan link reset dengan orang lain</span>
            </li>
        </ul>
    </div>
</x-guest-layout>