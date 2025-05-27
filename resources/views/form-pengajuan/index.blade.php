@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto bg-white  p-6 rounded">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-3">
            <i class="fas fa-file-signature text-blue-600 text-3xl"></i>
            Formulir Pengajuan - <span class="text-indigo-700">{{ $jenisSurat->nama_jenis }}</span>
        </h2>


        <div class="flex flex-col md:flex-row gap-6">
            {{-- Form di kiri --}}
            <div class="md:w-2/3">
                <form action="{{ route('pengajuan-surat.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf
                    <input type="hidden" name="jenis_surat_id" value="{{ $jenisSurat->id }}">

                    @foreach ($formFields as $field)
                        <div>
                            <label for="{{ $field['name'] }}" class="block text-gray-700 font-semibold mb-1">
                                {{ $field['label'] }}
                            </label>

                            @if ($field['type'] === 'textarea')
                                <textarea name="{{ $field['name'] }}" id="{{ $field['name'] }}"
                                    class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-200" rows="4" required></textarea>
                            @else
                                <input type="{{ $field['type'] }}" name="{{ $field['name'] }}" id="{{ $field['name'] }}"
                                    class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-200"
                                    required>
                            @endif
                        </div>
                    @endforeach

                    <button type="submit"
                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
                        <i class="fas fa-paper-plane"></i> Kirim Pengajuan
                    </button>
                </form>
            </div>

            {{-- Alur Pengajuan di kanan --}}
            <div class="md:w-1/3 bg-indigo-50 border-l-4 border-indigo-400 p-4 rounded">
                <h3 class="text-lg font-semibold text-gray-700 mb-2 flex items-center gap-2">
                    <i class="fas fa-route text-green-600"></i> Alur Pengajuan
                </h3>
                <ol class="list-decimal list-inside text-gray-600 space-y-1 text-sm">
                    <li>Isi formulir dengan lengkap dan benar</li>
                    <li>Upload dokumen pendukung (jika ada)</li>
                    <li>Tekan tombol Kirim</li>
                    <li>Tunggu konfirmasi dari admin desa</li>
                    <li>Ambil surat di kantor desa / Unduh PDF</li>
                </ol>
            </div>
        </div>
    </div>
@endsection
