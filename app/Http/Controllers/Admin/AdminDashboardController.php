<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //
    function index()
    {
        $data = [
            'title' => 'Dashboard Admin'
        ];
        return view('admin.dashboard.index', $data);
    }

    // $pengajuan = PengajuanSurat::where('user_id', auth()->id())->with('jenisSurat')->get();

}
