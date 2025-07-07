@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <i class="fas fa-tachometer-alt text-blue-500 text-xl mr-3"></i>
                <h1 class="text-2xl font-semibold text-gray-800">Dashboard Pengajuan Surat</h1>
            </div>

            <div class="flex items-center text-sm text-gray-500">
                <i class="fas fa-info-circle mr-2 text-blue-400"></i>
                Pilih jenis surat yang ingin diajukan
            </div>
        </div>

        @if (count($jenisSurat) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($jenisSurat as $index => $js)
                    <div
                        class="bg-white rounded-lg shadow hover:shadow-md transition-all duration-200 overflow-hidden border-t-4 {{ ['border-blue-500', 'border-green-500', 'border-purple-500', 'border-yellow-500', 'border-red-500', 'border-indigo-500'][$index % 6] }} flex flex-col h-full">
                        <div class="flex flex-col p-5 flex-grow">
                            <!-- Header -->
                            <div class="flex items-center mb-4">
                                <div
                                    class="flex-shrink-0 {{ ['bg-blue-50', 'bg-green-50', 'bg-purple-50', 'bg-yellow-50', 'bg-red-50', 'bg-indigo-50'][$index % 6] }} p-3 rounded-lg">
                                    <i
                                        class="{{ ['fas fa-file-contract', 'fas fa-file-signature', 'fas fa-file-invoice', 'fas fa-clipboard-list', 'fas fa-passport', 'fas fa-id-card', 'fas fa-file-medical', 'fas fa-certificate'][$index % 8] }} {{ ['text-blue-500', 'text-green-500', 'text-purple-500', 'text-yellow-500', 'text-red-500', 'text-indigo-500'][$index % 6] }} text-xl"></i>
                                </div>
                                <h2 class="ml-3 text-lg font-medium text-gray-800">{{ $js->nama_jenis }}</h2>
                            </div>

                            <!-- Deskripsi -->
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $js->deskripsi }}</p>

                            <!-- Spacer agar dorong bagian bawah ke bawah -->
                            <div class="flex-grow"></div>
                        </div>

                        <!-- Bagian bawah: kode dan tombol -->
                        <div class="flex items-center justify-between border-t5 p-5 text-sm border-t border-gray-300">
                            <div class="text-gray-500 flex items-center space-x-1">
                                <i class="fas fa-tag text-xs text-gray-400"></i>
                                <span>Kode: <span class="font-medium">{{ $js->slug }}</span></span>
                            </div>

                            <a href="{{ route('pengajuan-surat.form', $js->slug) }}"
                                class="w-full md:w-auto inline-flex items-center justify-center space-x-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-semibold transition duration-200 min-w-[140px]">
                                <i class="fas fa-pen-nib"></i>
                                <span>Ajukan Surat</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 bg-blue-50 rounded-lg p-4 flex items-start">
                <div class="flex-shrink-0 bg-blue-100 p-2 rounded-full">
                    <i class="fas fa-lightbulb text-blue-500"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Informasi Pengajuan</h3>
                    <p class="text-xs text-blue-600 mt-1">Pastikan melengkapi semua data yang diperlukan untuk mempercepat
                        proses verifikasi surat.</p>
                </div>
            </div>
        @else
            <div class="bg-gray-50 rounded-lg p-8 text-center">
                <div class="text-gray-400 mb-2">
                    <i class="fas fa-inbox text-4xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-700 mb-1">Tidak Ada Jenis Surat</h3>
                <p class="text-gray-500">Belum ada jenis surat yang tersedia saat ini.</p>
            </div>
        @endif
    </div>
    <div class="bg-blue-50 border-l-4 border-blue-400 text-blue-700 p-4 rounded mb-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-blue-500 text-xl mr-3 mt-1"></i>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-2">Petunjuk Pengajuan Surat</h3>
                <ol class="list-decimal list-inside text-sm space-y-1">
                    <li>Silakan <strong>registrasi dan login</strong> terlebih dahulu untuk mengakses fitur pengajuan surat.
                    </li>
                    <li>Pilih <strong>jenis surat</strong> yang ingin diajukan dari daftar di bawah.</li>
                    <li>Isi <strong>formulir data diri dan keperluan</strong> sesuai dengan jenis surat.</li>
                    <li>Setelah semua data lengkap, klik <strong>kirim pengajuan</strong>.</li>
                    <li>Status pengajuan dapat dilihat di menu <strong>"Pengajuan Saya"</strong> pada navigasi utama.</li>
                    <li>Jika <strong>pengajuan ditolak</strong>, Anda akan menerima <strong>email penolakan</strong> beserta
                        alasannya.</li>
                    <li>Jika surat telah selesai diproses, Anda akan menerima <strong>email pemberitahuan</strong> dan dapat
                        langsung <strong>mengunduh surat</strong> melalui sistem.</li>
                </ol>
            </div>
        </div>
    </div>

@endsection
