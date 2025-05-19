@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard1</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card 1 -->
        @forelse ($jenisSurat as $index => $js )
            <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-center justify-center h-16 w-16 bg-blue-100 text-blue-500 rounded-full mb-4 mx-auto">
                    <i class="fas fa-envelope text-2xl"></i>
                </div>
                <h2 class="text-lg font-semibold text-gray-800 text-center mb-2">{{ $js->nama_jenis }}</h2>
                <p class="text-gray-600 text-sm text-center mb-4">{{ $js->deskripsi }}</p>
                <a href="{{ route('pengajuan-surat.form', $js->slug) }}" class="block text-center bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors duration-300">
                    Pilih
                </a>
            </div>
        @empty
            
        @endforelse
       
    </div>
</div>
@endsection