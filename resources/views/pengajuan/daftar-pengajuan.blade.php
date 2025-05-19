@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Antrian Surat Anda</h2>

    @if($antrian->isEmpty())
        <div class="bg-yellow-100 text-yellow-800 p-4 rounded shadow">
            Belum ada surat yang anda ajukan saat ini.
        </div>
    @else
        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="min-w-full table-auto border border-gray-200">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left">#</th>
                        <th class="px-4 py-2 text-left">Jenis Surat</th>
                        <th class="px-4 py-2 text-left">Tanggal Pengajuan</th>
                        <th class="px-4 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($antrian as $i => $item)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $i + 1 }}</td>
                        <td class="px-4 py-2">{{ $item->jenisSurat->nama_jenis ?? '-' }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                        <td class="px-4 py-2">
                            <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
