@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Riwayat Pengajuan</h1>
    
    <!-- Tab Navigation -->
    <div class="mb-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8">
                <button id="tab-selesai" class="tab-button py-2 px-1 border-b-2 font-medium text-sm border-indigo-500 text-indigo-600">
                    Selesai ({{ $riwayatSelesai->total() }})
                </button>
                <button id="tab-ditolak" class="tab-button py-2 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    Ditolak ({{ $riwayatDitolak->total() }})
                </button>
            </nav>
        </div>
    </div>

    <!-- Tab Content: Selesai -->
    <div id="content-selesai" class="tab-content">
        @if($riwayatSelesai->count())
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full table-auto text-sm text-gray-700">
                    <thead class="bg-green-50">
                        <tr>
                            <th class="px-4 py-3 text-left">Tanggal Pengajuan</th>
                            <th class="px-4 py-3 text-left">Tanggal Selesai</th>
                            <th class="px-4 py-3 text-left">Jenis Surat</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riwayatSelesai as $item)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $item->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3">{{ $item->updated_at->format('d M Y') }}</td>
                            <td class="px-4 py-3">{{ $item->jenisSurat->nama_jenis ?? '-' }}</td>
                            <td class="px-4 py-3 text-center">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Selesai
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('download-pdf', $item->id) }}" target="_blank"
                                       class="inline-flex items-center px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded transition-colors">
                                        <i class="fas fa-download mr-1"></i>
                                        Download Surat
                                    </a>
                                    <a href="{{ route('pengajuan.detail', $item->id) }}"
                                       class="inline-flex items-center px-3 py-1 bg-gray-600 hover:bg-gray-700 text-white text-xs font-medium rounded transition-colors">
                                        <i class="fas fa-eye mr-1"></i>
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $riwayatSelesai->links() }}
            </div>
        @else
            <div class="text-center py-8">
                <i class="fas fa-inbox text-4xl text-gray-400 mb-4"></i>
                <p class="text-gray-500">Belum ada pengajuan yang selesai.</p>
            </div>
        @endif
    </div>

    <!-- Tab Content: Ditolak -->
    <div id="content-ditolak" class="tab-content hidden">
        @if($riwayatDitolak->count())
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full table-auto text-sm text-gray-700">
                    <thead class="bg-red-50">
                        <tr>
                            <th class="px-4 py-3 text-left">Tanggal Pengajuan</th>
                            <th class="px-4 py-3 text-left">Tanggal Ditolak</th>
                            <th class="px-4 py-3 text-left">Jenis Surat</th>
                            <th class="px-4 py-3 text-left">Surat Diminta</th>
                            <th class="px-4 py-3 text-left">Alasan Penolakan</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riwayatDitolak as $item)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $item->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3">{{ $item->updated_at->format('d M Y') }}</td>
                            <td class="px-4 py-3">{{ $item->jenisSurat->nama_jenis ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $item->surat_diminta }}</td>
                            <td class="px-4 py-3">
                                <div class="max-w-xs">
                                    <p class="text-red-600 text-sm">{{ $item->alasan_penolakan ?? 'Tidak ada keterangan' }}</p>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i>
                                    Ditolak
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('pengajuan.detail', $item->id) }}"
                                       class="inline-flex items-center px-3 py-1 bg-gray-600 hover:bg-gray-700 text-white text-xs font-medium rounded transition-colors">
                                        <i class="fas fa-eye mr-1"></i>
                                        Detail
                                    </a>
                                    {{-- <a href="{{ route('pengajuan-surat.form', ['slug' => $item->jenisSurat->id]) }}"
                                       class="inline-flex items-center px-3 py-1 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium rounded transition-colors">
                                        <i class="fas fa-redo mr-1"></i>
                                        Ajukan Ulang
                                    </a> --}}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $riwayatDitolak->links() }}
            </div>
        @else
            <div class="text-center py-8">
                <i class="fas fa-check-circle text-4xl text-gray-400 mb-4"></i>
                <p class="text-gray-500">Tidak ada pengajuan yang ditolak.</p>
            </div>
        @endif
    </div>
</div>

<!-- Modal Detail - Update bagian ini saja -->
<div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Detail Pengajuan</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div id="modalContent">
                <!-- Content akan diload via AJAX -->
                <div class="animate-pulse">
                    <div class="h-4 bg-gray-200 rounded w-3/4 mb-2"></div>
                    <div class="h-4 bg-gray-200 rounded w-1/2 mb-2"></div>
                    <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab functionality
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tabId = this.id.replace('tab-', '');
            
            // Update button styles
            tabButtons.forEach(btn => {
                btn.classList.remove('border-indigo-500', 'text-indigo-600');
                btn.classList.add('border-transparent', 'text-gray-500');
            });
            this.classList.remove('border-transparent', 'text-gray-500');
            this.classList.add('border-indigo-500', 'text-indigo-600');
            
            // Show/hide content
            tabContents.forEach(content => {
                content.classList.add('hidden');
            });
            document.getElementById(`content-${tabId}`).classList.remove('hidden');
        });
    });
});

function showDetail(id) {
    // Show loading state
    document.getElementById('modalContent').innerHTML = `
        <div class="animate-pulse">
            <div class="h-4 bg-gray-200 rounded w-3/4 mb-2"></div>
            <div class="h-4 bg-gray-200 rounded w-1/2 mb-2"></div>
            <div class="h-4 bg-gray-200 rounded w-5/6"></div>
        </div>
    `;
    document.getElementById('detailModal').classList.remove('hidden');
    
    // Fetch detail data
    fetch(`/pengajuan/${id}/detail`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('modalContent').innerHTML = data.html;
            } else {
                document.getElementById('modalContent').innerHTML = `
                    <div class="text-center py-4">
                        <i class="fas fa-exclamation-triangle text-red-500 text-2xl mb-2"></i>
                        <p class="text-red-600">Gagal memuat detail pengajuan</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('modalContent').innerHTML = `
                <div class="text-center py-4">
                    <i class="fas fa-exclamation-triangle text-red-500 text-2xl mb-2"></i>
                    <p class="text-red-600">Terjadi kesalahan saat memuat data</p>
                </div>
            `;
        });
}

function closeModal() {
    document.getElementById('detailModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('detailModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>
@endsection