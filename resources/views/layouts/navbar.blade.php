<nav class="bg-white fixed w-full z-50 top-0 shadow">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">

        <!-- Logo -->
        <div class="text-xl font-bold text-indigo-700 tracking-wide">
            <i class="fas fa-house text-indigo-700 mr-1"></i>Pengajuan Surat Desa Rias
        </div>

        <!-- Menu Desktop -->
        <div class="hidden md:flex space-x-6 items-center text-sm font-medium">
            <a href="/" class="text-gray-700 hover:text-indigo-700 transition flex items-center space-x-1">
                <i class="fas fa-home"></i>
                <span>Beranda</span>
            </a>

            @auth
                <a href="{{ route('daftar-pengajuan.index') }}"
                    class="text-gray-700 hover:text-indigo-700 transition flex items-center space-x-1">
                    <i class="fas fa-envelope-open-text"></i>
                    <span>Pengajuan Saya</span>
                </a>
                <a href="{{ route('riwayat-pengajuan.index') }}"
                    class="text-gray-700 hover:text-indigo-700 transition flex items-center space-x-1">
                    <i class="fas fa-clock-rotate-left"></i>
                    <span>Riwayat</span>
                </a>
                <a href="{{ route('profile.edit') }}"
                    class="text-gray-700 hover:text-indigo-700 transition flex items-center space-x-1">
                    <i class="fas fa-user-circle"></i>
                    <span>Profil</span>
                </a>

                <form action="{{ route('logout') }}" method="POST" class="ml-4">
                    @csrf
                    <button type="submit"
                        class="px-4 py-1.5 bg-red-600 text-white rounded-full hover:bg-red-500 transition flex items-center space-x-1">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="px-4 py-1.5 bg-indigo-900 text-white rounded-full hover:bg-indigo-700 transition flex items-center space-x-1">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Login</span>
                </a>
                <a href="{{ route('register') }}"
                    class="px-4 py-1.5 bg-indigo-900 text-white rounded-full hover:bg-indigo-700 transition flex items-center space-x-1">
                    <i class="fas fa-user-plus"></i>
                    <span>Register</span>
                </a>
            @endauth
        </div>

        <!-- Mobile Button -->
        <div class="md:hidden">
            <button id="menu-toggle" class="text-gray-600 focus:outline-none">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu"
        class="md:hidden hidden px-4 pb-4 bg-white shadow-inner space-y-2 transition-all duration-300 ease-in-out text-sm font-medium">
        <a href="/" class=" text-gray-700 hover:text-indigo-700 transition flex items-center space-x-2">
            <i class="fas fa-home"></i>
            <span>Beranda</span>
        </a>

        @auth
            <a href="{{ route('daftar-pengajuan.index') }}"
                class=" text-gray-700 hover:text-indigo-700 transition flex items-center space-x-2">
                <i class="fas fa-envelope-open-text"></i>
                <span>Pengajuan Saya</span>
            </a>
            <a href="{{ route('riwayat-pengajuan.index') }}"
                class=" text-gray-700 hover:text-indigo-700 transition flex items-center space-x-2">
                <i class="fas fa-clock-rotate-left"></i>
                <span>Riwayat</span>
            </a>
            <a href="{{ route('profile.edit') }}"
                class=" text-gray-700 hover:text-indigo-700 transition flex items-center space-x-2">
                <i class="fas fa-user-circle"></i>
                <span>Profil</span>
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class=" w-full py-2 mt-2 bg-red-600 text-white text-center rounded-full hover:bg-red-500 transition flex justify-center items-center space-x-2">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        @else
            <a href="{{ route('login') }}"
                class=" w-full py-2 mt-2 bg-indigo-900 text-white text-center rounded-full hover:bg-indigo-700 transition flex justify-center items-center space-x-2">
                <i class="fas fa-sign-in-alt"></i>
                <span>Login</span>
            </a>
            <a href="{{ route('register') }}"
                class=" w-full py-2 mt-2 bg-indigo-900 text-white text-center rounded-full hover:bg-indigo-700 transition flex justify-center items-center space-x-2">
                <i class="fas fa-user-plus"></i>
                <span>Register</span>
            </a>
        @endauth
    </div>
</nav>
