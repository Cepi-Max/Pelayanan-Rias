@extends('admin.layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-6">
    <div class="flex justify-between">
        <h1 class="text-2xl font-bold mb-4">Daftar Pengajuan Surat</h1>
        <div class="flex space-x-2 mb-4">
            <a href="{{ route('admin.antrian.index') }}"
                class="px-4 py-2 rounded {{ request('status') === null ? 'bg-gray-800 text-white' : 'bg-gray-200 text-gray-700' }}">
                Semua
            </a>
            <a href="{{ route('admin.antrian.index', ['status' => 'pending']) }}"
                class="px-4 py-2 rounded {{ request('status') === 'pending' ? 'bg-yellow-500 text-white' : 'bg-yellow-100 text-yellow-800' }}">
                Pending
            </a>
            <a href="{{ route('admin.antrian.index', ['status' => 'ditolak']) }}"
                class="px-4 py-2 rounded {{ request('status') === 'ditolak' ? 'bg-red-500 text-white' : 'bg-red-100 text-red-800' }}">
                Ditolak
            </a>
             <a href="{{ route('admin.antrian.index', ['status' => 'diproses']) }}"
                class="px-4 py-2 rounded {{ request('status') === 'diproses' ? 'bg-blue-500 text-white' : 'bg-blue-100 text-blue-800' }}">
                Diproses
            </a>
             <a href="{{ route('admin.antrian.index', ['status' => 'selesai']) }}"
                class="px-4 py-2 rounded {{ request('status') === 'selesai' ? 'bg-green-500 text-white' : 'bg-green-100 text-green-800' }}">
                Selesai
            </a>
        </div>

    </div>
        

    @if ($pengajuans->isEmpty())
        <p class="text-gray-600">Belum ada pengajuan surat.</p>
    @else
        <div class="overflow-x-auto bg-white shadow rounded-lg mt-4">
            <table class="min-w-full table-auto text-left border">
                <thead class="bg-indigo-100 text-indigo-900">
                    <tr>
                        <th class="px-4 py-3 border">#</th>
                        <th class="px-4 py-3 border">Nama Pengaju</th>
                        <th class="px-4 py-3 border">Jenis Surat</th>
                        <th class="px-4 py-3 border">Tanggal Pengajuan</th>
                        <th class="px-4 py-3 border">Status</th>
                        <th class="px-4 py-3 border">Detail</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800">
                    @foreach ($pengajuans as $i => $pengajuan)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $i + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $pengajuan->user->name }}</td>
                            <td class="px-4 py-2 border">{{ $pengajuan->jenisSurat->nama_jenis }}</td>
                            <td class="px-4 py-2 border">{{ $pengajuan->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-2 border">
                                <span class="inline-block px-3 py-1 text-sm rounded-full
                                    @if($pengajuan->status == 'pending') bg-yellow-200 text-yellow-800
                                    @elseif($pengajuan->status == 'ditolak') bg-red-200 text-red-800
                                    @elseif($pengajuan->status == 'diproses') bg-blue-200 text-blue-800 
                                    @elseif($pengajuan->status == 'selesai') bg-green-200 text-green-800 
                                    @endif">
                                    {{ ucfirst($pengajuan->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                <a href="{{ route('admin.antrian.show', $pengajuan->id) }}">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
