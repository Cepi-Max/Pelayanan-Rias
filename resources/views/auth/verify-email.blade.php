<x-guest-layout>
    <div class="text-center mb-6">
        <div class="flex items-center justify-center mb-4">
            <div class="bg-yellow-100 p-3 rounded-full">
                <i class="fas fa-envelope-open-text text-yellow-500 text-2xl"></i>
            </div>
        </div>
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Verifikasi Email</h2>
        <p class="text-sm text-gray-600">Konfirmasi alamat email Anda untuk melanjutkan</p>
    </div>

    <!-- Main Message -->
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg mb-6">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-yellow-500 text-lg mr-3 mt-0.5"></i>
            </div>
            <div>
                <p class="text-sm text-yellow-800 leading-relaxed">
                    {{ __('Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik tautan yang telah kami kirimkan. Jika Anda tidak menerima email tersebut, kami akan dengan senang hati mengirim ulang.') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if (session('status') == 'verification-link-sent')
        <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-lg mb-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-500 text-lg mr-3 mt-0.5"></i>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-green-800 mb-1">Email Terkirim!</h3>
                    <p class="text-sm text-green-700">
                        {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat registrasi.') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="flex flex-col space-y-4">
        <!-- Resend Email Form -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-semibold transition duration-200 flex items-center justify-center space-x-2">
                <i class="fas fa-paper-plane text-sm"></i>
                <span>{{ __('Kirim Ulang Email Verifikasi') }}</span>
            </x-primary-button>
        </form>

        <!-- Logout Form -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                class="w-full text-sm text-gray-600 hover:text-gray-800 py-2 rounded-lg border border-gray-300 hover:border-gray-400 transition duration-200 flex items-center justify-center space-x-2">
                <i class="fas fa-sign-out-alt text-xs"></i>
                <span>{{ __('Keluar') }}</span>
            </button>
        </form>
    </div>

    <!-- Help Section -->
    <div class="mt-6 bg-blue-50 rounded-lg p-4 flex items-start">
        <div class="flex-shrink-0 bg-blue-100 p-2 rounded-full">
            <i class="fas fa-question-circle text-blue-500"></i>
        </div>
        <div class="ml-3">
            <h3 class="text-sm font-medium text-blue-800">Butuh Bantuan?</h3>
            <p class="text-xs text-blue-600 mt-1">
                Jika Anda tidak menerima email verifikasi, periksa folder spam atau junk mail Anda. 
                Email mungkin memerlukan beberapa menit untuk sampai.
            </p>
        </div>
    </div>

    <!-- Email Tips -->
    <div class="mt-4 bg-gray-50 rounded-lg p-4">
        <h4 class="text-sm font-medium text-gray-800 mb-2 flex items-center">
            <i class="fas fa-lightbulb text-yellow-500 text-sm mr-2"></i>
            Tips Verifikasi Email
        </h4>
        <ul class="text-xs text-gray-600 space-y-1">
            <li class="flex items-start">
                <i class="fas fa-circle text-gray-400 text-xs mr-2 mt-1"></i>
                <span>Periksa folder spam/junk mail jika tidak menerima email</span>
            </li>
            <li class="flex items-start">
                <i class="fas fa-circle text-gray-400 text-xs mr-2 mt-1"></i>
                <span>Pastikan alamat email yang didaftarkan benar</span>
            </li>
            <li class="flex items-start">
                <i class="fas fa-circle text-gray-400 text-xs mr-2 mt-1"></i>
                <span>Klik tautan verifikasi untuk mengaktifkan akun</span>
            </li>
        </ul>
    </div>
</x-guest-layout>