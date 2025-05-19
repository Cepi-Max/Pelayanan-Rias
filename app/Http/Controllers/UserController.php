<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\PengajuanSelesai;
use App\Models\PengajuanSurat;
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
                    ->where('status', 'diproses')
                    ->latest()
                    ->get();
        $data = [
            'title' => 'Pengajuan Saya',
            'antrian' => $pengajuan,
        ];

        return view('pengajuan.daftar-pengajuan', $data);
    }

    function riwayatPengajuan()
    {
        $user = Auth::user();

        $riwayat = PengajuanSelesai::with(['pengajuan.jenisSurat'])
            ->whereHas('pengajuan', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->latest()
            ->paginate(10);

        $data = [
            'title' => 'Riwayat Pengajuan Surat',
            'riwayat' => $riwayat
        ];

        return view('riwayat-pengajuan.index', $data);
    }
}
