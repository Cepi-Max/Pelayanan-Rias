<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\PengajuanSelesai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PengajuanSelesai::with(['pengajuan.user', 'pengajuan.jenisSurat', 'jenisSurat'])
            ->orderBy('created_at', 'desc');

        // Filter pencarian nama
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhereHas('pengajuan.user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter jenis surat
        if ($request->filled('jenis_surat')) {
            $query->where(function($q) use ($request) {
                $q->where('jenis_surat_id', $request->jenis_surat)
                  ->orWhereHas('pengajuan', function($q) use ($request) {
                      $q->where('jenis_surat_id', $request->jenis_surat);
                  });
            });
        }

        $arsip = $query->paginate(15);
        $jenisSurat = JenisSurat::orderBy('nama_jenis')->get();

        return view('admin.arsip.index', compact('arsip', 'jenisSurat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function form()
    {
        $jenisSurat = JenisSurat::orderBy('nama_jenis')->get();
        return view('admin.arsip.form', compact('jenisSurat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_surat_id' => 'required|exists:jenis_surat,id',
            'surat_diminta' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120', // 5MB
            'catatan' => 'nullable|string|max:1000'
        ], [
            'nama.required' => 'Nama pengaju harus diisi',
            'jenis_surat_id.required' => 'Jenis surat harus dipilih',
            'jenis_surat_id.exists' => 'Jenis surat tidak valid',
            'surat_diminta.required' => 'File surat harus diupload',
            'surat_diminta.mimes' => 'Format file harus PDF, JPG, JPEG, atau PNG',
            'surat_diminta.max' => 'Ukuran file maksimal 5MB'
        ]);

        // dd($request->nama);
            // Upload file
            $file = $request->file('surat_diminta'); 
            $fileName = now()->format('Y-m-d_H-i-s') . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $filePath   = 'dokumen/surat-selesai/'.$fileName;
            Storage::disk('public')->put($filePath, file_get_contents($file));

            // Simpan ke database
            PengajuanSelesai::create([
                'nama' => $request->nama,
                'jenis_surat_id' => $request->jenis_surat_id,
                'pengajuan_id' => null, // Manual entry
                'surat_diminta' => $fileName,
                'catatan' => $request->catatan
            ]);

            return redirect()->route('admin.arsip.index')
                ->with('success', 'Arsip berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PengajuanSelesai $arsip)
    {
        $arsip->load(['pengajuan.user', 'pengajuan.jenisSurat', 'jenisSurat']);
        return view('admin.arsip.show', compact('arsip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengajuanSelesai $arsip)
    {
        // Cek apakah arsip adalah arsip otomatis (memiliki pengajuan_id)
        if ($arsip->pengajuan_id) {
            return redirect()->route('admin.arsip.index')
                ->with('error', 'Arsip otomatis tidak dapat diedit!');
        }

        // Ambil semua jenis surat dan urutkan berdasarkan nama
        $jenisSurat = JenisSurat::orderBy('nama_jenis')->get();

        return view('admin.arsip.edit', compact('arsip', 'jenisSurat'));
    }

    public function update(Request $request, PengajuanSelesai $arsip)
    {
        // Cek apakah arsip adalah arsip otomatis
        if ($arsip->pengajuan_id) {
            return redirect()->route('admin.arsip.index')
                ->with('error', 'Arsip otomatis tidak dapat diubah!');
        }

        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_surat_id' => 'required|exists:jenis_surat,id',
            'date' => 'required|date',
            'surat_diminta' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120', // max 5MB
            'catatan' => 'nullable|string|max:1000'
        ], [
            'nama.required' => 'Nama pengaju harus diisi',
            'jenis_surat_id.required' => 'Jenis surat harus dipilih',
            'jenis_surat_id.exists' => 'Jenis surat tidak valid',
            'surat_diminta.mimes' => 'Format file harus PDF, JPG, JPEG, atau PNG',
            'surat_diminta.max' => 'Ukuran file maksimal 5MB'
        ]);


            // Handle upload file baru jika ada
            if ($request->hasFile('surat_diminta')) {
                $file = $request->file('surat_diminta');
                $directory = 'dokumen/surat-selesai'; // Tentukan direktori agar konsisten

                // 1. Hapus file lama terlebih dahulu (jika ada)
                // Cek apakah ada record file lama di database
                if ($arsip->surat_diminta) {
                    // Rekonstruksi path lengkap file lama dari nama file yang tersimpan
                    $oldFilePath = $directory . '/' . $arsip->surat_diminta;

                    // Cek apakah file lama benar-benar ada di storage sebelum dihapus
                    if (Storage::disk('public')->exists($oldFilePath)) {
                        Storage::disk('public')->delete($oldFilePath); // Hapus dengan path yang benar
                    }
                }

                // 2. Upload file baru dengan cara yang lebih efisien
                // Buat nama file baru yang unik
                $fileName = now()->format('Y-m-d_H-i-s') . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

                // Gunakan storeAs() untuk menyimpan file. Ini lebih efisien dan direkomendasikan.
                // Metode ini akan menyimpan file dan mengembalikan path lengkapnya, tapi kita hanya butuh nama filenya.
                $file->storeAs($directory, $fileName, 'public');

                // 3. Siapkan data nama file baru untuk disimpan ke database
                // $data['surat_diminta'] = $fileName;
            }

            // Persiapkan data untuk update
            $data = [
                'nama' => $request->nama,
                'jenis_surat_id' => $request->jenis_surat_id,
                'date' => $request->date,
                'surat_diminta' => $fileName,
                'catatan' => $request->catatan,
            ];

            // Update data arsip
            $arsip->update($data);

            return redirect()->route('admin.arsip.index')
                ->with('success', 'Arsip berhasil diperbarui!');

    }

    public function destroy(PengajuanSelesai $arsip)
    {
        // Cek apakah arsip adalah arsip otomatis (logika ini sudah benar)
        if ($arsip->pengajuan_id) {
            return redirect()->route('admin.arsip.index')
                ->with('error', 'Arsip otomatis tidak dapat dihapus!');
        }

        // --- BAGIAN YANG DIPERBAIKI ---

        // 1. Tentukan direktori tempat file disimpan.
        //    (Sesuaikan jika path ini berbeda dengan yang di fungsi store/update Anda)
        $directory = 'dokumen/surat-selesai';

        // 2. Cek apakah ada nama file yang tersimpan di database
        if ($arsip->surat_diminta) {
            // 3. Gabungkan direktori dan nama file untuk mendapatkan path lengkap
            $filePath = $directory . '/' . $arsip->surat_diminta;

            // 4. Gunakan path lengkap untuk mengecek dan menghapus file
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
        }
        // --- AKHIR BAGIAN YANG DIPERBAIKI ---

        // Hapus data dari database
        $arsip->delete();

        return redirect()->route('admin.arsip.index')
            ->with('success', 'Arsip berhasil dihapus!');
    }
}
