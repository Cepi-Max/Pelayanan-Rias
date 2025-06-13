<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminDashboardController extends Controller
{
    //
    function index()
    {
        $user = User::count();
        $totalHariIni = PengajuanSurat::whereDate('created_at', Carbon::today())->count();
        $totalBulanIni = PengajuanSurat::whereMonth('created_at', Carbon::now()->month)
                            ->whereYear('created_at', Carbon::now()->year)
                            ->count();
        $notifikasi = auth()->user()->notifications;

        $data = [
            'title' => 'Dashboard Admin',
            'user' => $user,
            'totalHariIni' => $totalHariIni,
            'totalBulanIni' => $totalBulanIni,
            'notifikasi' => $notifikasi,
        ];
        return view('admin.dashboard.index', $data);
    }
}
