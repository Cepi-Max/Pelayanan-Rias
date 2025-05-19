@extends('admin.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-6 bg-white shadow rounded p-6">
    <h2 class="text-2xl font-semibold mb-4">Detail Pengajuan Surat</h2>

    <div class="mb-6">
        <p><strong>Nama Pemohon:</strong> {{ $pengajuan->user->name }}</p>
        <p><strong>Jenis Surat:</strong> {{ $pengajuan->jenisSurat->nama_jenis }}</p>
        <p><strong>Tanggal Pengajuan:</strong> {{ $pengajuan->created_at->format('d M Y H:i') }}</p>
        <p><strong>Status:</strong>
            <span class="px-2 py-1 rounded text-sm font-semibold
            @if($pengajuan->status == 'pending') bg-yellow-200 text-yellow-800
            @elseif($pengajuan->status == 'ditolak') bg-red-200 text-red-800
            @elseif($pengajuan->status == 'diproses') bg-blue-200 text-blue-800
            @elseif($pengajuan->status == 'selesai') bg-green-200 text-green-800
            @endif">
            {{ ucfirst($pengajuan->status) }}
        </span>
        </p>
        <p><strong>Email:</strong> {{ $pengajuan->user->email }}</p>
    </div>

    <h3 class="text-lg font-semibold mb-2">Data Pengajuan:</h3>
    <div class="space-y-3">
        @php use Illuminate\Support\Str; @endphp
        @foreach ($pengajuan->data_pengajuan as $key => $value)
            <div>
                {{-- Label --}}
                <p class="text-sm text-gray-600 font-medium capitalize">{{ str_replace('_', ' ', $key) }}</p>

                @if (Str::contains($value, ['pdf', 'jpg', 'png']))
                    {{-- Nilai Kolom Jika File --}}
                    <a href="{{ asset('storage/' . $value) }}" target="_blank" class="text-blue-600 underline">
                        Lihat Berkas ({{ basename($value) }})
                    </a>
                @else
                    {{-- Nilai Kolom Jika Bukan File --}}
                    <p class="text-base text-gray-900">{{ $value }}</p>
                @endif
            </div>
        @endforeach

    </div>

    @if ($pengajuan->status === 'pending')
        <form action="{{ route('admin.antrian.updateStatus', $pengajuan->id) }}" method="POST" class="mt-6 flex gap-4">
            @csrf
            <div class="flex flex-col w-full">
                <div class="flex gap-4">
                    <button name="status" value="diproses" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Setujui
                    </button>
                    <button name="status" value="ditolak" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                        Tolak
                    </button>
                </div>
                <h6 class="mt-4">Pesan Opsional:</h6>
                <textarea class="border border-2 border-gray-950" name="catatan" id="catatan" cols="30" rows="4" placeholder="tulis pesan untuk pengaju jika ada berkas yang tidak lengkap atau tidak valid"></textarea>
            </div>
        </form>
    @elseif ($pengajuan->status === 'diproses')
        <form action="{{ route('admin.antrian.surat-selesai', $pengajuan->id) }}" method="POST" enctype="multipart/form-data" class="mt-6 flex flex-col gap-4">
            @csrf
            <label>jika surat yang diminta sudah selesai dibikin, silahkan kirim melalui form ini:</label>
            <input type="file" name="surat_diminta">
            <button name="status" value="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Kirim
            </button>
        </form>
    @endif
</div>
@endsection