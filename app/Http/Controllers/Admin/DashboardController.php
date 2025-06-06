<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aduan;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total aduan
        $total = Aduan::count();

        // Hitung status baru
        $baru = Aduan::where('status', 'baru')->count();

        // Hitung status diproses
        $proses = Aduan::where('status', 'proses')->count();

        // Hitung status selesai
        $selesai = Aduan::where('status', 'selesai')->count();

        // Ambil 5 aduan terbaru untuk ditampilkan di dashboard
        $recentComplaints = Aduan::latest()->take(5)->get();

        // Kirim semua variabel ke view
        return view('admin.dashboard', compact('total', 'baru', 'proses', 'selesai', 'recentComplaints'));
    }
}
