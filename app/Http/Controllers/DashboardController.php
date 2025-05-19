<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    function index()
    {
        $jenisSurat = JenisSurat::latest()->get();

        $data = [
            'title' => 'Beranda Administrasi Desa Rias',
            'jenisSurat' => $jenisSurat,
        ];

        return view('dashboard.index', $data);
    }
}
