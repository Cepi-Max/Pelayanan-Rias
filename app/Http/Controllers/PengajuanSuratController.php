<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\PengajuanSurat;
use Illuminate\Http\Request;

class PengajuanSuratController extends Controller
{
    //
    public function form($slug)
    {
        $jenisSurat = JenisSurat::where('slug', $slug)->firstOrFail();

        $formFields = is_array($jenisSurat->form_fields)
            ? $jenisSurat->form_fields
            : json_decode($jenisSurat->form_fields, true);

        $data = [
            'title' => 'Formulir Pengajuan Surat',
            'jenisSurat' => $jenisSurat,
            'formFields' => $formFields,
        ];

        return view('form-pengajuan.index', $data);
    }

    public function store(Request $request)
    {
        // Validasi request
        $validated = $request->validate([
            'jenis_surat_id' => 'required|exists:jenis_surat,id',
            // Tambahkan validasi untuk field-field lainnya sesuai kebutuhan
        ]);
        
        // Membuat array untuk data pengajuan
        $dataPengajuan = [];
        
        // Mengambil jenis surat
        $jenisSurat = JenisSurat::find($request->jenis_surat_id);
        $formFields = is_string($jenisSurat->form_fields) 
        ? json_decode($jenisSurat->form_fields, true) 
        : $jenisSurat->form_fields;
        
        // Memproses setiap field dari form
        foreach ($formFields as $field) {
            $fieldName = $field['name'];
            
            // Jika field berupa file
            if ($field['type'] === 'file' && $request->hasFile($fieldName)) {
                // Upload file ke storage
                $path = $request->file($fieldName)->store('dokumen', 'public');
                $dataPengajuan[$fieldName] = $path;
            } else {
                // Jika bukan file, simpan nilai input biasa
                $dataPengajuan[$fieldName] = $request->input($fieldName);
            }
        }
        
        // Membuat pengajuan surat baru
        $pengajuan = new PengajuanSurat();
        $pengajuan->user_id = auth()->id();
        $pengajuan->jenis_surat_id = $request->jenis_surat_id;
        $pengajuan->data_pengajuan = $dataPengajuan;
        $pengajuan->status = 'pending';
        $pengajuan->save();
        
        return redirect()->route('dashboard.index')
            ->with('success', 'Pengajuan surat berhasil dibuat.');
    }
}
