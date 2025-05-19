<nav class="bg-white shadow-lg fixed w-full z-50 top-0">
  <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
    <!-- Logo -->
    <div class="text-2xl font-bold text-indigo-700 tracking-wide">
      Desa Rias
    </div>

    <!-- Menu Desktop -->
    <div class="hidden md:flex space-x-8 items-center">
      <a href="/" class="text-gray-700 hover:text-indigo-700 font-medium transition duration-300">Beranda</a>
      @auth
      <a href="{{ route('daftar-pengajuan.index') }}" class="text-gray-700 hover:text-indigo-700 font-medium transition duration-300">Pengajuan Saya</a>
      <a href="{{ route('riwayat-pengajuan.index') }}" class="text-gray-700 hover:text-indigo-700 font-medium transition duration-300">Riwayat</a>
      <a href="{{ route('profile.edit') }}" class="text-gray-700 hover:text-indigo-700 font-medium transition duration-300">Profil Saya</a>
        <!-- Kalau user sudah login -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="block py-2 mt-2 bg-red-600 text-white text-center rounded-full hover:bg-red-500 transition">
                Logout
            </button>
        </form>
    @else
        <!-- Kalau user belum login -->
        <a href="{{ route('login') }}" class="block py-2 mt-2 bg-indigo-900 text-white text-center rounded-full hover:bg-indigo-700 transition">
            Login
        </a>
        <a href="{{ route('register') }}" class="block py-2 mt-2 bg-indigo-900 text-white text-center rounded-full hover:bg-indigo-700 transition">
            Register
        </a>
    @endauth
    </div>

    <!-- Mobile Button -->
    <div class="md:hidden">
      <button id="menu-toggle" class="text-gray-600 focus:outline-none">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="md:hidden hidden px-4 pb-4 bg-white shadow-inner transition-all duration-300 ease-in-out">
      <a href="/" class="text-gray-700 hover:text-indigo-700 font-medium transition duration-300">Beranda</a>
    @auth
    <a href="{{ route('daftar-pengajuan.index') }}" class="block py-2 text-gray-700 hover:text-indigo-700 transition">Pengajuan Saya</a>
    <a href="{{ route('riwayat-pengajuan.index') }}" class="block py-2 text-gray-700 hover:text-indigo-700 transition">Riwayat</a>
    <a href="{{ route('profile.edit') }}" class="block py-2 text-gray-700 hover:text-indigo-700 transition">Profil</a>
      <!-- Kalau user sudah login -->
      <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="block py-2 mt-2 bg-red-600 text-white text-center rounded-full hover:bg-red-500 transition">
              Logout
          </button>
      </form>
  @else
      <!-- Kalau user belum login -->
      <a href="{{ route('login') }}" class="block py-2 mt-2 bg-indigo-900 text-white text-center rounded-full hover:bg-indigo-700 transition">
          Login
      </a>
      <a href="{{ route('register') }}" class="block py-2 mt-2 bg-indigo-900 text-white text-center rounded-full hover:bg-indigo-700 transition">
         Register
      </a>
  @endauth
  
  </div>
</nav>

<script>
  const menuToggle = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');

  menuToggle.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });
</script>
