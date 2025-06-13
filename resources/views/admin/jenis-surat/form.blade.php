@extends('admin.layouts.app') {{-- atau layout admin kamu --}}

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">{{ $title }}</h2>

    <form action="{{ $jenisSurat ? route('admin.jenis-surat.update', $jenisSurat->id) : route('admin.jenis-surat.store') }}" method="POST">
        @csrf
        @if($jenisSurat)
            @method('PUT')
        @endif

        <div class="mb-4">
            <label class="block text-gray-700">Nama Jenis Surat</label>
            <input type="text" name="nama_jenis" class="w-full border rounded p-2" value="{{ old('nama_jenis', $jenisSurat->nama_jenis ?? '') }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border rounded p-2" rows="3">{{ old('deskripsi', $jenisSurat->deskripsi ?? '') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Form Fields</label>
            <div id="form-fields-wrapper" class="space-y-2">
                <!-- Field items akan dimasukkan di sini -->
            </div>
            <button type="button" id="add-field-btn" class="mt-2 px-3 py-1 bg-green-600 text-white rounded">+ Tambah Field</button>
            @php
            $formFieldJson = old('form_fields', $jenisSurat->form_fields ?? '[]');
            if (is_array($formFieldJson)) {
                $formFieldJson = json_encode($formFieldJson, JSON_UNESCAPED_UNICODE);
            }
            @endphp
            <textarea name="form_fields" id="form-fields-json" class="hidden">{{ $formFieldJson }}</textarea>
            <small class="text-gray-500 block mt-1">Field akan otomatis dikonversi ke JSON</small>
        </div>


        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const formFieldsWrapper = document.getElementById('form-fields-wrapper');
    const jsonTextarea = document.getElementById('form-fields-json');
    
    // Ambil nilai JSON dari textarea dan parse
    let formFields = [];
    try {
        formFields = JSON.parse(jsonTextarea.value || '[]');
        if (!Array.isArray(formFields)) {
            console.warn("⚠️ formFields bukan array setelah parse");
            formFields = [];
        }
    } catch (e) {
        console.error("❌ Gagal parse JSON:", e);
        formFields = [];
    }

    function renderField(field = { name: '', type: '', label: '' }) {
        const div = document.createElement('div');
        div.className = 'flex gap-2 items-center';
        div.innerHTML = `
            <input type="text" placeholder="Label" class="border rounded p-2 w-1/3 field-label" value="${field.label || ''}">
            <input type="text" placeholder="Name" class="border rounded p-2 w-1/3 field-name" value="${field.name || ''}">
            <select class="border rounded p-2 w-1/3 field-type">
                <option value="text" ${field.type === 'text' ? 'selected' : ''}>Text</option>
                <option value="file" ${field.type === 'file' ? 'selected' : ''}>File</option>
                <option value="number" ${field.type === 'number' ? 'selected' : ''}>Number</option>
                <option value="date" ${field.type === 'date' ? 'selected' : ''}>Date</option>
            </select>
            <button type="button" class="remove-field text-red-600 px-2">✖</button>
        `;
        formFieldsWrapper.appendChild(div);
        div.querySelector('.remove-field').addEventListener('click', () => {
            div.remove();
            syncJson();
        });
        div.querySelectorAll('input, select').forEach(input => {
            input.addEventListener('input', syncJson);
        });
    }

    // render semua field yang sudah ada
    formFields.forEach(field => renderField(field));

    document.getElementById('add-field-btn').addEventListener('click', () => {
        renderField();
        syncJson();
    });

    function syncJson() {
        const data = [];
        formFieldsWrapper.querySelectorAll('div').forEach(div => {
            data.push({
                label: div.querySelector('.field-label').value,
                name: div.querySelector('.field-name').value,
                type: div.querySelector('.field-type').value,
            });
        });
        jsonTextarea.value = JSON.stringify(data);
    }
    
    // Panggil syncJson untuk memastikan data awal disimpan dengan benar
    syncJson();
});
</script>

@endsection
