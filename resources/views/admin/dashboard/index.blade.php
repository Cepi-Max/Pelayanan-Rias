@extends('admin.layouts.app')
@section('content')
    <div class="py-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Dashboard Admin</h1>
                <p class="mt-1 text-sm text-gray-500">Selamat datang kembali, berikut ringkasan data sistem Anda</p>
            </div>
            <div class="mt-4 md:mt-0 flex items-center text-sm">
                <span class="text-gray-500 mr-2">Terakhir diperbarui:</span>
                <span class="font-medium text-gray-700">{{ now()->format('d M Y, H:i') }}</span>
                <button
                    class="ml-3 p-1.5 rounded-full text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors">
                    <span class="material-icons text-base">refresh</span>
                </button>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Card 1 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
                        <h2 class="mt-2 text-3xl font-semibold text-gray-800">1,245</h2>
                        <p class="mt-1 text-sm text-green-600 flex items-center">
                            <span class="material-icons text-sm mr-1">arrow_upward</span>
                            <span>12% dibanding bulan lalu</span>
                        </p>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-500">
                        <span class="material-icons">group</span>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.pengguna.index') }}"
                        class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center">
                        Lihat detail
                        <span class="material-icons text-sm ml-1">chevron_right</span>
                    </a>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Penjualan Hari Ini</p>
                        <h2 class="mt-2 text-3xl font-semibold text-gray-800">Rp 4.200.000</h2>
                        <p class="mt-1 text-sm text-green-600 flex items-center">
                            <span class="material-icons text-sm mr-1">arrow_upward</span>
                            <span>8% dibanding kemarin</span>
                        </p>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center text-green-500">
                        <span class="material-icons">payments</span>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center">
                        Lihat laporan
                        <span class="material-icons text-sm ml-1">chevron_right</span>
                    </a>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Pesanan Baru</p>
                        <h2 class="mt-2 text-3xl font-semibold text-gray-800">23</h2>
                        <p class="mt-1 text-sm text-yellow-600 flex items-center">
                            <span class="material-icons text-sm mr-1">pending</span>
                            <span>Memerlukan perhatian</span>
                        </p>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-yellow-50 flex items-center justify-center text-yellow-500">
                        <span class="material-icons">shopping_cart</span>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center">
                        Proses pesanan
                        <span class="material-icons text-sm ml-1">chevron_right</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Activity & Analytics Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Activity -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-700">Aktivitas Terbaru</h3>
                    <button class="text-sm text-gray-500 hover:text-gray-700">Lihat semua</button>
                </div>

                <div class="space-y-4">
                    <!-- Activity Item 1 -->
                    <div class="flex items-start">
                        <div
                            class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-500 flex-shrink-0">
                            <span class="material-icons text-sm">person_add</span>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-800">Ahmad Kurniawan baru saja mendaftar sebagai pengguna baru</p>
                            <p class="text-xs text-gray-500 mt-1">10 menit yang lalu</p>
                        </div>
                    </div>

                    <!-- Activity Item 2 -->
                    <div class="flex items-start">
                        <div
                            class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-500 flex-shrink-0">
                            <span class="material-icons text-sm">shopping_bag</span>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-800">Pesanan #12345 telah selesai diproses</p>
                            <p class="text-xs text-gray-500 mt-1">1 jam yang lalu</p>
                        </div>
                    </div>

                    <!-- Activity Item 3 -->
                    <div class="flex items-start">
                        <div
                            class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-500 flex-shrink-0">
                            <span class="material-icons text-sm">sync</span>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-800">Sistem melakukan pembaruan otomatis stok produk</p>
                            <p class="text-xs text-gray-500 mt-1">3 jam yang lalu</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-medium text-gray-700 mb-6">Ringkasan Statistik</h3>

                <div class="space-y-5">
                    <!-- Stat 1 -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-500">Tingkat Konversi</span>
                            <span class="text-sm font-medium text-gray-800">24.8%</span>
                        </div>
                        <div class="h-2 bg-gray-200 rounded">
                            <div class="h-2 bg-blue-500 rounded" style="width: 24.8%"></div>
                        </div>
                    </div>

                    <!-- Stat 2 -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-500">Kepuasan Pelanggan</span>
                            <span class="text-sm font-medium text-gray-800">92%</span>
                        </div>
                        <div class="h-2 bg-gray-200 rounded">
                            <div class="h-2 bg-green-500 rounded" style="width: 92%"></div>
                        </div>
                    </div>

                    <!-- Stat 3 -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-500">Pengguna Aktif</span>
                            <span class="text-sm font-medium text-gray-800">78%</span>
                        </div>
                        <div class="h-2 bg-gray-200 rounded">
                            <div class="h-2 bg-yellow-500 rounded" style="width: 78%"></div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-gray-100">
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center">
                        Laporan Lengkap
                        <span class="material-icons text-sm ml-1">chevron_right</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
