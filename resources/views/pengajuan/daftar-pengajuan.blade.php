@extends('layouts.app')
@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2 mb-4 border-b border-gray-300 p-3">
                <i class="fas fa-hourglass-half text-blue-500 text-2xl"></i>
                Antrian Surat Anda
            </h2>

            <div class="text-sm text-gray-500 flex items-center">
                <i class="far fa-calendar-alt mr-2"></i>
                Terakhir diperbarui: {{ now()->format('d M Y, H:i') }}
            </div>
        </div>

        @if ($antrian->isEmpty())
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-8 text-center">
                <div class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-gray-100 text-gray-500 mb-4">
                    <i class="far fa-folder-open"></i>
                </div>
                <h3 class="text-base font-medium text-gray-700 mb-1">Belum Ada Pengajuan</h3>
                <p class="text-sm text-gray-500">Anda belum mengajukan surat apapun saat ini.</p>
            </div>
        @else
            <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr class="bg-blue-700 text-white font-bold">
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">
                                    No</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">
                                    Jenis Surat</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">
                                    Tanggal Pengajuan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">
                                    Status</th>

                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($antrian as $i => $item)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $i + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="flex-shrink-0 h-8 w-8 flex items-center justify-center rounded-full bg-gray-100 text-gray-500">
                                                <i class="far fa-file-alt"></i>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $item->jenisSurat->nama_jenis ?? '-' }}</div>
                                                <div class="text-xs text-gray-500">Kode:
                                                    {{ $item->jenisSurat->slug ?? '-' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</div>
                                        <div class="text-xs text-gray-500">
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }} WIB</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @switch($item->status)
                                            @case('pending')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-yellow-400"></span>
                                                    Menunggu
                                                </span>
                                            @break

                                            @case('process')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-blue-400"></span>
                                                    Diproses
                                                </span>
                                            @break

                                            @case('completed')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-green-400"></span>
                                                    Selesai
                                                </span>
                                            @break

                                            @case('rejected')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <span class="mr-1.5 h-1.5 w-1.5 rounded-full bg-red-400"></span>
                                                    Ditolak
                                                </span>
                                            @break

                                            @default
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                        @endswitch
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($antrian->count() > 5)
                    <div class="px-6 py-3 bg-gray-50 border-t border-gray-200 text-right">
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua</a>
                    </div>
                @endif
            </div>

            <div class="mt-4 flex justify-between text-sm text-gray-500">
                <div>Menampilkan {{ $antrian->count() }} dari {{ $antrian->count() }} pengajuan</div>
                <div>Refresh untuk melihat status terbaru</div>
            </div>
        @endif
    </div>
@endsection
