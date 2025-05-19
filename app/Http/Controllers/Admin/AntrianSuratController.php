<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NotifikasiPengajuanSurat;
use App\Mail\NotifikasiPengajuanSuratSelesai;
use App\Models\PengajuanSelesai;
use App\Models\PengajuanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AntrianSuratController extends Controller
{
    //
    // $pengajuan = PengajuanSurat::where('user_id', auth()->id())->with('jenisSurat')->get();
    public function index(Request $request)
    {
        $query = PengajuanSurat::query();

        if ($request->has('status') && $request->status !== null) {
            $query->where('status', $request->status);
        }

        $pengajuan = $query->get();

        $data = [
            'title' => 'Daftar Antrian Pengajuan',
            'pengajuans' => $pengajuan,
        ];

        return view('admin.pengajuan.index', $data);
    }


    public function show($id)
    {
        $pengajuan = PengajuanSurat::with(['user', 'jenisSurat'])->findOrFail($id);

        $data = [
            'title' => 'Detail Pengajuan',
            'pengajuan' => $pengajuan
        ];

        return view('admin.pengajuan.show', $data);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diproses,ditolak',
            'catatan' => 'nullable|string',
        ]);

        $pengajuan = PengajuanSurat::findOrFail($id);
        $pengajuan->status = $request->status;
        $pengajuan->catatan = $request->catatan;
        $pengajuan->save();

        // Siapkan data untuk email
        $judul = '';
        $pesan = '';

        if ($request->status === 'diproses') {
            $judul = 'Pengajuan Surat Diterima';
            $pesan = $request->catatan ?: 'Pengajuan surat kamu telah diterima dan sedang diproses.';
        } elseif ($request->status === 'ditolak') {
            $judul = 'Pengajuan Surat Ditolak';
            $pesan = $request->catatan ?: 'Pengajuan surat kamu ditolak. Silakan periksa kembali syarat yang dikirim.';
        }

        // Kirim email ke pengaju
        Mail::to($pengajuan->user->email)->send(new NotifikasiPengajuanSurat($judul, $pesan));

        return redirect()->route('admin.antrian.index')
            ->with('success', 'Status pengajuan berhasil diperbarui dan notifikasi telah dikirim ke pengaju.');
    }

    public function kirimPdf(Request $request, $id)
    {
        $request->validate([
            'surat_diminta' => 'required|mimes:pdf|max:10240',
        ], [
            'surat_diminta.required' => 'File PDF harus diunggah.',
            'surat_diminta.mimes' => 'File harus berformat PDF.',
            'surat_diminta.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
        ]);

        $pengajuan = PengajuanSurat::findOrFail($id);
        // dd('HAi');

        if ($request->hasFile('surat_diminta') && $request->file('surat_diminta')->isValid()) {
            $file = $request->file('surat_diminta'); 
            $fileName = now()->format('Y-m-d_H-i-s') . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path   = 'dokumen/surat-selesai/'.$fileName;
            Storage::disk('public')->put($path, file_get_contents($file));
        } 

        $pengajuanSelesai = new PengajuanSelesai;
        $pengajuanSelesai->pengajuan_id = $pengajuan->id;
        $pengajuanSelesai->surat_diminta = $fileName;
        $pengajuanSelesai->save();

        $pengajuan->status = 'selesai';
        $pengajuan->save();

        $judul = 'Surat Selesai';
        $pesan = 'Silahkan buka link untuk mendownload surat anda';
        $link = 'https://pelayanan-surat.pemdesrias.com/public/storage/dokumen/surat-selesai/' . $fileName;

        Mail::to($pengajuan->user->email)->send(new NotifikasiPengajuanSuratSelesai($judul, $pesan, $link));

        return redirect()->route('admin.antrian.index')
            ->with('success', 'Surat berhasil dikirim ke pengaju.');
    }

}
