<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aduan;
use Illuminate\Support\Str;

class AduanUserController extends Controller
{
    public function index(Request $request)
    {
        $query = Aduan::where('user_id', auth()->id());

        if ($request->has('search') && $request->search !== '') {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $aduans = $query->latest()->get();

        return view('user.pengaduan.index', compact('aduans'));
    }

    public function create()
    {
        $nomor = $this->generateNomorPengaduan();
        return view('user.pengaduan.create', ['nomor_pengaduan' => $nomor]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_pengaduan' => 'required',
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'telepon' => 'required',
            'judul' => 'required|string|max:255',
            'isi_pengaduan' => 'required',
            'lokasi' => 'required|string',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $aduan = new Aduan();
        $aduan->user_id = Auth::id();
        $aduan->nomor_pengaduan = $request->nomor_pengaduan;
        $aduan->nama = $request->nama;
        $aduan->email = $request->email;
        $aduan->telepon = $request->telepon;
        $aduan->judul = $request->judul;
        $aduan->isi_pengaduan = $request->isi_pengaduan;
        $aduan->lokasi = $request->lokasi;
        $aduan->latitude = $validated['latitude'];
        $aduan->longitude = $validated['longitude']; // Simpan longitude
        $aduan->tanggal = $request->tanggal;
        $aduan->status = 'menunggu';

        if ($request->hasFile('foto')) {
            // Simpan di storage/app/public/foto dan kembalikan path-nya
            $path = $request->file('foto')->store('foto', 'public'); // hasil: "foto/namafile.jpg"
            $aduan->foto = $path; // simpan path relatif
        }

        $aduan->save();

        return redirect()->route('user.pengaduan.index')->with('success', 'Pengaduan berhasil dikirim.');
    }

    public function show($id)
    {
        $aduan = Aduan::where('user_id', auth()->id())->findOrFail($id);
        return view('user.pengaduan.show', compact('aduan'));
    }

    private function generateNomorPengaduan()
    {
        return 'PGD-' . now()->format('YmdHis');
    }
}
