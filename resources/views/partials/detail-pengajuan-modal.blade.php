@extends('layouts.app')

@section('content')

{{-- File: resources/views/partials/detail-pengajuan-modal.blade.php --}}
<div class="space-y-4">
    <!-- Header Info -->
    <div class="bg-gray-50 p-4 rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <h4 class="font-semibold text-gray-700 mb-2">Informasi Pengajuan</h4>
                <div class="space-y-1">
                    <p class="text-sm"><span class="font-medium">ID Pengajuan:</span> #{{ $pengajuan->id }}</p>
                    <p class="text-sm"><span class="font-medium">Jenis Surat:</span> {{ $pengajuan->jenisSurat->nama_jenis ?? '-' }}</p>
                    <p class="text-sm"><span class="font-medium">Tanggal Pengajuan:</span> {{ $pengajuan->created_at->format('d M Y H:i') }}</p>
                    <p class="text-sm"><span class="font-medium">Tanggal Update:</span> {{ $pengajuan->updated_at->format('d M Y H:i') }}</p>
                </div>
            </div>
            <div>
                <h4 class="font-semibold text-gray-700 mb-2">Status & Catatan</h4>
                <div class="space-y-2">
                    <div>
                        @if($pengajuan->status == 'selesai')
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i> Selesai
                            </span>
                        @elseif($pengajuan->status == 'ditolak')
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                <i class="fas fa-times-circle mr-1"></i> Ditolak
                            </span>
                        @elseif($pengajuan->status == 'diproses')
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                <i class="fas fa-clock mr-1"></i> Diproses
                            </span>
                        @else
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                <i class="fas fa-hourglass-half mr-1"></i> Pending
                            </span>
                        @endif
                    </div>
                    @if($pengajuan->catatan)
                        <div class="text-sm">
                            <span class="font-medium">Catatan:</span>
                            <p class="mt-1 text-gray-600 bg-white p-2 rounded border">{{ $pengajuan->catatan }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Data Pengajuan -->
    <div class="bg-white border rounded-lg p-4">
        <h4 class="font-semibold text-gray-700 mb-3">Data Pengajuan</h4>
        
        @if($dataPengajuan && is_array($dataPengajuan))
            <div class="grid grid-cols-1 gap-3">
                @foreach($dataPengajuan as $key => $value)
                    @if(!empty($value) && $key !== 'files') {{-- Skip empty values and files --}}
                        <div class="flex flex-col sm:flex-row">
                            <div class="sm:w-1/3 font-medium text-gray-600 capitalize mb-1 sm:mb-0">
                                {{ str_replace(['_', '-'], ' ', $key) }}:
                            </div>
                            <div class="sm:w-2/3 text-gray-800">
                                @if(is_array($value))
                                    <ul class="list-disc list-inside space-y-1">
                                        @foreach($value as $item)
                                            <li class="text-sm">{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                @elseif(in_array($key, ['tanggal_lahir', 'tanggal_nikah', 'tanggal_meninggal', 'tanggal_kejadian']))
                                    {{ \Carbon\Carbon::parse($value)->format('d M Y') }}
                                @elseif(strlen($value) > 100)
                                    <div class="bg-gray-50 p-2 rounded text-sm">{{ $value }}</div>
                                @else
                                    {{ $value }}
                                @endif
                            </div>
                        </div>
                        <hr class="border-gray-200">
                    @endif
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-sm">Tidak ada data pengajuan tersimpan</p>
        @endif
    </div>

    <!-- Files/Documents -->
    @if(isset($dataPengajuan['files']) && is_array($dataPengajuan['files']) && count($dataPengajuan['files']) > 0)
        <div class="bg-white border rounded-lg p-4">
            <h4 class="font-semibold text-gray-700 mb-3">Dokumen Pendukung</h4>
            <div class="space-y-2">
                @foreach($dataPengajuan['files'] as $fileName => $filePath)
                    <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                        <div class="flex items-center">
                            <i class="fas fa-file-alt text-blue-600 mr-2"></i>
                            <span class="text-sm text-gray-700">{{ $fileName }}</span>
                        </div>
                        <a href="{{ asset('storage/' . $filePath) }}" target="_blank" 
                           class="text-blue-600 hover:text-blue-800 text-sm">
                            <i class="fas fa-external-link-alt mr-1"></i>Lihat
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="flex justify-end space-x-2 pt-4 border-t">
        @if($pengajuan->status == 'selesai')
            <a href="{{ route('download-pdf', $pengajuan->id) }}" target="_blank"
               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors">
                <i class="fas fa-download mr-2"></i>
                Download Surat
            </a>
        @elseif($pengajuan->status == 'ditolak')
            {{-- <a href="{{ route('pengajuan.create', ['resubmit' => $pengajuan->id]) }}"
               class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md transition-colors">
                <i class="fas fa-redo mr-2"></i>
                Ajukan Ulang
            </a> --}}
        @endif
        
        <button onclick="closeModal()" 
                class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-md transition-colors">
            <i class="fas fa-times mr-2"></i>
            Tutup
        </button>
    </div>
</div>

@endsection