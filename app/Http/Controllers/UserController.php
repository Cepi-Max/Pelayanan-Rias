<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\Notifikasi;
use App\Models\PengajuanSelesai;
use App\Models\PengajuanSurat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //
    function daftarPengajuan()
    {
        $userId = Auth::id();
        $pengajuan = PengajuanSurat::with('jenisSurat')
                    ->where('user_id', $userId)
                    ->whereNot('status', 'ditolak')
                    ->latest()
                    ->get();
        $data = [
            'title' => 'Pengajuan Saya',
            'pengajuan' => $pengajuan,
        ];

        return view('pengajuan.daftar-pengajuan', $data);
    }

    // Tambahkan method ini di Controller riwayat pengajuan
    public function detailPengajuan($id)
    {
            $pengajuan = PengajuanSurat::with(['user', 'jenisSurat'])
                ->where('id', $id)
                ->where('user_id', Auth::id()) // Pastikan hanya user yang bersangkutan
                ->firstOrFail();
                // dd($pengajuan->data_pengajuan);
            
            // data_pengajuan sudah berupa array karena Laravel auto-casting untuk tipe JSON
            $dataPengajuan = $pengajuan->data_pengajuan;

            $data = [
                'title' => 'Detail Pengajuan',
                'pengajuan' => $pengajuan,
                'dataPengajuan' => $dataPengajuan
            ];
            
            // Generate HTML content
            return view('partials.detail-pengajuan-modal', $data)->render();
    }

    public function riwayatPengajuan()
    {
        $riwayatSelesai = PengajuanSurat::where('user_id', Auth::id())
            ->where('status', 'selesai')
            ->with('jenisSurat')
            ->orderBy('updated_at', 'desc')
            ->paginate(10, ['*'], 'selesai');
        
        $riwayatDitolak = PengajuanSurat::where('user_id', Auth::id())
            ->where('status', 'ditolak')
            ->with('jenisSurat')
            ->orderBy('updated_at', 'desc')
            ->paginate(10, ['*'], 'ditolak');

        $pengajuan = PengajuanSurat::with(['user', 'jenisSurat'])
                ->where('user_id', Auth::id()) // Pastikan hanya user yang bersangkutan
                ->firstOrFail();
                // dd($pengajuan->data_pengajuan);
            
            // data_pengajuan sudah berupa array karena Laravel auto-casting untuk tipe JSON
            $dataPengajuan = $pengajuan->data_pengajuan;

         $data = [
            'title' => 'Riwayat Pengajuan Surat',
            'riwayatSelesai' => $riwayatSelesai,
            'riwayatDitolak' => $riwayatDitolak,
            'pengajuan' => $pengajuan,
                'dataPengajuan' => $dataPengajuan
        ];

        return view('riwayat-pengajuan.index', $data);
    }

    function downloadSurat($id)
    {
        // Cari notifikasi terkait pengajuan ini
        $notifikasi = Notifikasi::where('pengajuan_surat_id', $id)->first();
        
        if ($notifikasi && !$notifikasi->sudah_dibaca_masyarakat) {
            $notifikasi->update([
                'sudah_dibaca_masyarakat' => true,
                'dibaca_masyarakat_pada' => now(),
            ]);
        }

        $surat = PengajuanSelesai::findOrFail($id);
        $fileName = $surat->surat_diminta;
        $filePath = 'dokumen/surat-selesai/' . $fileName;

        if (!Storage::disk('public')->exists($filePath)) {
            return back()->with('error', 'File surat belum tersedia.');
        }
        
        return Storage::disk('public')->download($filePath, $fileName);
    }
}
