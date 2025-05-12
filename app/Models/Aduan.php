<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Aduan;


class Aduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'judul', 'isi', 'lokasi', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dashboard()
{
    $jumlahPengaduanMasuk = Aduan::where('status', 'masuk')->count(); // Menghitung jumlah pengaduan dengan status 'masuk'
    
    return view('dashboard', compact('jumlahPengaduanMasuk')); // Kirim variabel ke view
}
}
