@extends('admin.layouts.app')
@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.arsip.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-2xl font-semibold text-gray-800">Tambah Arsip Manual</h1>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.arsip.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <!-- Alert Error -->
            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan:</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Nama Pengaju -->
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Pengaju <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="nama" 
                       name="nama" 
                       value="{{ old('nama') }}"
                       placeholder="Masukkan nama lengkap pengaju"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('nama') border-red-500 @enderror"
                       required>
                @error('nama')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jenis Surat -->
            <div>
                <label for="jenis_surat_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Jenis Surat <span class="text-red-500">*</span>
                </label>
                <select id="jenis_surat_id" 
                        name="jenis_surat_id" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('jenis_surat_id') border-red-500 @enderror"
                        required>
                    <option value="">Pilih Jenis Surat</option>
                    @foreach($jenisSurat as $jenis)
                        <option value="{{ $jenis->id }}" {{ old('jenis_surat_id') == $jenis->id ? 'selected' : '' }}>
                            {{ $jenis->nama_jenis }}
                        </option>
                    @endforeach
                </select>
                @error('jenis_surat_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal -->
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700 mb-2">
                    Tanggal
                </label>
                <input type="date" 
                    id="date" 
                    name="date" 
                    value="{{ old('date', date('Y-m-d')) }}"
                    placeholder="Masukkan tanggal"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('date') border-red-500 @enderror"
                    required>
                @error('date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Upload Dokumen -->
            <div>
                <label for="surat_diminta" class="block text-sm font-medium text-gray-700 mb-2">
                    Upload Dokumen Surat <span class="text-red-500">*</span>
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-400 transition-colors">
                    <input type="file" 
                           id="surat_diminta" 
                           name="surat_diminta" 
                           accept=".pdf,.jpg,.jpeg,.png"
                           class="hidden"
                           onchange="handleFileSelect(this)"
                           required>
                    <label for="surat_diminta" class="cursor-pointer">
                        <div class="space-y-2">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                            <div class="text-sm text-gray-600">
                                <span class="font-medium text-indigo-600 hover:text-indigo-500">Klik untuk upload</span>
                                atau drag and drop
                            </div>
                            <p class="text-xs text-gray-500">PDF, JPG, JPEG, PNG hingga 5MB</p>
                        </div>
                    </label>
                    <div id="file-info" class="mt-3 hidden">
                        <div class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-green-100 text-green-800">
                            <i class="fas fa-file mr-2"></i>
                            <span id="file-name"></span>
                            <button type="button" onclick="removeFile()" class="ml-2 text-green-600 hover:text-green-800">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @error('surat_diminta')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3 pt-6 border-t">
                <a href="{{ route('admin.arsip.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <i class="fas fa-save mr-2"></i>Simpan Arsip
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function handleFileSelect(input) {
    const fileInfo = document.getElementById('file-info');
    const fileName = document.getElementById('file-name');
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const maxSize = 5 * 1024 * 1024; // 5MB
        
        if (file.size > maxSize) {
            alert('File terlalu besar! Maksimal 5MB');
            input.value = '';
            return;
        }
        
        fileName.textContent = file.name;
        fileInfo.classList.remove('hidden');
    }
}

function removeFile() {
    document.getElementById('surat_diminta').value = '';
    document.getElementById('file-info').classList.add('hidden');
}

// Drag and drop functionality
const dropArea = document.querySelector('.border-dashed');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, unhighlight, false);
});

function highlight(e) {
    dropArea.classList.add('border-indigo-400', 'bg-indigo-50');
}

function unhighlight(e) {
    dropArea.classList.remove('border-indigo-400', 'bg-indigo-50');
}

dropArea.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    
    if (files.length > 0) {
        document.getElementById('surat_diminta').files = files;
        handleFileSelect(document.getElementById('surat_diminta'));
    }
}
</script>
@endsection