@extends('admin.layouts.app') {{-- atau layout admin kamu --}}

@section('content')
<div class="max-w-6xl mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">{{ $title }}</h1>
        <a href="{{ route('admin.jenis-surat.form') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah</a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="w-full table-auto border-collapse">
            <thead class="bg-gray-100">
                <tr class="text-left">
                    <th class="p-3 border">#</th>
                    <th class="p-3 border">Nama Jenis</th>
                    <th class="p-3 border">Deskripsi</th>
                    <th class="p-3 border">Jumlah Field</th>
                    <th class="p-3 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jenisSurat as $index => $item)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3 border">{{ $index + 1 }}</td>
                        <td class="p-3 border">{{ $item->nama_jenis }}</td>
                        <td class="p-3 border">{{ Str::limit($item->deskripsi, 50) }}</td>
                        <td class="p-3 border">{{ is_array($item->form_fields) ? count($item->form_fields) : count(json_decode($item->form_fields, true)) }}</td>
                        <td class="p-3 border space-x-2">
                            <a href="{{ route('admin.jenis-surat.form', $item->id) }}" class="text-blue-600 hover:underline">Edit</a>

                            <form action="{{ route('admin.jenis-surat.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-4 text-gray-500">Belum ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
