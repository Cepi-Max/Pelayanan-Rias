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

{{-- Ganti seluruh blok script Anda dengan yang ini --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const formFieldsWrapper = document.getElementById('form-fields-wrapper');
        const jsonTextarea = document.getElementById('form-fields-json');
        let formFields = [];

        try {
            formFields = JSON.parse(jsonTextarea.value || '[]');
            if (!Array.isArray(formFields)) formFields = [];
        } catch (e) {
            console.error("❌ Gagal parse JSON:", e);
            formFields = [];
        }

        // --- FUNGSI UTAMA UNTUK MERENDER SETIAP BARIS FIELD ---
        function renderField(field = { name: '', type: 'text', label: '', options: '' }) {
            const div = document.createElement('div');
            div.className = 'field-row bg-gray-50 p-3 rounded-md border border-gray-200 space-y-2';

            // Bagian atas: Label, Name, Type, dan Tombol Hapus
            div.innerHTML = `
                <div class="flex gap-2 items-center">
                    <input type="text" placeholder="Label" class="border rounded p-2 w-1/3 field-label" value="${field.label || ''}">
                    <input type="text" placeholder="Name (tanpa spasi, cth: nama_lengkap)" class="border rounded p-2 w-1/3 field-name" value="${field.name || ''}">
                    <select class="border rounded p-2 w-1/3 field-type">
                        <option value="text" ${field.type === 'text' ? 'selected' : ''}>Text</option>
                        <option value="textarea" ${field.type === 'textarea' ? 'selected' : ''}>Textarea</option>
                        <option value="file" ${field.type === 'file' ? 'selected' : ''}>File</option>
                        <option value="number" ${field.type === 'number' ? 'selected' : ''}>Number</option>
                        <option value="date" ${field.type === 'date' ? 'selected' : ''}>Date</option>
                        <option value="select" ${field.type === 'select' ? 'selected' : ''}>Select</option>
                    </select>
                    <button type="button" class="remove-field text-red-600 px-2" title="Hapus field">✖</button>
                </div>
                <div class="options-wrapper mt-2 border-t pt-2 border-gray-200"></div> {{-- Wadah untuk SEMUA UI opsi --}}
            `;
            formFieldsWrapper.appendChild(div);

            // --- Event Listener untuk input & select utama ---
            div.querySelectorAll('input.field-label, input.field-name').forEach(input => input.addEventListener('input', syncJson));
            div.querySelector('.remove-field').addEventListener('click', () => { div.remove(); syncJson(); });
            div.querySelector('.field-type').addEventListener('change', (e) => {
                toggleOptionsUI(e.target.value);
                syncJson();
            });

            // --- FUNGSI BARU: untuk membuat UI Opsi (wadah, list, dan tombol tambah) ---
            function toggleOptionsUI(type) {
                const optionsWrapper = div.querySelector('.options-wrapper');
                optionsWrapper.innerHTML = ''; // Selalu kosongkan dulu

                if (type === 'select') {
                    // Buat wadah untuk daftar input opsi
                    const optionsListContainer = document.createElement('div');
                    optionsListContainer.className = 'options-list space-y-2';
                    
                    // Buat tombol "Tambah Opsi"
                    const addOptionBtn = document.createElement('button');
                    addOptionBtn.type = 'button';
                    addOptionBtn.className = 'add-option-btn mt-2 px-2 py-1 bg-blue-500 text-white text-xs rounded';
                    addOptionBtn.textContent = '+ Tambah Opsi';
                    addOptionBtn.addEventListener('click', () => {
                        renderSingleOptionInput(optionsListContainer); // Tambah opsi kosong baru
                        syncJson();
                    });
                    
                    optionsWrapper.appendChild(optionsListContainer);
                    optionsWrapper.appendChild(addOptionBtn);

                    // Ambil opsi yang sudah ada (jika ada) dan render
                    const existingOptions = (field.options || '').split(',').filter(Boolean);
                    if (existingOptions.length > 0) {
                        existingOptions.forEach(opt => renderSingleOptionInput(optionsListContainer, opt));
                    } else {
                        // Jika belum ada opsi, buat satu yang kosong
                        renderSingleOptionInput(optionsListContainer);
                    }
                }
            }

            // --- FUNGSI BARU: untuk membuat SATU baris input opsi ---
            function renderSingleOptionInput(container, value = '') {
                const optionDiv = document.createElement('div');
                optionDiv.className = 'flex gap-2 items-center single-option-row';
                optionDiv.innerHTML = `
                    <input type="text" placeholder="Tulis opsi..." class="border rounded p-1 flex-grow field-option-item" value="${value}">
                    <button type="button" class="remove-option-btn text-red-500 text-xs px-1" title="Hapus opsi">✖</button>
                `;
                container.appendChild(optionDiv);

                optionDiv.querySelector('.remove-option-btn').addEventListener('click', () => {
                    optionDiv.remove();
                    syncJson();
                });
                optionDiv.querySelector('.field-option-item').addEventListener('input', syncJson);
            }

            // Panggil fungsi toggle ini saat pertama kali render
            toggleOptionsUI(div.querySelector('.field-type').value);
        }

        // --- FUNGSI SINKRONISASI DATA KE JSON (Diperbarui) ---
        function syncJson() {
            const data = [];
            formFieldsWrapper.querySelectorAll('.field-row').forEach(div => {
                const type = div.querySelector('.field-type').value;
                const fieldData = {
                    label: div.querySelector('.field-label').value,
                    name: div.querySelector('.field-name').value.replace(/\s+/g, '_').toLowerCase(),
                    type: type,
                };

                // Jika tipenya 'select', kumpulkan semua nilai opsi menjadi satu string
                if (type === 'select') {
                    const optionInputs = div.querySelectorAll('.field-option-item');
                    const options = Array.from(optionInputs)
                                        .map(input => input.value.trim()) // Ambil nilai & hapus spasi
                                        .filter(Boolean); // Hapus opsi yang kosong
                    fieldData.options = options.join(','); // Gabungkan dengan koma
                }
                data.push(fieldData);
            });
            jsonTextarea.value = JSON.stringify(data, null, 2);
        }

        // --- Inisialisasi ---
        formFields.forEach(field => renderField(field));
        document.getElementById('add-field-btn').addEventListener('click', () => {
            renderField();
            syncJson();
        });
        syncJson();
    });
</script>

@endsection
