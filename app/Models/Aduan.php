<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Aduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nomor_pengaduan', 'nama', 'telepon', 'email', 'judul', 'isi_pengaduan', 'tanggal', 'lokasi', 'status','foto','latitude',     // Tambahkan ini
        'longitude',
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Fungsi untuk menampilkan jumlah pengaduan masuk
    public function dashboard()
    {
        $jumlahPengaduanMasuk = Aduan::where('status', 'masuk')->count(); // Menghitung jumlah pengaduan dengan status 'masuk'
    
        return view('dashboard', compact('jumlahPengaduanMasuk')); // Kirim variabel ke view
    }
}
