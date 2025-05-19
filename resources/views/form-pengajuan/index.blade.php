@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow p-6 rounded">
    <h2 class="text-2xl font-semibold mb-4">Form {{ $jenisSurat->nama_jenis }}</h2>
    
    <form action="{{ route('pengajuan-surat.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="jenis_surat_id" value="{{ $jenisSurat->id }}">
        
        @foreach ($formFields as $field)
        <div class="mb-4">
            <label for="{{ $field['name'] }}" class="block text-gray-700 font-bold mb-2">
                {{ $field['label'] }}
            </label>
            
            @if ($field['type'] === 'textarea')
                <textarea 
                    name="{{ $field['name'] }}" 
                    id="{{ $field['name'] }}"
                    class="w-full p-2 border rounded"
                    rows="4" 
                    required></textarea>
            @else
                <input 
                    type="{{ $field['type'] }}"
                    name="{{ $field['name'] }}"
                    id="{{ $field['name'] }}"
                    class="w-full p-2 border rounded"
                    required>
            @endif
        </div>
        @endforeach
        
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Submit
        </button>
    </form>

</div>
@endsection
