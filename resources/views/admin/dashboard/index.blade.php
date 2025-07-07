@extends('admin.layouts.app')
@section('content')
    <div class="py-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                <p class="mt-2 text-gray-600">Selamat datang kembali, berikut ringkasan data sistem Anda</p>
            </div>
            <div class="mt-4 md:mt-0 flex items-center text-sm bg-white px-4 py-2 rounded-lg shadow-sm border">
                <span class="text-gray-500 mr-2">Terakhir diperbarui:</span>
                <span class="font-medium text-gray-700">{{ now()->format('d M Y, H:i') }}</span>
                <button onclick="window.location.reload()" 
                    class="ml-3 p-1.5 rounded-full text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Main Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Users Card -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total Pengguna</p>
                        <h2 class="mt-2 text-3xl font-bold">{{ number_format($user) }}</h2>
                        <div class="mt-2 flex items-center text-sm">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Pengguna terdaftar</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-blue-400 bg-opacity-30 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Today's Submissions -->
            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Pengajuan Hari Ini</p>
                        <h2 class="mt-2 text-3xl font-bold">{{ number_format($totalHariIni) }}</h2>
                        <div class="mt-2 flex items-center text-sm">
                            @if($totalHariIni > 0)
                                <span class="text-green-100">{{ $totalHariIni }} pengajuan baru</span>
                            @else
                                <span class="text-green-100">Belum ada pengajuan</span>
                            @endif
                        </div>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-green-400 bg-opacity-30 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- This Week's Submissions -->
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-purple-100 text-sm font-medium">Pengajuan Minggu Ini</p>
                        <h2 class="mt-2 text-3xl font-bold">{{ number_format($totalMingguIni ?? 0) }}</h2>
                        <div class="mt-2 flex items-center text-sm">
                            @php
                                $avgPerDay = $totalMingguIni > 0 ? round($totalMingguIni / 7, 1) : 0;
                            @endphp
                            <span class="text-purple-100">{{ $avgPerDay }}/hari rata-rata</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-purple-400 bg-opacity-30 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- This Month's Submissions -->
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-orange-100 text-sm font-medium">Pengajuan Bulan Ini</p>
                        <h2 class="mt-2 text-3xl font-bold">{{ number_format($totalBulanIni) }}</h2>
                        <div class="mt-2 flex items-center text-sm">
                            @php
                                $avgPerMonth = $totalBulanIni > 0 ? round($totalBulanIni / now()->day, 1) : 0;
                            @endphp
                            <span class="text-orange-100">{{ $avgPerMonth }}/hari rata-rata</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-orange-400 bg-opacity-30 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Overview Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Pending Status -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Menunggu Persetujuan</p>
                        <h3 class="text-2xl font-bold text-yellow-600 mt-1">{{ number_format($pengajuanPending ?? 0) }}</h3>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-yellow-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
                <a href="{{ route('admin.antrian.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium mt-3 inline-flex items-center">
                    Lihat detail
                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>

            <!-- Approved Status -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Sudah Disetujui</p>
                        <h3 class="text-2xl font-bold text-green-600 mt-1">{{ number_format($pengajuanDisetujui ?? 0) }}</h3>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
                <a href="{{ route('admin.antrian.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium mt-3 inline-flex items-center">
                    Lihat detail
                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>

            <!-- Rejected Status -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Ditolak</p>
                        <h3 class="text-2xl font-bold text-red-600 mt-1">{{ number_format($pengajuanDitolak ?? 0) }}</h3>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
                <a href="{{ route('admin.antrian.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium mt-3 inline-flex items-center">
                    Lihat detail
                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Activity -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-900">Notifikasi Terbaru</h3>
                    <a href="{{ route('admin.antrian.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat semua</a>
                </div>

                <div class="space-y-4">
                    @forelse ($notifikasiDashboard ?? [] as $notif)
                        <div class="flex items-start p-4 rounded-lg border border-gray-100 hover:bg-gray-50 transition-colors {{ !$notif->sudah_dibaca_operator ? 'bg-blue-50 border-blue-200' : '' }}">
                            <!-- Status Icon -->
                            <div class="flex-shrink-0 mt-1">
                                @if($notif->tipe == 'pengajuan_baru')
                                    <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                @elseif($notif->tipe == 'pengajuan_disetujui')
                                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                @elseif($notif->tipe == 'pengajuan_ditolak')
                                    <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                @else
                                    <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Notification Content -->
                            <div class="ml-4 flex-1">
                                <div class="flex items-start justify-between">
                                    <a href="{{ route('admin.antrian.show', $notif->pengajuan_surat_id) }}">
                                        <p class="text-sm font-medium text-gray-900">{{ $notif->judul }}</p>
                                        <p class="text-sm text-gray-600 mt-1">{{ $notif->pesan }}</p>
                                        <p class="text-xs text-gray-500 mt-2 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $notif->created_at->diffForHumans() }}
                                        </p>
                                    </a>
                                    @if(!$notif->sudah_dibaca_operator)
                                        <span class="flex-shrink-0 w-2 h-2 bg-blue-500 rounded-full"></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada notifikasi</h3>
                            <p class="mt-1 text-sm text-gray-500">Notifikasi baru akan muncul di sini</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- System Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-6">Informasi Sistem</h3>

                <div class="space-y-6">
                    <!-- Notification Stats -->
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-sm font-medium text-gray-700">Notifikasi Belum Dibaca</span>
                            <span class="text-sm font-bold text-red-600">{{ $notifikasiBelumDibaca ?? 0 }}</span>
                        </div>
                        <div class="h-2 bg-gray-200 rounded-full">
                            @php
                                $totalNotif = ($notifikasiBelumDibaca ?? 0) + 10; // Assume 10 total for demo
                                $percentage = $totalNotif > 0 ? (($notifikasiBelumDibaca ?? 0) / $totalNotif) * 100 : 0;
                            @endphp
                            <div class="h-2 bg-red-500 rounded-full" style="width: {{ min($percentage, 100) }}%"></div>
                        </div>
                    </div>

                    <!-- System Status -->
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-sm font-medium text-gray-700">Status Sistem</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-2 h-2 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3"/>
                                </svg>
                                Online
                            </span>
                        </div>
                        <div class="h-2 bg-gray-200 rounded-full">
                            <div class="h-2 bg-green-500 rounded-full" style="width: 100%"></div>
                        </div>
                    </div>

                    <!-- Response Time -->
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-sm font-medium text-gray-700">Waktu Respons Rata-rata</span>
                            <span class="text-sm font-bold text-blue-600">< 2 hari</span>
                        </div>
                        <div class="h-2 bg-gray-200 rounded-full">
                            <div class="h-2 bg-blue-500 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h4 class="text-sm font-medium text-gray-900 mb-4">Aksi Cepat</h4>
                    <div class="space-y-2">
                        <a href="{{ route('admin.antrian.index') }}" 
                           class="flex items-center justify-between p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                            <span class="text-sm text-gray-700">Kelola Antrian</span>
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                        
                        <a href="{{ route('admin.pengguna.index') }}" 
                           class="flex items-center justify-between p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                            <span class="text-sm text-gray-700">Kelola Pengguna</span>
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection