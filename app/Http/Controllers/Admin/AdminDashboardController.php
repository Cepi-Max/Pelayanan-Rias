<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use App\Models\PengajuanSurat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        // Data statistik dasar
        $user = User::count();
        $totalHariIni = PengajuanSurat::whereDate('created_at', Carbon::today())->count();
        $totalBulanIni = PengajuanSurat::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        
        // Data tambahan untuk dashboard
        $totalKeseluruhan = PengajuanSurat::count();
        $totalMingguIni = PengajuanSurat::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();
        
        // Statistik berdasarkan status
        $pengajuanPending = PengajuanSurat::where('status', 'pending')->count();
        $pengajuanDisetujui = PengajuanSurat::where('status', 'disetujui')->count();
        $pengajuanDitolak = PengajuanSurat::where('status', 'ditolak')->count();
        
        // Data notifikasi khusus untuk dashboard (lebih detail)
        $notifikasiDashboard = Notifikasi::with(['pengaju', 'pengajuanSurat', 'jenisSurat'])
            ->orderBy('created_at', 'desc')
            ->take(5) // Hanya 5 untuk dashboard
            ->get();
        
        // Statistik notifikasi
        $notifikasiBelumDibaca = Notifikasi::where('sudah_dibaca_operator', false)->count();
        $notifikasiHariIni = Notifikasi::whereDate('created_at', Carbon::today())->count();
        
        // Data untuk chart/grafik (opsional)
        $pengajuanPerHari = PengajuanSurat::selectRaw('DATE(created_at) as tanggal, COUNT(*) as jumlah')
            ->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        
        $data = [
            'title' => 'Dashboard Admin',
            
            // Statistik utama
            'user' => $user,
            'totalHariIni' => $totalHariIni,
            'totalBulanIni' => $totalBulanIni,
            'totalMingguIni' => $totalMingguIni,
            'totalKeseluruhan' => $totalKeseluruhan,
            
            // Statistik status
            'pengajuanPending' => $pengajuanPending,
            'pengajuanDisetujui' => $pengajuanDisetujui,
            'pengajuanDitolak' => $pengajuanDitolak,
            
            // Data notifikasi
            'notifikasiDashboard' => $notifikasiDashboard,
            'notifikasiBelumDibaca' => $notifikasiBelumDibaca,
            'notifikasiHariIni' => $notifikasiHariIni,
            
            // Data untuk chart
            'pengajuanPerHari' => $pengajuanPerHari,
            
            // Note: $notifikasi dan $notifikasiBaru sudah tersedia dari View Composer
            // jadi tidak perlu didefinisikan lagi di sini
        ];
        
        return view('admin.dashboard.index', $data);
    }

    public function notifDibaca($id)
    {
        // Cari notifikasi terkait pengajuan ini
        $notifikasi = Notifikasi::where('id', $id)->first();

        // Tandai notifikasi sebagai sudah dibaca oleh operator jika belum
        if ($notifikasi && !$notifikasi->sudah_dibaca_operator) {
            $notifikasi->update([
                'sudah_dibaca_operator' => true,
                'dibaca_operator_pada' => now(),
            ]);
        }    
        return redirect()->back();
    }
}
