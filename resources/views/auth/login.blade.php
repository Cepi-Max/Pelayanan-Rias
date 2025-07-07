<x-guest-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="flex items-center justify-center mb-6">
            <div class="w-full max-w-md">
                <div class="flex items-center justify-center mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-sign-in-alt text-blue-500 text-xl mr-3"></i>
                        <h1 class="text-2xl font-semibold text-gray-800">Login</h1>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow hover:shadow-md transition-all duration-200 overflow-hidden border-t-4 border-blue-500">
                    <div class="p-6">
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <!-- Email Address -->
                            <div class="mb-4">
                                <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
                                <x-text-input id="email" 
                                    class="block mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" 
                                    type="email" 
                                    name="email" 
                                    :value="old('email')" 
                                    required 
                                    autofocus 
                                    autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
                                <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
                                <x-text-input id="password" 
                                    class="block mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                    type="password"
                                    name="password"
                                    required 
                                    autocomplete="current-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-6">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" 
                                        type="checkbox" 
                                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:ring-blue-500 transition duration-200" 
                                        name="remember">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-between">
                                @if (Route::has('password.request'))
                                    <a class="text-sm text-blue-500 hover:text-blue-600 transition duration-200 flex items-center" 
                                       href="{{ route('password.request') }}">
                                        <i class="fas fa-key text-xs mr-1"></i>
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif

                                <x-primary-button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-full font-semibold transition duration-200 flex items-center space-x-2">
                                    <i class="fas fa-sign-in-alt text-sm"></i>
                                    <span>{{ __('Log in') }}</span>
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Info Section -->
                <div class="mt-6 bg-blue-50 rounded-lg p-4 flex items-start">
                    <div class="flex-shrink-0 bg-blue-100 p-2 rounded-full">
                        <i class="fas fa-info-circle text-blue-500"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">Informasi Login</h3>
                        <p class="text-xs text-blue-600 mt-1">
                            Gunakan email dan password yang telah terdaftar untuk mengakses sistem pengajuan surat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>