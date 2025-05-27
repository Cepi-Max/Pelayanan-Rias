<aside
    class="w-64 bg-white border-r border-gray-200 min-h-screen fixed top-16 left-0 bottom-0 z-20 transition-all duration-300">
    <!-- Sidebar Header -->
    <div class="px-4 py-5 border-b border-gray-100">
        <div class="flex items-center">
            <div class="w-8 h-8 bg-gray-100 rounded-md flex items-center justify-center text-gray-500">
                <span class="material-icons text-sm">admin_panel_settings</span>
            </div>
            <h2 class="ml-3 text-sm font-medium text-gray-700">Admin Panel</h2>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="px-2 py-3">
        <!-- Main Navigation Section -->
        <div class="mb-1">
            <p class="px-3 text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Menu Utama</p>
            <ul>
                <li class="mb-1">
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center px-3 py-2.5 text-sm rounded-md font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100 text-gray-900' : '' }}">
                        <span class="material-icons mr-3 text-gray-500 text-base">dashboard</span>
                        Dashboard
                    </a>
                </li>

                @if(Auth::user() && Auth::user()->role === 'admin')
                    <li class="mb-1">
                        <a href="{{ route('admin.pengguna.index') }}"
                            class="flex items-center px-3 py-2.5 text-sm rounded-md font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900 {{ request()->routeIs('admin.pengguna.*') ? 'bg-gray-100 text-gray-900' : '' }}">
                            <span class="material-icons mr-3 text-gray-500 text-base">group</span>
                            User Management
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <!-- Surat Section -->
        <div class="mt-6 mb-1">
            <p class="px-3 text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Manajemen Surat</p>
            <ul>
                <li class="mb-1">
                    <a href="{{ route('admin.jenis-surat.index') }}"
                        class="flex items-center px-3 py-2.5 text-sm rounded-md font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900 {{ request()->routeIs('admin.jenis-surat.*') ? 'bg-gray-100 text-gray-900' : '' }}">
                        <span class="material-icons mr-3 text-gray-500 text-base">description</span>
                        Jenis Surat
                    </a>
                </li>
                <li class="mb-1">
                    <a href="{{ route('admin.antrian.index') }}"
                        class="flex items-center px-3 py-2.5 text-sm rounded-md font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900 {{ request()->routeIs('admin.antrian.*') ? 'bg-gray-100 text-gray-900' : '' }}">
                        <span class="material-icons mr-3 text-gray-500 text-base">schedule</span>
                        Antrian
                    </a>
                </li>
            </ul>
        </div>

        <!-- Settings Section -->
        <div class="mt-6 mb-1">
            <p class="px-3 text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Pengaturan</p>
            <ul>
                <li class="mb-1">
                    <a href="#"
                        class="flex items-center px-3 py-2.5 text-sm rounded-md font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                        <span class="material-icons mr-3 text-gray-500 text-base">settings</span>
                        Konfigurasi
                    </a>
                </li>
                <li class="mb-1">
                    <a href="#"
                        class="flex items-center px-3 py-2.5 text-sm rounded-md font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                        <span class="material-icons mr-3 text-gray-500 text-base">help_outline</span>
                        Bantuan
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar Footer -->
    <div class="absolute bottom-0 left-0 right-0 border-t border-gray-100">
        <div class="px-4 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-gray-500">
                        <span class="material-icons text-sm">person</span>
                    </div>
                    <div class="ml-2">
                        <p class="text-xs font-medium text-gray-900">Admin User</p>
                        <p class="text-xs text-gray-500">admin@example.com</p>
                    </div>
                </div>
                <button class="text-gray-400 hover:text-gray-600">
                    <span class="material-icons text-base">logout</span>
                </button>
            </div>
        </div>
    </div>
</aside>
