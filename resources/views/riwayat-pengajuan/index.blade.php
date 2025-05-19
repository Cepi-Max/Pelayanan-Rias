@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Riwayat Surat Selesai</h1>

    @if($riwayat->count())
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto text-sm text-gray-700">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">Tanggal Selesai</th>
                        <th class="px-4 py-2">Jenis Surat</th>
                        <th class="px-4 py-2">Surat Diminta</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayat as $item)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $item->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-2">{{ $item->pengajuan->jenisSurat->nama_jenis ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $item->surat_diminta }}</td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('download-pdf', $item->id) }}" target="_blank"
                                   class="text-blue-600 hover:underline">Lihat Surat</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $riwayat->links() }}
        </div>
    @else
        <p class="text-center text-gray-500">Belum ada surat selesai.</p>
    @endif
</div>
@endsection
