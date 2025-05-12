<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aduan;

class AduanAdminController extends Controller
{
    public function index()
    {
        $aduans = Aduan::all();
        return view('admin.pengaduan.index', compact('aduans'));
    }

    public function show($id)
    {
        $aduan = Aduan::findOrFail($id);
        return view('admin.pengaduan.show', compact('aduan'));
    }

    public function edit($id)
    {
        $aduan = Aduan::findOrFail($id);
        return view('admin.pengaduan.edit', compact('aduan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'tanggapan' => 'nullable|string',
        ]);

        $aduan = Aduan::findOrFail($id);
        $aduan->status = $request->status;
        $aduan->tanggapan = $request->tanggapan;
        $aduan->save();

        return redirect()->route('admin.pengaduan.index')->with('success', 'Pengaduan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $aduan = Aduan::findOrFail($id);
        $aduan->delete();

        return redirect()->route('admin.pengaduan.index')->with('success', 'Pengaduan berhasil dihapus!');
    }
}

