<header class="bg-white shadow-lg fixed top-0 left-0 right-0 z-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">

        <!-- Logo / Judul -->
        <div class="text-2xl font-extrabold text-indigo-700 tracking-wide hover:text-indigo-800 transition duration-300">
            <a href="/" target="_blank">Pengajuan Surat Desa Rias</a>
        </div>

       <div class="flex items-center gap-4">
            <div class="relative">
                <!-- Tombol Notifikasi -->
                <button onclick="toggleNotifikasi()" class="relative flex items-center text-gray-700 hover:text-indigo-600 transition focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    @if($notifikasiBaru > 0)
                    <span class="absolute top-0 right-0 -mt-1 -mr-1 flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-600 rounded-full animate-pulse">
                        {{ $notifikasiBaru }}
                    </span>
                    @endif
                </button>

                <!-- Dropdown Info Notifikasi -->
                <div id="notifikasiDropdown" class="hidden absolute right-0 top-8 w-80 bg-white rounded-lg shadow-lg border border-gray-200 z-50 max-h-96 overflow-y-auto">
                    <!-- Header -->
                    <div class="px-4 py-3 border-b border-gray-200 bg-gray-50 rounded-t-lg">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-semibold text-gray-800">Notifikasi</h3>
                            <div class="flex items-center space-x-2">
                                @if($notifikasiBaru > 0)
                                <span class="text-xs text-red-600 font-medium">{{ $notifikasiBaru }} baru</span>
                                @endif
                                <a href="{{ route('admin.antrian.index') }}" class="text-xs text-indigo-600 hover:text-indigo-800">
                                    Lihat Semua
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Notifikasi -->
                    <div class="divide-y divide-gray-100">
                        @forelse($notifikasi as $item)
                        <div class="px-4 py-3 hover:bg-gray-50 transition-colors {{ $item->sudah_dibaca_operator ? '' : 'bg-blue-50' }}">
                            <div class="flex items-start space-x-3">
                                <!-- Icon berdasarkan tipe -->
                                <div class="flex-shrink-0 mt-1">
                                    @if($item->tipe == 'pengajuan_baru')
                                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                    @elseif($item->tipe == 'pengajuan_disetujui')
                                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                    @elseif($item->tipe == 'pengajuan_ditolak')
                                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                    @else
                                        <div class="w-2 h-2 bg-gray-500 rounded-full"></div>
                                    @endif
                                </div>

                                <!-- Konten Notifikasi -->
                                <div class="flex-1 min-w-0">
                                    <a href="{{ route('admin.antrian.show', $item->pengajuan_surat_id) }}">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            {{ $item->judul }}
                                        </p>
                                        <p class="text-sm text-gray-600 line-clamp-2">
                                            {{ $item->pesan }}
                                        </p>
                                    </a>
                                    <div class="flex items-center justify-between mt-2">
                                        <span class="text-xs text-gray-500">
                                            {{ $item->created_at->diffForHumans() }}
                                        </span>
                                        @if(!$item->sudah_dibaca_operator)
                                        <a href="{{ route('dibaca', $item->id) }}" class="text-xs text-indigo-600 hover:text-indigo-800">
                                            Tandai Dibaca
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="px-4 py-8 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">Tidak ada notifikasi</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Avatar Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex items-center gap-2 focus:outline-none hover:text-indigo-600 transition">
                    <div class="bg-indigo-100 p-1 rounded-full">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5.121 17.804A7.968 7.968 0 0112 15c1.58 0 3.039.5 4.242 1.35M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <span class="hidden sm:block font-medium">Saya</span>
                </button>

                <div x-show="open" @click.away="open = false" x-transition
                    class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg z-50"
                    style="display: none;">
                    <a href="{{ route('admin.profile.edit') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-indigo-100">Profil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-gray-700 hover:bg-red-100 hover:text-red-600">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
