<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik singkat
        $total = Pengaduan::count();
        $baru = Pengaduan::where('status', 'Baru')->count();
        $proses = Pengaduan::where('status', 'Diproses')->count();
        $selesai = Pengaduan::where('status', 'Selesai')->count();
        $jumlahPengaduanMasuk = Aduan::where('status', 'masuk')->count();

        return view('admin.dashboard', compact('jumlahPengaduanMasuk'));
        return view('admin.dashboard', compact('total', 'baru', 'proses', 'selesai'));
    }
}
