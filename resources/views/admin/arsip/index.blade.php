@extends('admin.layouts.app')
@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header dengan Tombol Tambah -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Arsip Pengajuan Selesai</h1>
        <a href="{{ route('admin.arsip.form') }}" 
           class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md transition-colors">
            <i class="fas fa-plus mr-2"></i>
            Tambah Arsip Manual
        </a>
    </div>

    <!-- Statistik Card (Optional) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <i class="fas fa-archive text-green-600"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-600">Total Arsip</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $arsip->total() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <i class="fas fa-file-alt text-blue-600"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-600">Bulan Ini</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $arsip->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-100 rounded-lg">
                    <i class="fas fa-plus text-yellow-600"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-600">Manual Entry</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $arsip->whereNull('pengajuan_id')->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section (Optional) -->
    <div class="bg-white rounded-lg shadow mb-6 p-4">
        <form method="GET" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-48">
                <label class="block text-sm font-medium text-gray-700 mb-1">Cari Nama</label>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Nama pengaju..." 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="flex-1 min-w-48">
                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Surat</label>
                <select name="jenis_surat" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Semua Jenis</option>
                    @foreach($jenisSurat ?? [] as $jenis)
                        <option value="{{ $jenis->id }}" {{ request('jenis_surat') == $jenis->id ? 'selected' : '' }}>
                            {{ $jenis->nama_jenis }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md mr-2">
                    <i class="fas fa-search mr-1"></i> Filter
                </button>
                <a href="{{ route('admin.arsip.index') }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-md">
                    <i class="fas fa-refresh mr-1"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Tabel Arsip -->
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 text-left text-sm font-semibold text-gray-700">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama Pengaju</th>
                    <th class="px-4 py-3">Jenis Surat</th>
                    <th class="px-4 py-3">Tanggal Arsip</th>
                    <th class="px-4 py-3">Sumber</th>
                    <th class="px-4 py-3">Dokumen</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100 text-sm">
                @forelse($arsip as $i => $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $arsip->firstItem() + $i }}</td>
                    <td class="px-4 py-2">
                        @if($item->pengajuan_id)
                            {{ $item->pengajuan->user->name ?? '-' }}
                        @else
                            {{ $item->nama ?? '-' }}
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        @if($item->pengajuan_id)
                            {{ $item->pengajuan->jenisSurat->nama_jenis ?? '-' }}
                        @else
                            {{ $item->jenisSurat->nama_jenis ?? '-' }}
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ $item->created_at->format('d M Y H:i') }}</td>
                    <td class="px-4 py-2">
                        @if($item->pengajuan_id)
                            <span class="inline-block px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">
                                online
                            </span>
                        @else
                            <span class="inline-block px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">
                                offline
                            </span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ asset('storage/dokumen/surat-selesai/' . $item->surat_diminta) }}"
                           target="_blank"
                           class="text-indigo-600 hover:underline">
                            <i class="fas fa-file-pdf mr-1"></i>Lihat Surat
                        </a>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex space-x-2">
                            @if(!$item->pengajuan_id)
                                <a href="{{ route('admin.arsip.edit', $item->id) }}" 
                                   class="text-blue-600 hover:text-blue-800" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.arsip.destroy', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800" 
                                            title="Hapus"
                                            onclick="return confirm('Yakin ingin menghapus arsip ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-2"></i>
                        <p>Belum ada arsip.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $arsip->appends(request()->query())->links() }}
    </div>
</div>
@endsection