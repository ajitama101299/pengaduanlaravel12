<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aduan; // Pastikan ini benar
use Illuminate\Support\Facades\Storage; // Tambahkan ini untuk bekerja dengan Storage

class AduanAdminController extends Controller
{
    public function index()
    {
        $aduans = Aduan::orderBy('created_at', 'desc')->get();
        return view('admin.aduan.index', compact('aduans'));
    }

    public function show($id)
    {
        $aduan = Aduan::findOrFail($id);
        return view('admin.aduan.show', compact('aduan'));
    }

    public function edit($id)
    {
        $aduan = Aduan::findOrFail($id);
        // Jika Anda memiliki model Kategori dan ingin menampilkannya di form edit
        // $categories = \App\Models\Kategori::all(); // Sesuaikan jika Anda punya model Kategori
        // return view('admin.aduan.edit', compact('aduan', 'categories'));
        return view('admin.aduan.edit', compact('aduan'));
    }

    public function update(Request $request, $id)
    {
        $aduan = Aduan::findOrFail($id);

        // Validasi request, tambahkan validasi untuk foto
        $request->validate([
            'status' => 'required|string',
            'tanggapan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Opsional: Tambahkan validasi jika admin bisa mengganti foto
            // Anda mungkin juga ingin mengizinkan admin untuk mengubah judul, isi_pengaduan, dll.
            // Jika tidak, biarkan validasi seperti ini.
        ]);

        // Update status dan tanggapan
        $aduan->status = $request->status;
        $aduan->tanggapan = $request->tanggapan;

        // --- Logika Penanganan Foto ---
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada dan file-nya masih ada di storage
            if ($aduan->foto && Storage::disk('public')->exists($aduan->foto)) {
                Storage::disk('public')->delete($aduan->foto);
            }

            // Simpan foto baru ke folder 'fotoaduan' di dalam disk 'public'
            $path = $request->file('foto')->store('fotoaduan', 'public');
            $aduan->foto = $path; // Simpan path relatif ke database
        } elseif ($request->input('remove_foto')) {
            // Jika ada checkbox atau input hidden untuk menghapus foto tanpa upload baru
            if ($aduan->foto && Storage::disk('public')->exists($aduan->foto)) {
                Storage::disk('public')->delete($aduan->foto);
            }
            $aduan->foto = null; // Set field 'foto' di database menjadi null
        }
        // --- Akhir Logika Penanganan Foto ---

        $aduan->save();

        return redirect()->route('admin.pengaduan.index')->with('success', 'Pengaduan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $aduan = Aduan::findOrFail($id);

        // --- Logika Penghapusan Foto saat menghapus pengaduan ---
        if ($aduan->foto && Storage::disk('public')->exists($aduan->foto)) {
            Storage::disk('public')->delete($aduan->foto);
        }
        // --- Akhir Logika Penghapusan Foto ---

        $aduan->delete();

        return redirect()->route('admin.pengaduan.index')->with('success', 'Pengaduan berhasil dihapus!');
    }
}